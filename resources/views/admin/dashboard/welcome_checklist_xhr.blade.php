@php
    $progress_dash = "";
    $active = ""; 
    $step2Status ="";   
    $progress = '100%';
    if($welcomeChecklists['welcomeChecklists']['1']['status'] == 'active') {
        //$progress = (33 * 2) .'%';
        $progress_dash = "progress-dash";
        $active = "active";
    }
    if($welcome_checklist_complete==1) {
        //$progress = (33 * 2) .'%';
        $progress_dash = "progress-dash";
        $step2Status = "active";
    }
    
    // dd($welcome_checklist_complete);
    // if($welcomeChecklists['welcomeChecklists']['2']['status'] == 'active') {
    //     $progress = (33 * 3) .'%';
    // }
   
@endphp
{{-- {{ dd($welcomeChecklists['1']) }} --}}
    
<div class="progress-container">    
    <div class="{{ $progress_dash }}" id="progress_step_path" style="height:{{ $progress }}"></div>
    <ul class="step-progress">
      <li class="step1 active_step"><span class="circle2 steps-completed1 {{ $active }}">1</span></li>
      <li class="step2 active_step"><span class="circle2 steps-completed2 {{ $step2Status }}">2</span></li>
      {{-- <li class="step3"><span class="circle2 steps-completed3 {{ $welcomeChecklists['welcomeChecklists']['2']['status'] }}">3</span></li> --}}
      {{-- <li class="step4"><span class="circle2 steps-completed4 {{ $welcomeChecklists['welcomeChecklists']['2']['status'] }}">4</span></li> --}}
    </ul>
</div>
  
  
    @php $countNumber = 1; @endphp
    
    {{-- {{ dd($welcomeChecklists) }} --}}
@foreach($welcomeChecklists['welcomeChecklists'] as $div)
    @php 
    $status ='lm_disable';
    if($div['status']=='active')
    {
    $status = 'active';
    }
    @endphp
    <div class="lm_dash-card card border-0 p-3 mb-4 welcomeList{{ $countNumber }} {!! $status !!}">
    <div class="d-flex">
        <div class="d-block pe-3"><img src="{!! $div['img_url'] !!}" alt=""></div>
        <div class="d-block w-100">
        <div class="lm_dash-card-con d-block w-60">
            <h5 class="mb-1">{!! $div['title']!!}</h5>
            <p class="mb-2">{!! $div['description'] !!}</p>
        </div>
        <div class="lm_dash-card-con text-end">                                                    
            
        <button class="btn btn--primary" type="button" data-bs-toggle="offcanvas" data-id="{{ Auth::user()->id }}" data-bs-target="#offcanvasRight{{ $countNumber }}" aria-controls="offcanvasRight{{ $countNumber }}">{!! $div['button_title'] !!}</button>
          
        </div>
        </div>
    </div>
    </div>
    @php $countNumber = $countNumber+1; @endphp
@endforeach