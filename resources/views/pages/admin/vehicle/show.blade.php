@extends('layouts.main')

@section('title', 'Show')

@push('addon-style')
<style>
    .carousel-item img {
        max-height: 400px;
        object-fit: cover;
        width: 100%;
    }
</style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vehicle.index') }}">Vehicle Management</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Detail Vehicle</h4>
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
                                <h4 class="header-title">{{ $vehicle->merk }} - {{ $vehicle->nomor_polisi }}</h4>
                                <p class="text-muted font-13">This is detail from data vehicle.</p>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @foreach ($vehicle->files as $index => $file)
                                                <div class="carousel-item  {{ $index == 0 ? 'active' : '' }}">
                                                    <img class="d-block img-fluid objec-cover" src="{{ asset($file->file_path) }}"
                                                        alt="First slide">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="col-lg-5">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Merk</th>
                                                <td>{{ $vehicle->merk }}</td>
                                            </tr>
                                            <tr>
                                                <th>Warna:</th>
                                                <td>{{ $vehicle->warna }}</td>
                                            </tr>
                                            <tr>
                                                <th>Kapasitas:</th>
                                                <td>{{ $vehicle->kapasitas }}</td>
                                            </tr>
                                            <tr>
                                                <th>Full AC:</th>
                                                <td>{{ $vehicle->full_ac }}</td>
                                            </tr>
                                            <tr>
                                                <th>Musik:</th>
                                                <td>{{ $vehicle->musik }}</td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Created At:</th>
                                                <td>{{ App\Helpers\MyHelpers::ubahFormatTimestamp($vehicle->created_at) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="mt-2">
                                        <a href="{{ route('vehicle.edit', $vehicle) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i> Edit Data</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
