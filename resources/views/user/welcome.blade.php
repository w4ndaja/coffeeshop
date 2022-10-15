@extends('user.layouts')
@section('content')
<div class="container py-5">
    <div class="h1 mb-4">Hi, {{optional(Auth::guard('user')->user())->name}}</div>
    <div class="card">
        <div class="card-header text-center text-info fw-bold">Scan to order</div>
        <div class="card-body">
            <img data-bs-toggle="modal" data-bs-target="#scannerModal" class="w-100" src="{{asset('user/icons/scan-qr-icon.png')}}" alt="" onerror="this.src='{{asset('user/icons/no-photo.png')}}'" style="cursor:pointer">
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="scannerModal" tabindex="-1" role="dialog" aria-labelledby="scanToOrderLabel" aria-hidden="true">
        <div class="modal-dialog m-0" role="document" style="width:100vw;height:100vh">
            <div class="modal-content w-100 h-100 d-flex flex-column">
                <div class="modal-header bg-light text-info position-absolute top-0 w-100" style="z-index:1040;">
                    <h5 class="modal-title" id="scanToOrderLabel">Scan to order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <video class="my-auto" id="cameraContainer" style="width:100%;z-index:1039;"></video>
                <strong id="qrResult" class="mt-auto"></strong>
            </div>
        </div>
    </div>


</div>
@endsection

@push('scripts')
<script src="/user/js/qr-scanner.umd.min.js"></script>
<script>
    const videoElem = document.querySelector('#cameraContainer')
    const qrScanner = new QrScanner(
        videoElem,
        result => {
            console.log('decoded qr code:', result)
            // document.querySelector('#qrResult').innerText = JSON.stringify(result)
            window.location.href = result.data
            qrScanner.stop()
        },
        { /* your options or returnDetailedScanResult: true if you're not specifying any other options */ },
    );

    var scannerModal = document.getElementById('scannerModal');
    scannerModal.addEventListener('show.bs.modal', function (event) {
        qrScanner.start()
    });
    scannerModal.addEventListener('hide.bs.modal', function (event) {
        qrScanner.stop()
    });
</script>
@endpush
