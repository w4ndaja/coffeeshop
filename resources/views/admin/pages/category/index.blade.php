@extends('admin.layouts.adminLayout')
@section('content')
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">{{$title}}</li>
</ol>
<div class="card mb-4">
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
            <div class="ms-auto">
                <form action="">
                    <div class="d-flex flex-column align-items-center">
                        <div class="form-check form-switch mb-0 me-0">
                            <input onchange="event.target.form.submit()" class="form-check-input" type="checkbox" id="active_filter" name="active" value="1" {{request()->active == 1 ? 'checked' : ''}}>
                        </div>
                        <label class="form-check-label" for="active_filter">Active</label>
                    </div>
                </form>
            </div>
            <a href="{{route('admin.menu-categories.create')}}" class="btn btn-primary"><i class="bi bi-plus-square me-2"></i>New Menu Category</a>
        </div>
    </form>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Menu Count</th>
                    <th width="10">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menuCategories as $item)
                <tr>
                    <td class="text-nowrap">{{$item->name}}</td>
                    <td>{{$item->menus_count}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-icon" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-list"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('admin.menu-categories.edit', $item)}}"><i class="bi bi-pen me-2"></i>Edit</a></li>
                                <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_destroy_category_{{$item->id}}"><i class="bi bi-trash me-2"></i>Destroy</button></li>
                            </ul>
                        </div>
                        <form action="{{route('admin.menu-categories.destroy', $item)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal" tabindex="-1" id="modal_destroy_category_{{$item->id}}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p>Are you sure to delete this menu category?</p>
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
{{$menuCategories->links()}}
@endsection
