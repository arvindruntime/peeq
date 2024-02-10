
 @foreach ($event_activity as $member)
{{-- {{ dd($member['user']) }} --}}
<div class="lm__member-card mb-3 member-data">
    <div class="card shadow p-3 border-0">
        <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
            <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                <div class="avtar-xxl shadow">
                    <img class="rounded-circle position-relative"
                        src="{{ ($member['user']->profile_image_url) ?? asset('assets/images/member-1.jpg')}} "
                        alt="">
                </div>
                <div class="d-block">
                    <h6 class="mb-0 text-dark" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight10" aria-controls="offcanvasRight10"> {{ $member['user']['first_name'] }}</h6>
                    <p class="title-font mb-0">{{ $member['user']['user_type'] }}</p>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endforeach 
