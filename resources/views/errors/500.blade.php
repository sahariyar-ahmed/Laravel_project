@extends('layouts.master')


@section('content')
<div class="row justify-content-center">
    <div class="col-xl-4 col-md-5">
        <div class="card">
            <div class="card-body p-4">

                <div class="text-center w-75 mx-auto auth-logo mb-4">
                    <a class='logo-dark'  href="{{ route('frontend') }}">
                        <span><img src="{{asset('frontend')}}/assets/img/other/500-error.svg" alt="" height="22"></span>
                    </a>

                    <a class='logo-light'  href="{{ route('frontend') }}">
                        <span><img src="assets/images/logo-light.png" alt="" height="22"></span>
                    </a>
                </div>

                <div class="text-center w-50 mx-auto my-4">
                    <img src="assets/images/500-error.svg" title="invite.svg">
                </div>

                <h3 class="text-center mb-4 mt-3">Internal Server Error</h3>

                <p class="text-muted text-center mt-3">We are experiencing an internal server problem, please try back later.</p>
                <div class="mt-4 text-center">
                    <a class='btn btn-primary w-100'  href="{{ route('frontend') }}">Back to Home</a>
                </div>

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->
    </div> <!-- end col -->
@endsection
