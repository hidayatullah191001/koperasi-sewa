@extends('layouts.main')

@section('title', 'Vehicles Management')

@push('addon-style')
    <style>
        .image-small {
            width: 50px;
            height: auto;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid vh-100">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item active">Vehicle Management</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Vehicles Management</h4>
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


        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="col-lg-8">
                                <h4 class="header-title">Data vehicle</h4>
                                <p class="text-muted font-13">Do something with all data vehicle.
                                </p>
                            </div>
                            <a class="btn btn-primary btn-sm" href="{{ route('vehicle.create') }}"><i
                                    class="fas fa-fw fa-plus text-sm"></i> Add new vehicle</a>
                        </div>


                        @if(count($vehicles) < 1)
                            <div class="text-center">
                                <iframe
                                    src="https://lottie.host/embed/c73aca21-eeaa-40b5-977c-a87182030fd8/dP9JfgQc5i.json"></iframe>
                                <h5>Oops, no data yet</h5>
                                <small>It looks like vehicle data is still empty, add or create new a vehicle data 
                                    immediately!</small>
                            </div>
                        @else
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Merk</th>
                                    <th>Warna</th>
                                    <th>Kapasitas</th>
                                    <th>Nomor Polisi</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($vehicles as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $item->merk }}
                                        </td>
                                        <td>{{ $item->warna }}</td>
                                        <td>{{ $item->kapasitas }}</td>
                                        <td>{{ $item->nomor_polisi }}</td>
                                        <td>{{ MyHelpers::ubahFormatTimestamp($item->created_at) }}</td>
                                        <td>
                                            <div class="m-0 row justify-align-center align-items-center">
                                                <div class="col-md-3">
                                                    <a class="btn btn-sm text-success text-small" href="{{ route('vehicle.show', $item) }}"><i
                                                            class="fas fa-eye"></i></a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a class="btn btn-sm text-info text-small"
                                                        href="{{ route('vehicle.edit', $item) }}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                </div>
                                                <div class="col-md-3">
                                                    <form action="{{ route('vehicle.destroy', $item->id) }}" method="post"
                                                        id="delete-vehicle{{ $item->id }}">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                    <a class="btn btn-sm  text-small text-danger" href="#"
                                                        onClick="confirmDelete({{ $item->id }})"><i
                                                            class="fa fa-trash m-r-5"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                        @endif

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div>

    {{-- @include('pages.admin.vehicle.view') --}}
@endsection


@push('addon-script')
    <script>
        function confirmDelete(itemId) {
            console.log(itemId);
            return Swal.fire({
                title: 'Are you sure?',
                text: "Data will be deleted permanently",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-vehicle' + itemId).submit();
                }
            });
        }
    </script>
@endpush