@extends('layouts.dashboardmaster')


@section('content')
    <x-breadcum title="User Registration"></x-breadcum>


@section('index-title')
    Management's
@endsection

<div class="row">
    {{-- Role & User Registration --}}
    <div class="col-xl-5">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Role & User Registration</h5>
                <form role="form" action="{{ route('management.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control @error('name') is-invalid
                    @enderror"
                            id="floatingnameInput" placeholder="Name" name="name">
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
                            id="floatingnameInput" placeholder="Email" name="email">
                        <label for="floatingnameInput">Email</label>
                        @error('email')
                            <p class="text-danger text-center pt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password"
                            class="form-control @error('password')
                    is-invalid
                    @enderror"
                            id="floatingnameInput" placeholder="password" name="password">
                        <label for="floatingnameInput">Password</label>
                        @error('password')
                            <p class="text-danger text-center pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="inputPassword5" class="col-sm-3 col-form-label">Role</label>
                            <select class="form-select" name="role" class="form-control" id="floatingnameInput">
                                <option value="">select roles</option>
                                <option value="manager">Manager</option>
                                <option value="blogger">Blogger</option>
                                <option value="user">User</option>
                            </select>
                            @error('role')
                                <p class="text-danger text-center pt-1">{{ $message }}</p>
                            @enderror
                        </div>
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

    {{-- show data --}}
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Management'S Table</h4>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="">
                            <tr class="">
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                @if (Auth::user()->role == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($managers as $manager)
                                <tr>
                                    <td scope="row">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>{{ $manager->name }}</td>
                                    <td>{{ $manager->email }}</td>
                                    <td>{{ $manager->role }}</td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <form id="user_id{{ $manager->id }}"
                                                action="{{ route('management.down', $manager->id) }}" method="POST">
                                                @csrf
                                                <div class="form-check form-switch">
                                                    <input
                                                        onchange="document.querySelector('#user_id{{ $manager->id }}').submit()"
                                                        class="form-check-input" type="checkbox" role="switch"
                                                        id="flexSwitchCheckChecked"
                                                        {{ $manager->role == $manager->role ? 'checked' : '' }}>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{  route('manager.edit', $manager->id) }}" class="btn btn-info btn-sm"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="{{  route('manager.delete', $manager->id) }}" class="btn btn-danger btn-sm"><i
                                                    class="fa-regular fa-trash-can"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-danger text-center">no manager found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
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
