@extends('layouts.dashboardmaster')

@section('content')

@section('index-title')
    Request
@endsection

<x-breadcum title="Request"></x-breadcum>

<div class="row my-3">

    @forelse ($requests as $request)
        <div class="col-lg-4 col-xl-4">
            <!-- Simple card -->
            <div class="card">
                @if (isset($request->one_user) && $request->one_user->image == 'default.jpg')
                    <img style="width: 200px; height: 180px; object-fit: cover; margin: 10px auto; border-radius: 5px"
                        src="{{ asset('uploades/default/' . $request->one_user->image) }}" alt="">
                @elseif (isset($request->one_user))
                    <img style="width: 200px; height: 180px; object-fit: cover; margin: 10px auto; border-radius: 5px"
                        class="card-img-top img-fluid"
                        src="{{ asset('uploades/profile/' . $request->one_user->image) }}" alt="Card image cap">
                @else
                    <img style="width: 200px; height: 180px; object-fit: cover; margin: 10px auto; border-radius: 5px"
                        src="{{ asset('uploades/default/default.jpg') }}" alt="Default Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">Feedback</h5>
                    <p class="card-text">{{ $request->feedback }}</p>
                    <a href="{{ route('request.accept', $request->id) }}"
                        class="btn btn-primary waves-effect waves-light">Accept</a>
                    <a href="{{ route('request.cancel', $request->id) }}"
                        class="btn btn-danger waves-effect waves-light">Cancel</a>
                </div>
            </div>
        </div>
    @empty

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Request Not Available Now
        </div>
    @endforelse

</div>

@endsection

@section('script')
@if (session('sent_feedback'))
    <script>
        Toastify({
            text: "{{ session('sent_feedback') }}",
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
