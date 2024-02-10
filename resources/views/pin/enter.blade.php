@extends('layouts.admin.master')
@section('content')

<main class="main-content auto-load" id="main">
    <section class="lm__dash-con lm__event-con"><span class="lm_vec"><img class="light"
                src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border-0 shadow p-4 rounded-4 enterpin_card">
                    <p >Course section is currently invite only please check back soon. </p>
                    <p>PEEQ Support </p>

                    @if(session('error'))
                        <p style="color: red;">{{ session('error') }}</p>
                    @endif

                    <form method="GET" action="{{ route('process.pin.submission') }}">
                        @csrf
                        <div class="d-flex gap-2">
                            <input class="form-control shadow py-2" type="password" name="code" id="code" placeholder="Enter The Pin">
                            <button class="btn btn--primary py-2" type="submit">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection