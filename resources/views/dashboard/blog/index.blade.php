@extends('layouts.dashboardmaster')


@section('content')


@section('index-title')
    Blog's
@endsection

<x-breadcum title="Blog Show's Page"></x-breadcum>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Blog's Table</h4>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="">
                            <tr class="">
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category Title</th>
                                <th>Status</th>
                                <th>Feature</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $blog)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>
                                        <img src="{{ asset('uploades/blog') }}/{{ $blog->thumbnail }}"
                                            style="width:90px; height:90px; border-radius: 4px">
                                    </td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        {{ optional($blog->one_category)->title ?? 'No Category' }}
                                    </td>
                                    <td>
                                        <form id="avengers{{ $blog->id }}"
                                            action="{{ route('blog.change_status', $blog->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch">
                                                <input
                                                    onchange="document.querySelector('#avengers{{ $blog->id }}').submit()"
                                                    class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $blog->status == 'active' ? 'checked' : '' }}>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <form id="feature{{ $blog->id }}"
                                            action="{{ route('blog.change_feature', $blog->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch">
                                                <input
                                                    onchange="document.querySelector('#feature{{ $blog->id }}').submit()"
                                                    class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"  {{ $blog->feature == true ? 'checked' : '' }}>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#showSumon{{ $blog->id }}" class="btn btn-info btn-sm">
                                            <i class="fa-solid fa-face-grin-tongue-wink"></i>
                                        </a>
                                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-info btn-sm"><i
                                                class="fa-regular fa-pen-to-square"></i></a>
                                        <form class="d-inline-block" action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger waves-effect waves-light">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>



                                <!-- Modal -->
                                <div class="modal fade" id="showSumon{{ $blog->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">{{ $blog->id }} -
                                                    {{ $blog->title }}</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card mb-3">
                                                    <img src="{{ asset('uploades/blog') }}/{{ $blog->thumbnail }}"
                                                        alt="portfolio create thumbnail"
                                                        style="width: 100%; height: 108px; object-fit:contain; margin-top: 10px"
                                                        class="card-img-top">
                                                    <div class="card-body">
                                                        <h6 class="card-text">{!! $blog->short_description !!}</h6>
                                                        <p class="card-text">{!! $blog->description !!}</p>
                                                        <p class="card-text"><small class="text-body-secondary">Last
                                                                updated : <b>{{ $blog->updated_at }}</b></small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center">no blogger found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                        {{ $blogs->links() }}
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div>



</div>



@endsection



@section('script')
@if (session('blog_create_success'))
    <script>
        Toastify({
            text: "{{ session('blog_create_success') }}",
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
