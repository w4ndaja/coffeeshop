@extends('admin.layouts.adminLayout')
@section('content')
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
  <li class="breadcrumb-item active">{{$title}}</li>
</ol>
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4 h-100">
      <form>
        <div class="card-header d-flex flex-wrap gap-3 justify-content-between align-items-center">
          <div class="d-flex flex-wrap flex-md-nowrap gap-3">
            <div class="input-group">
              <label for="perpage_input" class="input-group-text"><i class="bi bi-list-ol"></i></label>
              <select name="perpage" id="perpage_input" class="form-control" onchange="event.target.form.submit()">
                <option {{request()->perpage == 10 ? 'selected' : ''}} value="10">10</option>
                <option {{request()->perpage == 25 ? 'selected' : ''}} value="25">25</option>
                <option {{request()->perpage == 100 ? 'selected' : ''}} value="100">100</option>
              </select>
            </div>
            <div class="input-group">
              <label class="input-group-text" for="search_input"><i class="bi bi-search"></i></label>
              <input type="text" name="search" id="search_input" class="form-control" value="{{request()->search}}">
            </div>
          </div>
          <a href="{{route('admin.settings.create')}}" class="btn btn-primary"><i class="bi bi-plus-square me-2"></i>New Setting</a>
        </div>
      </form>
      <div class="card-body table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Value</th>
              <th width="10">#</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($settings as $item)
            <tr>
              <td class="text-nowrap">{{$item->key}}</td>
              <td>{{$item->value}}</td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-icon" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-list"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{route('admin.settings.edit', $item)}}"><i class="bi bi-pen me-2"></i>Edit</a></li>
                    <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_destroy_category_{{$item->id}}"><i class="bi bi-trash me-2"></i>Destroy</button></li>
                  </ul>
                </div>
                <form action="{{route('admin.settings.destroy', $item)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <div class="modal" tabindex="-1" id="modal_destroy_category_{{$item->id}}">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-body">
                          <p>Are you sure to delete this setting?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4">Empty</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between gap-2">
        <h5 class="mb-0">QR CODE</h5>
        <button class="btn btn-primary" onclick="svgToPng(document.querySelector('#qrCode').innerHTML).then(function(result){
          var a = document.createElement('a')
          a.setAttribute('download', 'QR-CODE.png')
          a.setAttribute('href', result)
          a.click()
        })"><i class="fas fa-download me-2"></i>Download</button>
      </div>
      <div class="card-body">
        {!! $qrCode !!}
      </div>
    </div>
  </div>
</div>
{{$settings->links()}}
@endsection
@push('bodies')
<script>
  /**
  * converts an svg string to base64 png using the domUrl
  * @param {string} svgText the svgtext
  * @param {number} [margin=0] the width of the border - the image size will be height+margin by width+margin
  * @param {string} [fill] optionally backgrund canvas fill
  * @return {Promise} a promise to the bas64 png image
  */
  var svgToPng = function (svgText, margin,fill) {
    // convert an svg text to png using the browser
    return new Promise(function(resolve, reject) {
      try {
        // can use the domUrl function from the browser
        var domUrl = window.URL || window.webkitURL || window;
        if (!domUrl) {
          throw new Error("(browser doesnt support this)")
        }

        // figure out the height and width from svg text
        var match = svgText.match(/height=\"(\d+)/m);
        var height = match && match[1] ? parseInt(match[1],10) : 200;
        var match = svgText.match(/width=\"(\d+)/m);
        var width = match && match[1] ? parseInt(match[1],10) : 200;
        margin = margin || 0;

        // it needs a namespace
        if (!svgText.match(/xmlns=\"/mi)){
          svgText = svgText.replace ('<svg ','<svg xmlns="http://www.w3.org/2000/svg" ') ;
        }

        // create a canvas element to pass through
        var canvas = document.createElement("canvas");
        canvas.width = height+margin*2;
        canvas.height = width+margin*2;
        var ctx = canvas.getContext("2d");


        // make a blob from the svg
        var svg = new Blob([svgText], {
          type: "image/svg+xml;charset=utf-8"
        });

        // create a dom object for that image
        var url = domUrl.createObjectURL(svg);

        // create a new image to hold it the converted type
        var img = new Image;

        // when the image is loaded we can get it as base64 url
        img.onload = function() {
          // draw it to the canvas
          ctx.drawImage(this, margin, margin);

          // if it needs some styling, we need a new canvas
          if (fill) {
            var styled = document.createElement("canvas");
            styled.width = canvas.width;
            styled.height = canvas.height;
            var styledCtx = styled.getContext("2d");
            styledCtx.save();
            styledCtx.fillStyle = fill;
            styledCtx.fillRect(0,0,canvas.width,canvas.height);
            styledCtx.strokeRect(0,0,canvas.width,canvas.height);
            styledCtx.restore();
            styledCtx.drawImage (canvas, 0,0);
            canvas = styled;
          }
          // we don't need the original any more
          domUrl.revokeObjectURL(url);
          // now we can resolve the promise, passing the base64 url
          resolve(canvas.toDataURL());
        };

        // load the image
        img.src = url;

      } catch (err) {
        reject('failed to convert svg to png ' + err);
      }
    });
  };
</script>
@endpush
