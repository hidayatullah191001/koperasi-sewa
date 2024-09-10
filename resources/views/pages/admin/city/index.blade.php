@extends('layouts.main')

@section('title', 'Cities')

@push('addon-style')
    <style>
        .select2-container {
            z-index: 2050 !important;
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
                            <li class="breadcrumb-item active">Route Management</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Route Management</h4>
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
                                <h4 class="header-title">Data Cities</h4>
                                <p class="text-muted font-13">Do something with all data city.
                                </p>
                            </div>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#create-city-modal"><i class="fas fa-fw fa-plus text-sm"></i> Add new
                                City</button>
                        </div>

                        @if (count($cities) < 1)
                            <div class="text-center">
                                <iframe
                                    src="https://lottie.host/embed/c73aca21-eeaa-40b5-977c-a87182030fd8/dP9JfgQc5i.json"></iframe>
                                <h5>Oops, no data yet</h5>
                                <small>It looks like city data is still empty, add or create new a city data
                                    immediately!</small>
                            </div>
                        @else
                            <table id="datatable-buttons" class="table dt-responsive nowrap w-100">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kota</th>
                                        <th>Type</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($cities as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ MyHelpers::ubahFormatTimestamp($item->created_at) }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-sm text-info text-small me-1" data-bs-toggle="modal"
                                                    data-bs-target="#edit-city-{{ $item->id }}-modal"><i class="fas fa-fw fa-pencil-alt"></i> </button>
                                                
                                                    <form action="{{ route('city.destroy', $item->id) }}" method="post"
                                                        id="delete-city{{ $item->id }}" style="display: inline;">
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
    @include('pages.admin.city.edit')
    @include('pages.admin.city.create')
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#create-city-modal').on('shown.bs.modal', function() {
                $('#type').select2({
                    dropdownParent: $('#create-city-modal')
                });
            });
            $('[id^="edit-city-"]').on('shown.bs.modal', function () {
                $(this).find('select[data-toggle="select2"]').select2({
                    dropdownParent: $(this)
                });
            });
        });

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
                    $('#delete-city' + itemId).submit();
                }
            });
        }
    </script>
@endpush
