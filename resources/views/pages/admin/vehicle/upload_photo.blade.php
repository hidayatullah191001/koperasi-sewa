@extends('layouts.main')

@section('title', 'Create a new Vehicle')

@section('content')
    <div class="container-fluid vh-100">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vehicle.index') }}">Vehicle Management</a></li>
                            <li class="breadcrumb-item active">Upload File</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Upload photo vehicle</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @if (session()->has('success'))
            <x-alert-dialog type="success" :message="session('success')" />
        @endif

        @if (session()->has('error'))
            <x-alert-dialog type="error" :message="session('error')" />
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Vehicle {{ $vehicle->merk }} - {{ $vehicle->nomor_polisi }}</h4>
                        <p class="sub-header font-13">
                            Please Upload min 5 Photo
                        </p>

                        <form action="{{ route('vehicle.media.store', $vehicle->id) }}" enctype="multipart/form-data"
                            class="dropzone" id="my-dropzone">
                            @csrf
                        </form>

                        <a href="{{ route('vehicle.index') }}" class="btn btn-primary mt-4" id="back-button"
                            style="display: none;"><i class="fas fa-fw fa-arrow-left"></i> Back to Vehicle Management</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        var vehicleId = {{ $vehicle->id }};
        var dropzoneUrl = "{{ route('vehicle.media.store', ':id') }}".replace(':id', vehicleId);
        Dropzone.options.myDropzone = {
            url: dropzoneUrl,
            paramName: "file", // Nama parameter yang digunakan untuk mengirim file
            maxFilesize: 2, // Ukuran maksimum file dalam MB
            acceptedFiles: ".jpeg,.jpg,.png,.gif", // Jenis file yang diterima
            init: function() {
                var fileCount = 0;
                var backButton = document.getElementById('back-button');
                var myDropzone = this; // Simpan referensi ke Dropzone instance
                this.on("success", function(file, response) {
                    Swal.fire('Success', 'File uploaded successfully', 'success');
                    fileCount++;
                    if (fileCount >= 5) {
                        backButton.style.display = 'block'; // Tampilkan tombol back
                    }
                });

                this.on("error", function(file, response) {
                    Swal.fire('Error', 'File upload failed', 'error');
                });

                this.on("removedfile", function(file) {
                    fileCount--;
                    if (fileCount < 5) {
                        backButton.style.display =
                        'none'; // Sembunyikan tombol back jika file kurang dari 5
                    }
                });
            }
        };
        myDropzone.on("addedFile", function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
    </script>
@endpush
