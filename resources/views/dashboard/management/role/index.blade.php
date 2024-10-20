@extends('layouts.dashboardmaster')


@section('content')
    <x-breadcum title="Exists User"></x-breadcum>

    @section('index-title')

Management's

@endsection


    <div class="row">
        {{-- Role & User Registration --}}
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="header-title">Exists User Role Management</h5>
                    <form role="form" action="{{ route('management.role.assign') }}" method="POST">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-12">
                                <label for="inputPassword5" class="col-sm-3 col-form-label">Role</label>
                                <select class="form-select" name="user_id" class="form-control" id="floatingnameInput">
                                    <option value="">select roles</option>
                                    @foreach ($only_users as $user)
                                        <option value="{{ $user->id }}"> {{ $user->name }} </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="text-danger text-center pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <label for="inputPassword5" class="col-sm-3 col-form-label">Manage User</label>
                                <select class="form-select" name="role" class="form-control" id="floatingnameInput">
                                    <option value="">select roles</option>
                                    <option value="manager">Manager</option>
                                    <option value="blogger">Blogger</option>
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

    </div>

    <div class="row">
        {{-- show data --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">User'S Table</h4>
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
                                @forelse ($only_users as $user)
                                    <tr>
                                        <td scope="row">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        @if (Auth::user()->role == 'admin')
                                            <td>
                                                <form id="user_id{{ $user->id }}"
                                                    action="{{ route('management.role.user.down', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input
                                                            onchange="document.querySelector('#user_id{{ $user->id }}').submit()"
                                                            class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked"
                                                            {{ $user->role == $user->role ? 'checked' : '' }}>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{  route('user.edit', $user->id) }}" class="btn btn-info btn-sm"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                <a href="{{  route('user.delete', $user->id) }}" class="btn btn-danger btn-sm"><i
                                                        class="fa-regular fa-trash-can"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-danger text-center">no user found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Blogger'S Table</h4>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="">
                                <tr class="">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    @if (Auth::user()->role == 'admin')
                                        <th>Role</th>
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($only_bloggers as $blogger)
                                    <tr>
                                        <td scope="row">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>{{ $blogger->name }}</td>
                                        <td>{{ $blogger->email }}</td>
                                        <td>{{ $blogger->role }}</td>
                                        @if (Auth::user()->role == 'admin')
                                            <td>
                                                <form id="user_id{{ $blogger->id }}"
                                                    action="{{ route('management.role.blogger.down', $blogger->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input
                                                            onchange="document.querySelector('#user_id{{ $blogger->id }}').submit()"
                                                            class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked"
                                                            {{ $blogger->role == $blogger->role ? 'checked' : '' }}>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{  route('blogger.edit', $blogger->id) }}" class="btn btn-info btn-sm"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                <a href="{{  route('blogger.delete', $blogger->id) }}" class="btn btn-danger btn-sm"><i
                                                        class="fa-regular fa-trash-can"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-danger text-center">no blogger found!</td>
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
    @if (session('role_assign'))
        <script>
            Toastify({
                text: "{{ session('role_assign') }}",
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
