@extends('layouts.main')

@section('title', 'Drivers Management')

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
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item active">Driver Management</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Drivers Management</h4>
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
                                <h4 class="header-title">Data driver</h4>
                                <p class="text-muted font-13">Do something with all data driver.
                                </p>
                            </div>
                            <a class="btn btn-primary btn-sm" href="{{ route('driver.create') }}"><i
                                    class="fas fa-fw fa-plus text-sm"></i> Add new driver</a>
                        </div>


                        @if (count($drivers) < 1)
                            <div class="text-center">
                                <iframe
                                    src="https://lottie.host/embed/c73aca21-eeaa-40b5-977c-a87182030fd8/dP9JfgQc5i.json"></iframe>
                                <h5>Oops, no data yet</h5>
                                <small>It looks like driver data is still empty, add or create new a driver data
                                    immediately!</small>
                            </div>
                        @else
                            <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No Id Card</th>
                                        <th>NIK</th>
                                        <th>Telepon</th>
                                        <th>Active?</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($drivers as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td>{{ $item->no_id_card }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->no_telepon }}</td>
                                            <td>
                                                @if ($item->is_active == 'yes')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Not Active</span>
                                                @endif
                                            </td>
                                            <td>{{ MyHelpers::ubahFormatTimestamp($item->created_at) }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-sm text-success text-small me-1" href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#view-driver-{{ $item->id }}-modal">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm text-info text-small me-1"
                                                        href="{{ route('driver.edit', MyHelpers::encode($item->id)) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <form action="{{ route('driver.destroy', $item->id) }}" method="post"
                                                        id="delete-driver{{ $item->id }}" style="display: inline;">
                                                        @method('delete')
                                                        @csrf
                                                        <a class="btn btn-sm text-small text-danger" href="#"
                                                            onClick="confirmDelete({{ $item->id }})">
                                                            <i class="fa fa-trash m-r-5"></i>
                                                        </a>
                                                    </form>
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
    @include('pages.admin.driver.view')
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
                    $('#delete-driver' + itemId).submit();
                }
            });
        }
    </script>
@endpush
