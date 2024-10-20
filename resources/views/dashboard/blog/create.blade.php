@extends('layouts.dashboardmaster')


@section('content')


@section('index-title')
    Blog's
@endsection

<x-breadcum title="Blog's Create Page"></x-breadcum>

<div class="row">


    {{-- Category Insert Form --}}
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title text-center">Blog Insert Form</h5>
                <form role="form" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label style="margin-bottom: 10px" for="floatingnameInput">Category</label>
                        <div class="form-floating mb-3">
                            <select class="form-select" style="padding: 10px " name="category_id" class="form-control" id="floatingnameInput">
                                <option value="">select roles</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger text-center pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 ">
                        <label for="inputEmail4" class="form-label">Blog Title</label>
                        <input name="title" style="padding: 16px" type="text" class="form-control @error('title') is-invalid
                        @enderror" id="inputEmail4" placeholder="Blog Title">
                        @error('title')
                        <p class="text-danger text-center pt-1">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="mb-3 ">
                        <label for="inputEmail4" class="form-label">Blog Slug</label>
                        <input name="slug" style="padding: 16px" type="text" class="form-control @error('slug') is-invalid
                        @enderror" id="inputEmail4" placeholder="Blog Slug">
                        @error('slug')
                            <p class="text-danger text-center pt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label style="margin-bottom: 10px" for="floatingnameInput">Blog Short Description</label>
                        <div class="form-floating mb-3">
                            <div>
                             <textarea id="short_description" type="text" class="form-control @error('short_description') is-invalid
                             @enderror"
                                 id="floatingnameInput" name="short_description"></textarea>
                                 @error('short_description')
                                 <p class="text-danger text-center pt-1">{{ $message }}</p>
                             @enderror
                            </div>
                         </div>
                    </div>
                    <div>
                        <label style="margin-bottom: 10px" for="floatingnameInput">Blog Description</label>
                    <div class="form-floating mb-3">
                        <div>
                            <textarea id="description" type="text" class="form-control @error('description') is-invalid
                        @enderror"
                            id="floatingnameInput" name="description"></textarea>
                        @error('description')
                            <p class="text-danger text-center pt-1">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                    </div>

                    <div class="form-floating mb-2">
                        <label style="padding: 0px" for="floatingnameInput">Blog Thumbnail</label>
                        <picture class="d-block my-4">
                            <img id="port_img" src="{{ asset('uploades/default/default1.jpg') }}"
                                alt="portfolio create thumbnail"
                                style="width: 100%; height: 108px; object-fit:contain;">
                        </picture>
                        <input type="file"
                            onchange="document.getElementById('port_img').src= window.URL.createObjectURL(this.files[0])"
                            class="form-control @error('thumbnail')
                        is-invalid
                        @enderror "
                            id="floatingnameInput" name="thumbnail" style="padding: 18px">
                        @error('thumbnail')
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

<script>
    tinymce.init({
      selector: '#short_description',
      plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Oct 8, 2024:
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
  </script>

<script>
    tinymce.init({
      selector: '#description',
      plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Oct 8, 2024:
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      ],
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
  </script>


@endsection
