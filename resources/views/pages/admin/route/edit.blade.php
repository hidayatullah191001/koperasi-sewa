@extends('layouts.main')

@section('title', 'Edit Route')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('route.index') }}">Route Management</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit new a Route</h4>
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
                            <h4 class="header-title">Form Input Data Route</h4>
                            <p class="text-muted font-13">Please fill all fields to edit new data.
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('route.update', $route) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('put')
                        <div class="row  mb-3 d-flex justify-content-between align-items-center">
                            <div class="col">
                                <label for="kota_asal" class="form-label">Kota Asal <span
                                        class="text-danger">*</span></label>
                                <select name="kota_asal" class="form-control" data-toggle="select2" data-width="100%">
                                    <option disabled>Kota Asal</option>
                                    @foreach ($kotaAsals as $kotaAsal)
                                        @if($kotaAsal->id == $route->kota_asal)
                                            <option selected value="{{ $kotaAsal->id }}">{{ $kotaAsal->nama }}</option>
                                        @else
                                            <option value="{{ $kotaAsal->id }}">{{ $kotaAsal->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="kota_tujuan" class="form-label">Kota Tujuan <span
                                        class="text-danger">*</span></label>
                                <select name="kota_tujuan" class="form-control" data-toggle="select2" data-width="100%">
                                    <option disabled>Kota Tujuan</option>
                                    @foreach ($kotaTujuans as $kotaTujuan)
                                        @if($kotaTujuan->id == $route->kota_tujuan)
                                            <option selected value="{{ $kotaTujuan->id }}">{{ $kotaTujuan->nama }}</option>
                                        @else
                                            <option value="{{ $kotaTujuan->id }}">{{ $kotaTujuan->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="harga_tiket" class="form-label">Harga per Tiket <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('harga_tiket') is_invalid @enderror autonumber"
                                data-currency-symbol="Rp " name="harga_tiket" id="harga_tiket" placeholder="Harga per Tiket"
                                value="{{ $route->harga_tiket }}" required />
                            @error('harga_tiket')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga_carteran" class="form-label">Harga Carteran <span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('harga_carteran') is_invalid @enderror autonumber"
                                data-currency-symbol="Rp " name="harga_carteran" id="harga_carteran"
                                placeholder="Harga Carteran" value="{{ $route->harga_carteran }}" required />
                            @error('harga_carteran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-2 mb-3">
                            <label for="jam_pemberangkatan" class="form-label">Jam Pemberangkatan <span
                                    class="text-danger">*</span></label>
                            <input type="time" class="form-control @error('jam_pemberangkatan') is_invalid @enderror"
                                name="jam_pemberangkatan" id="jam_pemberangkatan" placeholder="Jam Pemberangkatan"
                                value="{{ $route->jam_pemberangkatan }}" required />
                            @error('jam_pemberangkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
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
@endsection
