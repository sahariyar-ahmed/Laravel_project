@extends('layouts.dashboardmaster')


@section('content')
    <x-breadcum title="Profile"></x-breadcum>

    @section('index-title')

    Profile

    @endsection

    <div class="row">
        {{-- name update --}}
        <div class="col-xl-6">
            {{-- success msg --}}
            @if (session('name_update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session('name_update') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- success msg --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="header-title">Username Update</h5>

                    <form action="{{ route('home.profile.name.update') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control @error('name')
                        is-invalid
                        @enderror"
                                id="floatingnameInput" placeholder="Enter Name" name="name" value="{{ old('name') }}">
                            <label for="floatingnameInput">Name</label>
                            @error('name')
                                <p class="text-danger text-center pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>

        {{-- email update --}}
        <div class="col-xl-6">
            {{-- success msg --}}
            @if (session('email_update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session('email_update') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- success msg --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="header-title">UserEmail Update</h5>

                    <form action="{{ route('home.profile.email.update') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control @error('email')
                    is-invalid
                    @enderror"
                                id="floatingnameInput" placeholder="Enter Name" name="email" value="{{ old('email') }}">
                            <label for="floatingnameInput">email</label>
                            @error('email')
                                <p class="text-danger text-center pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>


        {{-- password update --}}
        <div class="col-xl-6">
            {{-- success msg --}}
            @if (session('password_update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session('password_update') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- success msg --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="header-title">Password Update</h5>

                    <form action="{{ route('home.profile.password.update') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="password"
                                class="form-control @error('current_password')
                        is-invalid
                        @enderror"
                                id="floatingnameInput" placeholder="Enter Current Password" name="current_password"
                                value="{{ old('current_password') }}">
                            <label for="floatingnameInput">Current Password</label>
                            @error('current_password')
                                <p class="text-danger text-center pt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password"
                                class="form-control @error('password')
                        is-invalid
                        @enderror"
                                id="floatingnameInput" placeholder="Enter Password" name="password"
                                value="{{ old('password') }}">
                            <label for="floatingnameInput">Password</label>
                            @error('password')
                                <p class="text-danger text-center pt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password"
                                class="form-control @error('password_confirmation')
                        is-invalid
                        @enderror"
                                id="floatingnameInput" placeholder="Enter Confirm Password" name="password_confirmation"
                                value="{{ old('password_confirmation') }}">
                            <label for="floatingnameInput">Confirm Password</label>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        {{-- image update --}}
        <div class="col-xl-6">
            {{-- success msg --}}
            @if (session('image_update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ session('image_update') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- success msg --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="header-title">Image Update</h5>

                    <form action="{{ route('home.profile.image.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <picture class="d-block my-4">
                                <img id="port_img" src="{{ asset('uploades/default/default1.jpg') }}"
                                    alt="portfolio create image" style="width: 100%; height: 108px; object-fit:contain;">
                            </picture>
                            <input type="file"
                                onchange="document.getElementById('port_img').src= window.URL.createObjectURL(this.files[0])"
                                class="form-control @error('image')
                        is-invalid
                        @enderror"
                                id="floatingnameInput" placeholder="Choice Your Image" name="image"
                                value="{{ old('image') }}" style="padding: 18px">
                            @error('image')
                                <p class="text-danger text-center pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>




    </div>
@endsection
