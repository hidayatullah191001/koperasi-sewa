@extends('layouts.main')

@section('title', 'Create Transaction')

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaction Management</a>
                            </li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create new a transaction</h4>
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
                                <h4 class="header-title">Form Input Data Transaction</h4>
                                <p class="text-muted font-13">Please fill all fields to create new data.
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('transaction.store') }}" method="POST" class="needs-validation" novalidate
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="tanggal_transaksi"
                                    class="form-control @error('tanggal_transaksi') is_invalid @enderror"
                                    placeholder="Tanggal Transaksi" id="basic-datepicker"
                                    value="{{ old('tanggal_transaksi') }}" required />
                                @error('tanggal_transaksi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pembayaran" class="form-label">Pembayaran <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="pembayaran"
                                    class="form-control @error('pembayaran') is_invalid @enderror" placeholder="Pembayaran"
                                    value="{{ old('pembayaran') }}" required />
                                @error('pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_pemberangkatan" class="form-label">Tanggal Pemberangkatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="tanggal_pemberangkatan"
                                    class="form-control @error('tanggal_pemberangkatan') is_invalid @enderror"
                                    placeholder="Tanggal Pemberangkatan" id="basic-datepicker2"
                                    value="{{ old('tanggal_pemberangkatan') }}" required />
                                @error('tanggal_pemberangkatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="driver_id" class="form-label">Driver (Supir) <span
                                        class="text-danger">*</span></label>
                                <select name="driver_id" class="form-control @error('driver_id') is_invalid @enderror"
                                    data-toggle="select2" data-width="100%" required>
                                    <option selected disabled>Driver (Supir)</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->nama . ' - ' . $driver->nik }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('driver_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="vehicle_id" class="form-label">Vehicle (Mobil) <span
                                        class="text-danger">*</span></label>
                                <select name="vehicle_id" class="form-control @error('vehicle_id') is_invalid @enderror"
                                    data-toggle="select2" data-width="100%" required>
                                    <option selected disabled>Vehicle (Mobil)</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">
                                            {{ $vehicle->merk . ' - ' . $vehicle->nomor_polisi }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Customer (Penumpang) <span
                                        class="text-danger">*</span></label>
                                <select name="customer_id" class="form-control @error('customer_id') is_invalid @enderror"
                                    data-toggle="select2" data-width="100%" required>
                                    <option selected disabled>Customer (Penumpang)</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->nama . ' - ' . $customer->nik }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row w-100 mb-3">
                                <div class="col-lg-6">
                                    <label for="kota_asal_id" class="form-label">Kota Asal <span
                                            class="text-danger">*</span></label>
                                    <select name="kota_asal_id" id="kota_asal_id"
                                        class="form-control @error('kota_asal_id') is_invalid @enderror"
                                        data-toggle="select2" data-width="100%" required>
                                        <option selected disabled>Kota Asal</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kota_asal_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="kota_tujuan_id" class="form-label">Kota Tujuan <span
                                            class="text-danger">*</span></label>
                                    <select name="kota_tujuan_id" id="kota_tujuan_id"
                                        class="form-control @error('kota_tujuan_id') is_invalid @enderror"
                                        data-toggle="select2" data-width="100%">
                                        <option selected disabled>Kota Tujuan</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kota_tujuan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" id="submitBtn" type="submit">Submit
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
    <script>
        const fp = flatpickr("#basic-datepicker2", {}); // flatpickr
    </script>
@endpush