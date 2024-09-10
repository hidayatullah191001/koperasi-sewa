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
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create new a Vehicle</h4>
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
                                <p class="text-muted font-13">Please fill all fields to create new data.</p>
                            </div>
                        </div>

                        <form action="{{ route('vehicle.store') }}" method="POST" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                            @csrf
                            <!-- Your form fields here -->
                            <div class="mb-3">
                                <label for="merk" class="form-label">Merk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror"
                                    name="merk" id="merk" placeholder="Merk Mobil" value="{{ old('merk') }}"
                                    required />
                                @error('merk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="warna" class="form-label">Warna <span class="text-danger">*</span></label>
                                <input type="text" name="warna"
                                    class="form-control @error('warna') is-invalid @enderror" placeholder="Warna Mobil"
                                    value="{{ old('warna') }}" required />
                                @error('warna')A
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="kapasitas" class="form-label">Kapasitas <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="kapasitas"
                                    class="form-control @error('kapasitas') is-invalid @enderror" data-toggle="touchspin"
                                    value="{{ old('kapasitas') ?? 0 }}" min="0" required />
                                @error('kapasitas')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nomor_polisi" class="form-label">Nomor Polisi <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nomor_polisi"
                                    class="form-control @error('nomor_polisi') is-invalid @enderror"
                                    placeholder="Nomor Polisi Mobil" value="{{ old('nomor_polisi') }}" required />
                                @error('nomor_polisi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="full_ac" class="form-label">Full Ac <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input type="radio" id="ac_tersedia" name="full_ac" class="form-check-input"
                                        value="Tersedia" {{ old('full_ac') == 'Tersedia' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="ac_tersedia">Tersedia</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="ac_tidak_tersedia" name="full_ac" class="form-check-input"
                                        value="Tidak tersedia" {{ old('full_ac') == 'Tidak tersedia' ? 'checked' : '' }}
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
                                        value="Tersedia" {{ old('musik') == 'Tersedia' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="musik_tersedia">Tersedia</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="musik_tidak_tersedia" name="musik"
                                        class="form-check-input" value="Tidak tersedia"
                                        {{ old('musik') == 'Tidak tersedia' ? 'checked' : '' }} required>
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
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            init: function() {
                this.on("error", function(file, response) {
                    console.log(response);
                });
            }
        };
    </script>
@endpush
