@extends('layouts.main')

@section('title', 'Detail Transaction')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Transaction Management</a>
                            </li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Detail transaction {{ $transaction->tanggal_transaksi }}</h4>
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
                        <section class="mb-4">
                            <h4>Detail Transaction</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Tanggal Transaksi:</th>
                                        <td>{{ MyHelpers::ubahFormatTanggal($transaction->tanggal_transaksi) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pembayaran:</th>
                                        <td>{{ $transaction->pembayaran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pemberangkatan:</th>
                                        <td>{{ MyHelpers::ubahFormatTanggal($transaction->tanggal_pemberangkatan) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kota Asal:</th>
                                        <td>{{ $transaction->kotaAsal->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kota Tujuan:</th>
                                        <td>{{ $transaction->kotaTujuan->nama }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>

                        <section class="mb-4">
                            <h4>Detail Customer (Penumpang)</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Nama:</th>
                                        <td>{{ $transaction->customer->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIK:</th>
                                        <td>{{ $transaction->customer->nik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin:</th>
                                        <td>{{ $transaction->customer->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <th>Umur:</th>
                                        <td>{{ $transaction->customer->umur }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat:</th>
                                        <td>{{ $transaction->customer->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telephone:</th>
                                        <td>{{ $transaction->customer->no_telephone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kota Asal:</th>
                                        <td>{{ $transaction->customer->asal->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kota Tujuan:</th>
                                        <td>{{ $transaction->customer->tujuan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Tiket:</th>
                                        <td>{{ $transaction->customer->harga_tiket }}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Bagasi:</th>
                                        <td>{{ $transaction->customer->harga_bagasi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan Bagasi:</th>
                                        <td>{{ $transaction->customer->keterangan_bagasi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Transaksi:</th>
                                        <td>{{ MyHelpers::ubahFormatTanggal($transaction->tanggal_transaksi) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pembayaran:</th>
                                        <td>{{ $transaction->pembayaran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pemberangkatan:</th>
                                        <td>{{ MyHelpers::ubahFormatTanggal($transaction->tanggal_pemberangkatan) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>

                        <section class="mb-4">
                            <h4>Detail Driver (Supir)</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="flex-shrink-1 me-3 p-4 d-none d-md-block">
                                    @if ($transaction->driver->photo_profile == 'default.png')
                                        <img src="{{ asset('assets/images/default.png') }}" alt="{{ $transaction->driver->name }}" style="width: 150px; object-fit: cover"
                                            class="rounded">
                                    @else
                                        <img src="{{ asset('storage/' . $transaction->driver->photo_profile) }}" style="width: 150px; object-fit: cover" alt="{{ $transaction->driver->name }}"
                                            class="rounded">
                                    @endif
                                </div>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Nama:</th>
                                            <td>{{ $transaction->driver->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIK:</th>
                                            <td>{{ $transaction->driver->nik }}</td>
                                        </tr>
                                        <tr>
                                            <th>No IDCard:</th>
                                            <td>{{ $transaction->driver->no_id_card }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat:</th>
                                            <td>{{ $transaction->driver->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Umur:</th>
                                            <td>{{ $transaction->driver->umur }}</td>
                                        </tr>
                                        <tr>
                                            <th>Agama:</th>
                                            <td>{{ $transaction->driver->agama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Kawin:</th>
                                            <td>{{ $transaction->driver->status_kawin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis SIM:</th>
                                            <td>{{ $transaction->driver->jenis_sim }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Telepon:</th>
                                            <td>{{ $transaction->driver->no_telepon }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>

                        <section class="mb-3">
                            <h4>Detail Vehicle (Mobil)</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="flex-shrink-1 me-3 p-4 d-none d-md-block">
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @foreach ($transaction->vehicle->files as $index => $file)
                                                <div class="carousel-item  {{ $index == 0 ? 'active' : '' }}">
                                                    <img style="width:150px; object-fit: cover" class="d-block" src="{{ asset($file->file_path) }}"
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
                                
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Merk</th>
                                            <td>{{ $transaction->vehicle->merk }}</td>
                                        </tr>
                                        <tr>
                                            <th>Warna:</th>
                                            <td>{{ $transaction->vehicle->warna }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kapasitas:</th>
                                            <td>{{ $transaction->vehicle->kapasitas }}</td>
                                        </tr>
                                        <tr>
                                            <th>Full AC:</th>
                                            <td>{{ $transaction->vehicle->full_ac }}</td>
                                        </tr>
                                        <tr>
                                            <th>Musik:</th>
                                            <td>{{ $transaction->vehicle->musik }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
