@extends('layouts.dashboardmaster')


@section('content')

    <x-breadcum title="Block User's"></x-breadcum>

@section('index-title')
    Management's
@endsection


<div class="row">
    {{-- show data --}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Block'S Table</h4>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="">
                            <tr class="">
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Block</th>

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
                                    <td>
                                        @if ($user->block == 1)
                                            <span>True</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->role }}</td>
                                    @if (Auth::user()->role == 'admin')
                                        </td>
                                        <td>
                                            <a href="{{ route('block.delete', $user->id) }}"
                                                class="btn btn-danger btn-sm"><i
                                                    class="fa-regular fa-trash-can"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-danger text-center">no block found!</td>
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
@if (session('block_delete'))
    <script>
        Toastify({
            text: "{{ session('block_delete') }}",
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
