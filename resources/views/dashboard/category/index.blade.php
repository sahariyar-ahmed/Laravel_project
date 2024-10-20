@extends('layouts.dashboardmaster')


{{-- <form id="status_id{{ $manager->id }}" action="{{ route('management.down', $manager->id) }}" method="POST"> --}}

@section('content')

    <x-breadcum title="Category"></x-breadcum>


@section('index-title')
    Category's
@endsection

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Category Table</h4>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="">
                            <tr class="">
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>
                                        <img src="{{ asset('uploades/category') }}/{{ $category->image }}"
                                            style="width:90px; height:90px;">
                                    </td>
                                    <td>{{ $category->title }}</td>
                                    <td>
                                        <form id="status_id{{ $category->id }}"
                                            action="{{ route('category.status', $category->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch">
                                                <input
                                                    onchange="document.querySelector('#status_id{{ $category->id }}').submit()"
                                                    class="form-check-input {{ $category->status == 'active' ? 'form-check-input' : 'bg-danger' }}"
                                                    type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                                    {{ $category->status == 'active' ? 'checked' : '' }}>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-info btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="{{ route('category.delete', $category->id) }}"
                                            class="btn btn-danger btn-sm"><i class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center">no category found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>

    {{-- Category Insert Form --}}
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Category Insert Form</h5>
                <form role="form" action="{{ route('category.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control @error('title') is-invalid
                        @enderror"
                            id="floatingnameInput" placeholder="" name="title">
                        <label for="floatingnameInput">Category Title</label>
                        @error('title')
                            <p class="text-danger text-center pt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control @error('slug')
                        is-invalid
                        @enderror"
                            id="floatingnameInput" placeholder="" name="slug">
                        <label for="floatingnameInput">Category Slug</label>
                        @error('slug')
                            <p class="text-danger text-center pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <label for="floatingnameInput">Blog Image</label>
                        <picture class="d-block my-4">
                            <img id="port_img" src="{{ asset('uploades/default/default1.jpg') }}"
                                alt="portfolio create image" style="width: 100%; height: 108px; object-fit:contain;">
                        </picture>
                        <input type="file"
                            onchange="document.getElementById('port_img').src= window.URL.createObjectURL(this.files[0])"
                            class="form-control @error('image')
                        is-invalid
                        @enderror "
                            id="floatingnameInput" name="image" style="padding: 18px">
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

@section('script')
@if (session('category_success'))
    <script>
        Toastify({
            text: "{{ session('category_success') }}",
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
