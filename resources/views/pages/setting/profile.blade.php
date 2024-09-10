@extends('layouts.main')

@section('title', 'My Profile')

@section('content')
    <div class="container-fluid vh-100">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ env('APP_URL') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Profile</li>
                        </ol>
                    </div>
                    <h4 class="page-title">My Profile</h4>
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
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="col-lg-8">
                            <h4 class="header-title">My Profile</h4>
                            <p class="text-muted font-13">Do something with my profile.
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 d-none d-md-block text-center align-items-center">
                            <img style="width: 250px; object-fit: cover" src="{{ $user->photo_profile == 'default.png' ? asset('assets/images/default.png') : asset('storage/' . $user->photo_profile) }}"
                                class="rounded img-preview" alt="">
    
                        </div>
                        <div class="col-md">
                            <form action="{{ route('setting-profile-update') }}" method="POST" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                                        placeholder="Full Name" value="{{ $user->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                        value="{{ $user->email }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="image">Photo Profile</label>
                                    <input type="file" name="image" id="image" class="form-control"
                                        onchange="previewImage()">
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('addon-script')
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
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
