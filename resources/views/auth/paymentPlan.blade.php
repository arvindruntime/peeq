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
    <section class="lm__hero">
        <div class="lm__hero--inner">
            <div class="container">
                <div class="row lm__payment">
                    <div class="col col-lg-6 mx-auto mt-5">
                        <div class="lm__login--box text-start mt">
                            <div class="lm__login-title d-flex justify-content-between align-items-center">
                                <h2>Payment</h2>
                                <h6> <a class="fw-bold text-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal1">Sign out</a></h6>
                            </div>
                            <div class="lm__card card py-4 px-3 mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="text-white fw-bold">What you’ll pay</h6>
                                </div>
                                <div class="d-flex justify-content-between text-start">
                                    <p class="mb-3 text-white">PEEQ <br>{{$plan['plan_title']}}</p>
                                    <div class="lm_price">
                                        <h6 class="text-primary mb-0 fw-bold">$ {{$plan['plan_amount']}}</h6>
                                        <p class="mb-3 text-light">/ {{$plan['plan_type']}}</p>
                                    </div>
                                </div>
                                <p class="mb-1 text-light">{{$plan['plan_type']}} subscription starting<br>{{$plan->created_at->format('D M d, Y')}}</p>
                                <hr class="my-3">
                                <div class="d-flex justify-content-between text-start">
                                    <p class="mb-2 text-white fw-bold">Due Today</p>
                                    <div class="lm_price">
                                        <h6 class="text-primary mb-0 fw-bold">$0.00</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between text-start">
                                    <p class="text-sm mb-0 text-light">Due Later</p>
                                    <div class="lm_price">
                                        <p class="mb-0 text-light">$ {{$plan['plan_amount']}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="lm__login-form payment">
                                {{-- <h5 class="text-white fw-bold">Credit Card Details</h5> --}}

                                <form>
                                    {{-- <div class='form-row row'>
                                        <div class="col col-md-12">
                                            <input type="text" id="fullNameID" class="form-control" name="fullName" placeholder="Name On Card">
                                            <label><span class="hidden-xs fullNameID text-danger" role="alert"></span> </label>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class="col col-md-12">
                                            <input type="text" id="cardNumberID" class="form-control" name="cardNumber" placeholder="Card Number">
                                            <label><span class="hidden-xs cardNumberID text-danger" role="alert"></span> </label>
                                        </div>
                                        <input id="planAmountID" name="planAmount" type="hidden" value="{{$plan['plan_amount']}}">
                                    </div>
                                    <div class='form-row row'>
                                        
                                        <div class='col col-md-6'>

                                            <div class="input-group">
                                                <select class="form-control" id="monthID" name="month">
                                                    <option value="">MM</option>
                                                    @foreach(range(1, 12) as $month)
                                                    <option value="{{$month}}">{{$month}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label><span class="hidden-xs monthID text-danger"></span> </label>
                                        </div>

                                        <div class='col col-md-6'>   
                                            <div class="input-group">
                                                <select class="form-control" id="yearID" name="year">
                                                    <option value="">YYYY</option>
                                                    @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                    <option value="{{$year}}">{{$year}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label><span class="hidden-xs yearID text-danger"></span> </label>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col col-md-6'>
                                            <div class="form-group">
                                                <input type="number" id="cvvID" class="form-control" placeholder="CVV" name="cvv">
                                                <label><span class="hidden-xs cvvID text-danger"></span> </label>
                                            </div>
                                        </div>

                                        <div class="col col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" id="countryID" name="country">
                                                    <option value="">---Select Country---</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                                    @endforeach
                                                </select>
                                                <label><span class="hidden-xs countryID text-danger"></span> </label>
                                            </div>
                                        </div>
                                    </div> --}}

                                        {{-- <div class="col col-md-12 text-center my-3 mt-2"><a
                                                class="moreless-button d-flex justify-content-center">Have a
                                                Referral Code <span> <img class="in-svg"
                                                        src="{{ asset('assets/images/arrow.svg') }}" alt=""></span></a></div>

                                        <div class="col col-md-12 moretext">
                                            <div class="lm__form-input mb-4"> <input class="form-control"
                                                    type="text" placeholder="Code"></div>
                                        </div> --}}

                                        <div class="col col-md-12">
                                            <div class="d-flex align-items-center mb-3"> <img class="in-svg"
                                                    src="{{asset('assets/images/lock1.svg')}}" alt="">
                                                <p class="text-light mb-0 ms-1">Card information is stored on a
                                                    secure server</p>
                                            </div>
                                        </div>

                                        <div class="col col-md-12">
                                            <div class="lm__form--button"> <a href="{{ $stripe_payment_int_url }}" class="btn btn--primary w-100">Pay Now (${{$plan['plan_amount']}})</a></div>
                                            {{-- btn-submit --}}
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-2">
        <div class="modal-content">
            <div class="modal-body p-4 text-center">
                <div class="lm__term--title">
                    <h3 class="mb-2 fw-bold">Are you sure you want to sign out?</h3>
                </div>
                <div class="lm__term--button"> <button class="btn btn--primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Yes, Sign Out</button><button
                        class="close-button" type="button" data-bs-dismiss="modal">Cancel</button></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-2">
        <div class="modal-content">
            <div class="modal-body p-4 text-center"><span class="mb-2"><img class="in-svg mx-auto"
                        src="{{asset('assets/images/CheckCircle.svg')}}" alt=""></span>
                <div class="lm__term--title">
                    <h3 class="my-2 fw-bold">Payment Success!</h3>
                    <p class="text-light mb-2">@lang('app.op.success_pop_message')</p>
                </div>
                <div class="lm__term--button mt-3"> <button class="btn btn--primary me-0" onclick="window.location='{{ url("dashboard") }}'">Go to Dashboard</button></div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
<script type="text/javascript">
  
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    $(".btn-submit").click(function(e){
    
        e.preventDefault();
     
        var fullName = $("#fullNameID").val();
        var cardNumber = $("#cardNumberID").val();
        var planAmount = $("#planAmountID").val();
        var month = $("#monthID").val();
        var year = $("#yearID").val();
        var cvv = $("#cvvID").val();
        var country = $("#countryID").val();

        if(fullName == '' || cardNumber == '' || month == '' || year == '' || cvv == '' || country == '') {

            if(fullName=='')
            {
                $('.fullNameID').html('Please enter the name on card');
            }
            else
            {
                $('.fullNameID').html('');
            }

            if(cardNumber=='')
            {
                $('.cardNumberID').html('Please enter the card number');
            }
            else
            {
                $('.cardNumberID').html('');
            }

            if(month=='')
            {
                $('.monthID').html('Please select the month');
            }
            else
            {
                $('.monthID').html('');
            }

            if(year=='')
            {
                $('.yearID').html('Please select the year');
            }
            else
            {
                $('.yearID').html('');
            }

            if(cvv=='')
            {
                $('.cvvID').html('Please enter the cvv number');
            }
            else
            {
                $('.cvvID').html('');
            }

            if(country=='')
            {
                $('.countryID').html('Please select the country');
            }
            else
            {
                $('.countryID').html('');
            }

            return true;
        } else {
                $.ajax({
                type:'POST',
                url:"{{ route('stripe.post') }}",
                data:{fullName:fullName, cardNumber:cardNumber, planAmount:planAmount, month:month, year:year, cvv:cvv, country:country, _token:"{{ csrf_token() }}"},
                success:function(data){
                        if($.isEmptyObject(data.error)){
                            $('#exampleModal2').modal('show');
                        }else{
                            printErrorMsg(data.error);
                        }
                }
            });
        }
    
    });

</script>
@endpush
