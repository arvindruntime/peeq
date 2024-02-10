           @foreach($welcomeChecklists as $div)
            @php 
            $status ='lm_disable';
            if($div['status']=='active')
            {
              $status = 'inactive';
            }
            @endphp
            
            <div class="lm_dash-card card border-0 p-3 mb-4 {!! $status !!}">
              <div class="d-flex">
                <div class="d-block pe-3"><img src="{!! $div['img_url'] !!}" alt=""></div>
                <div class="d-block w-100">
                  <div class="lm_dash-card-con d-block w-60">
                    <h5 class="mb-1">{!! $div['title']!!}</h5>
                    <p class="mb-2">{!! $div['description'] !!}</p>
                  </div>
                  <div class="lm_dash-card-con text-end">
                    <button class="btn btn--primary modal_popup" type="button" data-bs-toggle="offcanvas" data-id="{{ Auth::user()->id }}" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight1">{!! $div['button_title'] !!}</button>
                    
                  </div>
                </div>
              </div>
            </div>
            
            @endforeach 