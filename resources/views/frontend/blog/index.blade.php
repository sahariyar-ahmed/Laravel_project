@extends('layouts.master')


@section('content')
    <!--section-heading-->
    <div class="section-heading ">
        <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title">
                            <h1>Blogs Page</h1>
                            <p class="links"><a href="{{ route('frontend') }}">Home <i class="las la-angle-right"></i></a> Blog</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Blog Layout-2-->
    <section class="blog-layout-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @foreach ($blogs as $blog)
                        <!--post 1-->
                        <div class="post-list post-list-style2">
                            <div class="post-list-image">
                                <a href="{{ route('frontend.blog.single', $blog->id) }}">
                                    <img class="blog-thumbnail img-fluid"
                                        src="{{ asset('uploades/blog/') }}/{{ $blog->thumbnail }}"
                                        alt="blog thumbnail image">
                                </a>
                            </div>
                            <div class="post-list-content">
                                <h3 class="entry-title" style="max-width: 840px;">
                                    <a href="{{ route('frontend.blog.single', $blog->id) }}">{{ $blog->title }}</a>
                                </h3>
                                <ul class="entry-meta">
                                    @if ($blog->one_user->image == 'default.jpg')
                                        <li class="post-author-img"><img
                                                src="{{ Avatar::create($blog->one_user->name)->toBase64() }}"
                                                alt=""></li>
                                    @else
                                        <li class="post-author-img"><img
                                                src="{{ asset('uploades/profile/') }}/{{ $blog->one_user->image }}"
                                                alt=""></li>
                                    @endif
                                    <li class="post-author"> <a href="author.html">{{ $blog->one_user->name }}</a></li>
                                    <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span
                                                class="line"></span> {{ $blog->one_user->role }}</a></li>
                                    <li class="post-date"> <span class="line"></span>
                                        {{ Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }} </li>
                                </ul>
                                <div class="post-exerpt" style="max-width: 840px;">
                                    <p>{!! $blog->short_description !!}</p>
                                </div>
                                <div class="post-btn">
                                    <a href=" {{ route('frontend.blog.single', $blog->id) }} "
                                        class="btn-read-more">Continue Reading <i
                                            class="las la-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>



    <!--pagination-->
    <div class="pagination">
        <div class="container-fluid">
            <div class="pagination-area">
                <div class="row">
                    <div class="col-lg-12">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
