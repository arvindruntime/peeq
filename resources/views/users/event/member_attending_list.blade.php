@extends('layouts.admin.master')
@section('content')
{{-- <script type="text/javascript">
  var event_id = '{{ request()->query('id') }}';
</script> --}}
<main class="main-content auto-load" id="main">
    <section class="lm__dash-con lm__member-con"><span class="lm_vec"><img class="light" src="assets/images/light.png"
                alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
        <div class="container">
            <div class="lm__member">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-primary fw-semibold">RSVP's</h4>
                        <ul class="nav nav-tabs lm__member-tab gap-2 gap-sm-4" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ (request()->query('type')=='going') ? 'active' : '' }}" onclick="getMembersList({{ request()->query('id') }},'going')" id="home-tab"
                                    data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab"
                                    aria-controls="top" aria-selected="true">Going</button>
                            </li>
                            
                           @if(Auth::user()->is_admin==1)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ (request()->query('type')=='not_going') ? 'active' : '' }}" onclick="getMembersList({{ request()->query('id') }},'not_going')" id="newest-tab"
                                    data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab"
                                    aria-controls="top" aria-selected="false">Not Going</button>
                            </li>
                        @endif
                            
                        </ul>
                        <div class="tab-content mt-sm-3">
                            <div class="tab-pane active member-data" id="top" role="tabpanel" aria-labelledby="top-tab"
                                tabindex="0">
                                @include('users.event.member_attending_xhr')
                            </div>
                            <div id="no-records" style="display: none;">{{ $no_records }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
  function getMembersList(event_id,type='going') {
      var ENDPOINT = "{{ route('events.rsvp.list') }}";
      if(event_id!=''){
        window.location.href=ENDPOINT +"?id="+event_id+"&type=" +type; 
      }
    }
</script>
@endsection
