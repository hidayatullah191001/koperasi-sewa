@extends('layouts.main')

@section('title', 'Update')

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">Driver Management</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Update Driver {{ $driver->name }}</h4>
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
                                <h4 class="header-title">Form Input Data Driver</h4>
                                <p class="text-muted font-13">Please fill all fields to create new data.
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('driver.update', $driver) }}" method="POST" class="needs-validation"
                            novalidate enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="no_id_card" class="form-label">No Id Card <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_id_card') is_invalid @enderror"
                                    name="no_id_card" id="no_id_card" placeholder="No id card"
                                    value="{{ $driver->no_id_card }}" required />
                                @error('no_id_card')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" minlength="16" maxlength="16" name="nik"
                                    class="form-control @error('nik') is_invalid @enderror" placeholder="NIK"
                                    id="thresholdconfig" value="{{ $driver->nik }}" required />
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is_invalid @enderror" placeholder="Nama"
                                    value="{{ $driver->nama }}" required />
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat" cols="10" rows="10"
                                    class="form-control @error('alamat') is_invalid @enderror" placeholder="Alamat" required>{{ $driver->alamat }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="tanggal_lahir"
                                    class="form-control @error('tanggal_lahir') is_invalid @enderror"
                                    placeholder="Tanggal Lahir" id="basic-datepicker"
                                    value="{{ $driver->tanggal_lahir }}" />
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                                <select name="agama" class="form-control @error('agama') is_invalid @enderror"
                                    data-toggle="select2" data-width="100%">
                                    <option disabled>Agama</option>
                                    @foreach ($religions as $religion)
                                        @if ($driver->agama == $religion)
                                            <option selected value="{{ $religion }}">{{ $religion }}</option>
                                        @else
                                            <option value="{{ $religion }}">{{ $religion }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status_kawin" class="form-label">Status Kawin <span
                                        class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input type="radio" id="kawin" name="status_kawin" class="form-check-input"
                                        value="Sudah Menikah / Kawin"
                                        {{ $driver->status_kawin == 'Sudah Menikah / Kawin' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="kawin">Sudah Menikah / Kawin</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="lajang" name="status_kawin" class="form-check-input"
                                        value="Lajang" {{ $driver->status_kawin == 'Lajang' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="lajang">Lajang</label>
                                </div>
                                @error('status_kawin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="jenis_sim" class="form-label">Jenis SIM <span
                                        class="text-danger">*</span></label>
                                <select name="jenis_sim" class="form-control" data-toggle="select2" data-width="100%">
                                    <option disabled>Jenis SIM</option>
                                    @foreach ($simTypes as $simType)
                                        @if ($driver->jenis_sim == $simType)
                                            <option selected value="{{ $simType }}">{{ $simType }}</option>
                                        @else
                                            <option value="{{ $simType }}">{{ $simType }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No Telepon <span
                                        class="text-danger">*</span></label>
                                <input type="text" minlength="12" maxlength="13" name="no_telepon"
                                    class="form-control" placeholder="No Telepon" value="{{ $driver->no_telepon }}"
                                    id="thresholdconfig" />
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="w-100 me-3">
                                    <label for="photo_profile" class="form-label">Photo Profile </label>
                                    <input type="file" name="photo_profile" id="photo_profile" class="form-control"
                                        placeholder="Photo Profile" onchange="previewImage()" required />
                                </div>
                                <div class="flex-shrink-0">
                                    @if ($driver->photo_profile == 'default.png')
                                        <img src="{{ asset('assets/images/default.png') }}" alt=""
                                            class="rounded img-preview"
                                            style="width: 150px; object-fit: cover">
                                    @else
                                        <img src="{{ asset('storage/' . $driver->photo_profile) }}"
                                            alt="" class="rounded img-preview"
                                            style="width: 150px; object-fit: cover">
                                    @endif
                                </div>
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
    <script>
        function previewImage() {
            const image = document.querySelector('#photo_profile');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush
