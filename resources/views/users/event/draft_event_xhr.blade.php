@php
    use Carbon\Carbon;
@endphp
@foreach ($events as $event)
{{-- {{ dd($event) }} --}}
    <div class="lm__event-card mb-3">
        <div class="card shadow p-3 border-0 rounded-4">
            <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                <div class="d-sm-flex align-items-center gap-2 mb-2 mb-sm-0 w-100">
                    <div class="event-img"><img class="position-relative"
                            src="{{ $event->upload_thumbnail ?? asset('assets/images/event-img-01.jpg') }}" alt=""></div>
                    <div class="d-block w-100 mt-3 mt-sm-0">
                        {{-- <p class="title-font mb-0 text-primary">{{ $event->start_date }} </p> --}}
                        <h4 class="mb-0 text-dark">
                            <a class="dropdown-item" onclick="fetchEventToUpdate({{ $event->id }})">{{ $event->event_title }}</a>
                            </h4>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-block w-100">
                                <div class="d-flex flex-wrap gap-3 align-items-center py-2">
                           
                                    <div class="d-flex gap-1 align-items-center">
                                        {{-- <span class="text-sm-12">{{ date('d-M-Y h:s',strtotime($event['start_date'])) }}</span> --}}
                                        <span class="text-sm-12 d-flex align-items-center">
                                            <span class="pe-1"> 
                                                <img class="in-svg" src="{{asset('assets/images/calender-01.svg')}}" alt="">
                                            </span>
                                            {{ \Carbon\Carbon::parse($event['start_date'])->format('d-M-Y H:s') }}
                                        </span>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach