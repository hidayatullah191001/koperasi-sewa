@extends('layouts.main')

@section('title', 'Edit Ticket Customer')

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Ticket Customer Management</a>
                            </li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Ticket Customer</h4>
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
                                <h4 class="header-title">Form Input Data Ticket Customer</h4>
                                <p class="text-muted font-13">Please fill all fields to edit data.
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('customer.update', $customer) }}" method="POST" class="needs-validation"
                            novalidate enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="text" name="tanggal"
                                    class="form-control @error('tanggal') is_invalid @enderror" placeholder="Tanggal"
                                    id="basic-datepicker" value="{{ $customer->tanggal }}" required />
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" minlength="16" maxlength="16" name="nik"
                                    class="form-control @error('nik') is_invalid @enderror" placeholder="NIK"
                                    id="thresholdconfig" value="{{ $customer->nik }}" required />
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is_invalid @enderror" placeholder="Nama"
                                    value="{{ $customer->nama }}" required />
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                        class="text-danger">*</span></label>
                                <select name="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is_invalid @enderror" data-toggle="select2"
                                    data-width="100%" required>
                                    <option disabled>Jenis Kelamin</option>
                                    @foreach ($genders as $gender)
                                        @if ($customer->jenis_kelamin == $gender)
                                            <option selected value="{{ $gender }}">{{ $gender }}</option>
                                        @else
                                            <option value="{{ $gender }}">{{ $gender }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label for="umur" class="form-label">Umur <span class="text-danger">*</span></label>
                                <input type="number" name="umur"
                                    class="form-control @error('umur') is-invalid @enderror" data-toggle="touchspin"
                                    value="{{ $customer->umur }}" min="0" required />
                                @error('umur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat" cols="10" rows="10"
                                    class="form-control @error('alamat') is_invalid @enderror" placeholder="Alamat" required>{{ $customer->alamat }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="photo_ktp" class="form-label">Photo KTP <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="photo_ktp" id="photo_ktp" class="form-control"
                                    placeholder="Photo Profile" />
                            </div> --}}

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="w-100 me-3">
                                    <label for="photo_ktp" class="form-label">Photo KTP <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="photo_ktp" id="photo_ktp" class="form-control"
                                        placeholder="Photo Profile" onchange="previewImage()" required />
                                </div>
                                <div class="flex-shrink-0">
                                    <img style="width: 150px; height: 80px; object-fit: cover"
                                        src="{{ $customer->photo_ktp ? asset('storage/' . $customer->photo_ktp) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Picture_icon_BLACK.svg/1200px-Picture_icon_BLACK.svg.png' }}"
                                        class="rounded img-preview" alt="">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="no_telephone" class="form-label">No Telephone <span
                                        class="text-danger">*</span></label>
                                <input type="text" minlength="12" maxlength="13" name="no_telephone"
                                    class="form-control" placeholder="No Telepon" value="{{ $customer->no_telephone }}"
                                    id="thresholdconfig" />
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="row w-100 me-3">
                                    <div class="col-lg-6">
                                        <label for="kota_asal" class="form-label">Kota Asal <span
                                                class="text-danger">*</span></label>
                                        <select name="kota_asal" id="kota_asal"
                                            class="form-control @error('kota_asal') is_invalid @enderror"
                                            data-toggle="select2" data-width="100%" required>
                                            <option disabled>Kota Asal</option>
                                            @foreach ($cities as $city)
                                                @if ($customer->kota_asal == $city->id)
                                                    <option selected value="{{ $city->id }}">{{ $city->nama }}
                                                    </option>
                                                @else
                                                    <option value="{{ $city->id }}">{{ $city->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('kota_asal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="kota_tujuan" class="form-label">Kota Tujuan <span
                                                class="text-danger">*</span></label>
                                        <select name="kota_tujuan" id="kota_tujuan"
                                            class="form-control @error('kota_tujuan') is_invalid @enderror"
                                            data-toggle="select2" data-width="100%">
                                            <option disabled>Kota Tujuan</option>
                                            @foreach ($cities as $city)
                                                @if ($customer->kota_tujuan == $city->id)
                                                    <option selected value="{{ $city->id }}">{{ $city->nama }}
                                                    </option>
                                                @else
                                                    <option value="{{ $city->id }}">{{ $city->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('kota_tujuan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <button type="button" id="cekRute" class="btn btn-primary mt-4">Cek Rute</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="harga_tiket" class="form-label">Harga per Tiket <span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @error('harga_tiket') is_invalid @enderror autonumber"
                                    data-currency-symbol="Rp " name="harga_tiket" id="harga_tiket"
                                    value="{{ $customer->harga_tiket }}" placeholder="Harga per Tiket" required />
                                @error('harga_tiket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="harga_bagasi" class="form-label">Harga Bagasi</label>
                                <input type="text"
                                    class="form-control @error('harga_bagasi') is_invalid @enderror autonumber"
                                    data-currency-symbol="Rp " name="harga_bagasi" id="harga_bagasi"
                                    placeholder="Harga Bagasi" value="{{ $customer->harga_bagasi }}" />
                                @error('harga_bagasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="keterangan_bagasi" class="form-label">Keterangan Bagasi</label>
                                <input type="text" name="keterangan_bagasi"
                                    class="form-control @error('keterangan_bagasi') is_invalid @enderror"
                                    placeholder="Keterangan Bagasi" value="{{ $customer->keterangan_bagasi }}" />
                                @error('keterangan_bagasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" id="submitBtn" type="submit" disabled>Submit
                                    Form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function previewImage() {
            const image = document.querySelector('#photo_ktp');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function() {
            function checkHargaTiket() {
                var hargaTiket = $('#harga_tiket').val();
                if (hargaTiket.trim() === '' || hargaTiket.trim() === 'Rp') {
                    $('#submitBtn').attr('disabled', true);
                } else {
                    $('#submitBtn').attr('disabled', false);
                }
            }
            checkHargaTiket();
            $('#harga_tiket').on('input', function() {
                checkHargaTiket();
            });


            $('#cekRute').on('click', function() {
                var kotaAsal = $('#kota_asal').val();
                var kotaTujuan = $('#kota_tujuan').val();

                if (!kotaAsal || !kotaTujuan) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Silakan pilih Kota Asal dan Kota Tujuan",
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route('cek-rute') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        kota_asal: kotaAsal,
                        kota_tujuan: kotaTujuan
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Good job!",
                            text: 'Rute ditemukan!',
                        });

                        $('#harga_tiket').val(response.harga_tiket);

                        // Inisialisasi atau update AutoNumeric
                        if (AutoNumeric.getAutoNumericElement('#harga_tiket')) {
                            AutoNumeric.getAutoNumericElement('#harga_tiket').set(response
                                .harga_tiket);
                        } else {
                            new AutoNumeric('#harga_tiket', {
                                currencySymbol: 'Rp ',
                                decimalCharacter: ',',
                                digitGroupSeparator: '.',
                            }).set(response.harga_tiket);
                        }

                        // Panggil fungsi checkHargaTiket setelah nilai harga_tiket diupdate
                        checkHargaTiket();
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: response.responseJSON.message,
                        });
                    }
                });
            });
        });
    </script>
@endpush
