@extends('layouts.main')

@section('title' , 'Users Management')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid vh-100">
                        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('superadmin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users Management</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Users Management</h4>
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
                                <h4 class="header-title">Data Users</h4>
                                <p class="text-muted font-13">Do something with all data user.
                                </p>
                            </div>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#create-user-modal"><i class="fas fa-fw fa-plus text-sm"></i> Add new User</button>
                        </div>
                        

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date Created</th>
                                    <th>Role</th>
                                    <th>Active?</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ App\Helpers\MyHelpers::ubahFormatTimestamp($user->created_at) }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            @if($user->is_active == 'yes')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Not Active</span>
                                            @endif
                                        </td>
                                        <td> <div class="m-0 row justify-align-center align-items-center">
                                            <div class="col-md-3">
                                                <a class="btn btn-sm text-info text-small" href="#"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#edit-user-{{ $user->id }}-modal"><i class="fas fa-pencil-alt"></i></a>
                                            </div>
                                            <div class="col-md-3">
                                                <form action="{{ route('superadmin-user-destroy', $user->id) }}" method="post" id="deleteUser{{ $user->id }}">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-sm  text-small text-danger" href="#"
                                                    onClick="confirmDelete({{ $user->id }})"><i class="fa fa-trash m-r-5"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>    
                                    @include('pages.superadmin.user-management.edit')
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        
    </div> <!-- container -->
    @include('pages.superadmin.user-management.create')
@endsection

@push('addon-script')
    <script>
        function confirmDelete(itemId) {
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
                    $('#deleteUser' + itemId).submit();
                }
            });
        }
    </script>
@endpush