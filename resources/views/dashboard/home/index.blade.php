@extends('layouts.dashboardmaster')


@section('content')


@section('index-title')
    Dashbord
@endsection

<x-breadcum title="Dashbord"></x-breadcum>

@if (  auth()->user()->role == 'user' )

    <div class="row">
        @if (!$request)
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Do You Sent Request</h4>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <i class="mdi mdi-help-circle me-1 text-primary"></i> Do you want to be a blogger
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">
                                    <div class="card-body">
                                        <form role="form"  action="{{ route('request.sent', Auth::user()->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="exampleInputEmail1" class="form-label">Feedback</label>
                                                <textarea  name='feedback' class="form-control" id="example-textarea" rows="5"></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Send Request</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion -->
                </div>
                <!-- end card body -->
            </div>
        @endif
    </div>

@endif


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
