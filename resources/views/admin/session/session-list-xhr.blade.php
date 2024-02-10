@foreach ($sessions as $session)
{{-- {{ dd($session) }} --}}
<div class="col-md-6 lg">
    <div class="lm_course-card card border-0 shadow h-100">
      <div class="card-img position-relative">
        <img src="{{ $session['thumbnail_img'] ?? asset('assets/images/courses2.jpg') }}" height="400px" width="500px">
        {{-- <div class="position-absolute top-0 end-0 mt-2 me-2"><span
          class="fw-normal badge bg-primary text-sm-16 rounded-4 title-font">Purchased</span>
        </div> --}}
        @if ($session['session_purchase_status'] == '1' && $type=='purchased')
        <div class="position-absolute top-0 end-0 mt-2 me-2">
          <span class="fw-normal badge bg-green text-sm-16 rounded-4 title-font"> Purchased</span>
        </div>
        @endif
                
        {{-- Admin Privacy badge --}}
        @if($session['status']<1)
        <div class="card-featured">
          <img src="{{ asset('assets/images/lock-sesssion.svg') }}" alt="">
        </div>
        @endif
      </div>
      <div class="card-body px-0 pb-0 pt-2">
        <div class="d-flex align-items-center gap-2 mb-2 justify-content-between">
          <h4 class="mb-0">
            
            @if($type=='all')<a class="text-dark" href="{{ route('admin.session.detail',['id'=>$session['id']]) }}">@endif
              {{ $session['session_name'] }}
                            
              @if($type=='purchased' && $session['session_purchase_status']==1)
              - {{ $session['session_purchase_duration'] }}
              @endif
              @if($type=='all')</a>@endif
        </h4>
        @if(Auth::user()->is_admin == 1)
          <div class="dropdown mt-1"><a
              class="dropdown-toggle" type="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"><span><img
                      class="in-svg"
                      src="{{asset('assets/images/dots-1.svg')}}"
                      alt=""></span></a>
              <ul class="dropdown-menu">
              
              <li> <a class="dropdown-item" onclick="GetSessionDeletModal({{ $session['id'] }})">Delete Session</a></li>
              </ul>
          </div>
        @endif
        </div>
        <p class="mb-2">{{ $session['short_description']}}
        </p>
        <div class="d-flex align-items-end justify-content-between gap-2">
          <div class="d-block">
            <span class="text-dark title-font">Coaches</span>
            <div class="avtar-group mt-1">
                @foreach ($session['coaches'] as $coach)
              <a class="avtar-55" onclick="ViewMemberProfile({{ $coach->id }})"><img src="{{ $coach->profile_image_url ?? asset('assets/images/ev1.jpg')}}" alt=""></a>
              @endforeach
            </div>
          </div>
          {{-- Button --}}
          {{-- {{ dd($session['session_purchase_duration']) }} --}}
          <div class="d-flex gap-2">
            @if($type=='all')
            <a class="btn btn--primary py-2" href="{{ route('admin.session.detail',['id'=>$session['id']]) }}">View Session </a>
            @endif
            @if(Auth::user()->id==1)
            <a class="btn btn--primary-outline text-primary py-2" href="{{ route('applied.user.list',['session_id'=>$session['id']]) }}">Applied User list</a>
            @endif
          </div>
          @if(Auth::user()->id==1)
          <a href="{{ route('admin.session.edit', ['id' => $session['id']]) }}">
            <span class="lm_pen" data-bs-toggle="tooltip" data-bs-original-title="Edit Session Overview">
              <img class="in-svg"  src="{{ asset('assets/images/pen.svg') }}" alt="">
            </span>
          </a>          
          @endif
          <span class="lm_pen" data-bs-toggle="tooltip" data-bs-original-title="Share The Session">
            <a  onclick="OpenShareSessionModal('{{ route('admin.session.detail', ['id' => $session['id']]) }}')">
              <img class="in-svg"  src="{{ asset('assets/images/share.svg') }}" alt="">
            </a>
          </span>
        </div>
       </div>
    </div>
  </div>
  @endforeach
  <script>
    $(document).ready(function(){
      jQuery('.in-svg').each(function (i, e) {
          var $img = jQuery(e);
          var imgID = $img.attr('id');
          var imgClass = $img.attr('class');
          var imgURL = $img.attr('src');
          jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg'); // Add replaced image's ID to the new SVG

            if (typeof imgID !== 'undefined') {
              $svg = $svg.attr('id', imgID);
            } // Add replaced image's classes to the new SVG


            if (typeof imgClass !== 'undefined') {
              $svg = $svg.attr('class', ' ' + imgClass + ' replaced-svg');
            } // Remove any invalid XML tags as per http://validator.w3.org


            $svg = $svg.removeAttr('xmlns:a'); // Replace image with new SVG

            $img.replaceWith($svg);
          }, 'xml');
        });
    });
    
    function GetSessionDeletModal(delete_session_id)
    {
        $("#delete_session_id").val(delete_session_id);
        $('#DeleteSessionModal').modal('show');
    }

    function delete_session() {
        let _token = $("input[name=_token]").val();
        var id = $("#delete_session_id").val();
        let url = '{{ route("admin.session.delete", ":id") }}';
        url = url.replace(':id', id);
    
        $.ajax({
            url: url
            , method: "delete"
            , data: {
                _token: _token
                , id: id
            }
        }).done(function(data) {
                                
            if (data.error)
            {
                var error_message = data.message;                                    
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: error_message ,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: false,
                    // footer: '<a href="">Click to open</a>',
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }); 
                
                return false;
                        
            } else if (data.status == "200") {
                var success_message = data.message;                                    
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: success_message ,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    // footer: '<a href="">Click to open</a>',
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });  
                // window.location.reload();   
                getSessionLists('all',1);                      
            }
                    
            $("#delete_session_id").val('');
            $('#DeleteSessionModal').modal('hide');
            $('.modal-backdrop').remove(); // Remove the modal backdrop
            $('body').removeClass('modal-open'); // Remove the 'modal-open' class from the body           
            
        });
    }
  </script>