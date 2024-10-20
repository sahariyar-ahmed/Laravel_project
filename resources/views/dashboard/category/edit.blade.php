@extends('layouts.dashboardmaster')


@section('content')

 <!-- start page title -->
 <div class="py-3 py-lg-4">
    <div class="row">
        <div class="col-lg-6">
            <h4 class="page-title mb-0">Dashboard</h4>
        </div>
        <div class="col-lg-6">
           <div class="d-none d-lg-block">
            <ol class="breadcrumb m-0 float-end">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashtrap</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
           </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Category Edit Form</h5>
                <form role="form" action="{{ route('category.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text"
                            class="form-control @error('title') is-invalid
                    @enderror"
                            id="floatingnameInput" placeholder="" name="title" value=" {{ $category->title }} ">
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
                            id="floatingnameInput" placeholder="" name="slug" value=" {{ $category->slug }} ">
                        <label for="floatingnameInput">Category Slug</label>
                        @error('slug')
                            <p class="text-danger text-center pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <picture class="d-block my-4">
                            <img id="category_image" src="{{ asset('uploades/category') }}/{{ $category->image }}"
                                alt="portfolio create image" style="width: 100%; height: 150px; object-fit:contain;">
                        </picture>
                        <input type="file"
                            onchange="document.getElementById('category_image').src= window.URL.createObjectURL(this.files[0])"
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
