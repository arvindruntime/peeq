@extends('layouts.master')
@section('content')

<header class="lm__header-logo">
    <div class="container-fluid">
        <div class="row">
            <div class="col"> <a class="lm-logo" href="{{config('app.url')}}/"><img class="in-svg" src="{{ asset('assets/images/logo.svg')}}" alt=""></a>
            </div>
        </div>
    </div>
</header>
<main class="main-content" id="main">
   
    <section class="lm__hero lm__plan-hero">
        <div class="lm__plan">
            <div class="container">
                <div class="row lm__choose-plan">
                    <div class="lm__plan-inner">
                        <div class="col col-lg-8 mx-auto">
                            <div class="lm__card-main card text-center p-4 border-0">
                                <div class="row justify-content-center">
                                    <div class="col-12 mb-3">
                                        <div class="lm__card card text-center border-0">
                                            <div class="card-header border-0">
                                                <h2 class="text-white">Select Your Membership</h2>
                                                <p class="text-white">Membership to <a
                                                    class="fw-bold text-white" href="#">PEEQ</a> gives you access to all <a class="fw-bold text-white" href="#">PEEQ</a> live events, Masterclasses and webinars and an exclusive global network of leaders focused on developing EQ and performance culture.</p>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    @foreach ($plans as $plan)
                                    <div class="col-lg-6 mb-3">
                                        <div class="lm__card text-start card p-3">
                                            <div class="card-body p-0">
                                                <h5 class="text-white">{{$plan['plan_title']}}</h5>
                                                <p class="text-white mb-2">{!! $plan['plan_description'] !!}</p>
                                                <ul class="lm-list list-group list-group-flush moretext">
                                                    <li class="list-group-item d-flex"><span class="me-2"><img
                                                                class="in-svg" src="assets/images/check-fill.svg"
                                                                alt=""></span>Live Masterclasses, webinars and group coaching with experts </li>
                                                    <li class="list-group-item d-flex"> <span class="me-2"><img
                                                                class="in-svg" src="assets/images/check-fill.svg"
                                                                alt=""></span>Exclusive content and EQ resources </li>
                                                    <li class="list-group-item d-flex"> <span class="me-2"><img
                                                                class="in-svg" src="assets/images/check-fill.svg"
                                                                alt=""></span>Access 1-2-1 coaching </li>
                                                    <li class="list-group-item d-flex"> <span class="me-2"><img
                                                                class="in-svg" src="assets/images/check-fill.svg"
                                                                alt=""></span>Connect with a global network of leaders </li>
                                                    <li class="list-group-item d-flex"> <span class="me-2"><img
                                                                class="in-svg" src="assets/images/check-fill.svg"
                                                                alt=""></span>Access EQ and leadership online programs and courses </li>
                                                    {{-- <li class="list-group-item d-flex"> <span class="me-2"><img
                                                                class="in-svg" src="assets/images/check-fill.svg"
                                                                alt=""></span>Ipsum dolor sit amet consectetur.
                                                        Sagittis eu.</li>
                                                    <li class="list-group-item d-flex"> <span class="me-2"><img
                                                                class="in-svg" src="assets/images/check-fill.svg"
                                                                alt=""></span>Lorem ipsum dolor sit</li> --}}
                                                </ul>
                                            </div>
                                            <div class="lm_card-btn d-flex justify-content-end mt-3">
                                                {{-- <div class="lm_price text-white"><span>Starting At</span>
                                                    <p class="mb-0 fw-bold text-primary">${{ $plan['plan_amount']}} <span
                                                            class="text-sm fw-normal text-white">{{$plan['plan_type']}}</span>
                                                    </p>
                                                </div> --}}
                                                {{-- <a class="btn btn--primary" href="{{route('paymentPlans.get',$plan->id)}}"> Proceed</a> --}}
                                                @if($planExpire == 0)
                                                <a class="btn btn--primary" onclick="choosePlan({{ $plan->id }})"> Free for 12 Months </a>
                                                @else
                                                <a class="btn btn--primary" onclick="choosePlan({{ $plan->id }})"> ${{ $plan->plan_amount }} </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col col-12 text-center mt-3"><a
                                            class="moreless-button d-flex justify-content-center">View Plan Details
                                            <span> <img class="in-svg" src="assets/images/arrow.svg" alt=""></span></a>
                                    </div>
                                </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    function choosePlan(plan_id) {
        let _token = $("meta[name=csrf-token]").attr("content");
        
        var url = "{{route('plan.transaction')}}";

        $.ajax({
            url: url
            , type: "POST"
            , data: {
                plan_id: plan_id
                , payment_status: 1
                , _token: _token
            , }
            , dataType: 'JSON'
            , success: function(data) {

                if (data.error) {
                    return false;
                } else if (data.status == "200") {
                    
                    window.location = "{{route('dashboard.welcomepopup')}}";

                }
            }
        });
    }
</script>
@endsection