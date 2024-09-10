@extends('layouts.main')

@section('title', 'Create a new Vehicle')

@push('addon-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vehicle.index') }}">Vehicle Management</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Data Vehicle</h4>
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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="col-lg-8">
                                <h4 class="header-title">Form Input Data Vehicle</h4>
                                <p class="text-muted font-13">Please fill all fields to edit new data.</p>
                            </div>
                        </div>

                        <form action="{{ route('vehicle.update', $vehicle) }}" method="POST" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <!-- Your form fields here -->
                            <div class="mb-3">
                                <label for="merk" class="form-label">Merk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                    name="merk" id="merk" placeholder="Merk Mobil" value="{{ $vehicle->merk }}"
                                    required />
                                @error('merk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="warna" class="form-label">Warna <span class="text-danger">*</span></label>
                                <input type="text" name="warna"
                                    class="form-control @error('warna') is-invalid @enderror" placeholder="Warna Mobil"
                                    value="{{ $vehicle->warna }}" required />
                                @error('warna')
                                    A
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="kapasitas" class="form-label">Kapasitas <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="kapasitas"
                                    class="form-control @error('kapasitas') is-invalid @enderror" data-toggle="touchspin"
                                    value="{{ $vehicle->kapasitas }}" min="0" required />
                                @error('kapasitas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nomor_polisi" class="form-label">Nomor Polisi <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nomor_polisi"
                                    class="form-control @error('nomor_polisi') is-invalid @enderror"
                                    placeholder="Nomor Polisi Mobil" value="{{ $vehicle->nomor_polisi }}" required />
                                @error('nomor_polisi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="full_ac" class="form-label">Full Ac <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input type="radio" id="ac_tersedia" name="full_ac" class="form-check-input"
                                        value="Tersedia" {{ $vehicle->full_ac == 'Tersedia' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="ac_tersedia">Tersedia</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="ac_tidak_tersedia" name="full_ac" class="form-check-input"
                                        value="Tidak tersedia" {{ $vehicle->full_ac == 'Tidak tersedia' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="ac_tidak_tersedia">Tidak tersedia</label>
                                </div>
                                @error('full_ac')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="musik" class="form-label">Musik <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input type="radio" id="musik_tersedia" name="musik" class="form-check-input"
                                        value="Tersedia" {{ $vehicle->musik == 'Tersedia' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="musik_tersedia">Tersedia</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="musik_tidak_tersedia" name="musik"
                                        class="form-check-input" value="Tidak tersedia"
                                        {{ $vehicle->musik == 'Tidak tersedia' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="musik_tidak_tersedia">Tidak tersedia</label>
                                </div>
                                @error('musik')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Submit Form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="col-lg-8">
                                <h4 class="header-title">Galleries</h4>
                                <p class="text-muted font-13">You can update or delete image galleries for vehicle</p>
                            </div>
                        </div>
                        <form id="uploadForm" action="{{ route('upload.vehicle.file', $vehicle->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mt-3">
                                        <input type="file" data-plugins="dropify" id="newFile" name="new_files[]" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Upload New Image</button>
                        </form>
    
                        <hr>
    
                        <!-- List of Existing Images -->
                        <div class="row" id="existingImages">
                            @foreach ($vehicleFiles as $item)
                                <div class="col-lg-4 text-center">
                                    <img src="{{ asset($item->file_path) }}" alt="Vehicle Image"
                                        style="width: 100%; height: 200px; object-fit: cover" class="rounded" />
                                    <button type="button" class="btn btn-link remove-file"
                                        data-id="{{ $item->id }}">Remove</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle remove button for existing files
            $('.remove-file').click(function() {
                var fileId = $(this).data('id');
                var removeUrl = "{{ route('vehicle.file.delete', ':id') }}".replace(':id',
                    fileId); // URL untuk menghapus gambar
                $.ajax({
                    url: removeUrl,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Remove file input and button
                        $('button[data-id="' + fileId + '"]').closest('.col-lg-4').remove();
                        Swal.fire({
                            icon: "success",
                            title: "Good job!",
                            text: 'Gambar berhasil dihapus!',
                        });
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Display success message
                            Swal.fire({
                                icon: "success",
                                title: "Good job!",
                                text: response.message,
                            });
                            // Refresh the existing images list
                            refreshExistingImages();
                            // Clear the Dropify input
                            $('#newFile').dropify().clearElement();
                        } else {
                            alert('Failed to upload file.');
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            function refreshExistingImages() {
                $.ajax({
                    url: '{{ route('vehicle.files', $vehicle->id) }}',
                    type: 'GET',
                    success: function(response) {
                        $('#existingImages').html(response.html);
                        $('.dropify').dropify();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
        });
    </script>
@endpush
