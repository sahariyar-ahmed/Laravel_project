@extends('layouts.dashboardmaster')


@section('content')
    <x-breadcum title="User Registration"></x-breadcum>


@section('index-title')
    Management's
@endsection

<div class="row">
    {{-- Role & User Registration --}}
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Role & User Registration</h5>
                <form role="form" action="{{ route('manager.update', $manager->id) }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control @error('name') is-invalid
                    @enderror"
                            id="floatingnameInput" placeholder="Name" name="name" value=" {{ $manager->name }} ">
                        <label for="floatingnameInput">Name</label>
                        @error('name')
                            <p class="text-danger text-center pt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email"
                            class="form-control @error('email')
                    is-invalid
                    @enderror"
                            id="floatingnameInput" placeholder="Email" name="email" value=" {{ $manager->email }} ">
                        <label for="floatingnameInput">Email</label>
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
</div>
@endsection

@section('script')
@if (session('register_complete'))
    <script>
        Toastify({
            text: "{{ session('register_complete') }}",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function() {} // Callback after click
        }).showToast();
    </script>
@endif
@endsection
