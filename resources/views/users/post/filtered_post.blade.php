@extends('layouts.admin.master')
@section('content')

<style type="text/css">
  /* .ajax-load{
    padding: 10px 0px;
    width: 100%;
  } */
  .errorClass { border:  1px solid red !important;}
  
</style>
<input type="hidden" id="PostUrl" value="{{ route('posts.index') }}" />
  <section class="lm__dash-con lm__create-post auto-load"><span class="lm_vec"><img class="light" src="{{ asset('assets/images/light.png') }}" alt=""><img class="dark" src="{{ asset('assets/images/dark.png') }}" alt=""></span>
    <div class="container">
      <div class="row">
        <div class="col-12"> 
            <h3 class="mb-0"> 
              @if($_GET['type'] =="is_hide_post")
              Hide Posts
              @elseif($_GET['type'] =="is_save")
              Saved Posts
              @endif
            </h3>
          </div>
        <div class="col col-md-7 col-xxl-6 lm_post-card">
          <div class="lm_post-card">
            
        </div>
        
        <div class="lm_post-card lm_card-post my-4" id="post-data">
          {{-- @include('users.post.filtered_post_xhr') --}}
        </div>
        
        {{-- <div class="ajax-load text-center lm_post-card lm_card-post my-4" style="display:none">
          <div class="spinner-border text-warning" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div> --}}
        
        
        
        </div>
        <div class="col col-md-5 col-xxl-4 mb-4 auto-load" id="right-section">
          @include('users.post.right_panel')
        </div>
        
      </div>
    </div>
  </section>



  <div class="modal fade" id="blockMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
      <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
          <div class="modal-header p-0">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
          </div>
          <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg" src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
          <div class="z-index-1 position-relative lm_mxw50">
            <h4 class="text-white">Block Member</h4>
            <h6 class="text-white">You will no longer receive notifications or private messages from this member. You also won’t see their posts in your Activity Feed.</h6>
            <button class="btn btn--primary mt-3">Confirm</button>
            <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="reportMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
      <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
          <div class="modal-header p-0">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
          </div>
          <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg" src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
          <div class="z-index-1 position-relative lm_mxw50">
            <h4 class="text-white">Report This Member</h4>
            <div class="d-flex justify-content-center">
              <ul class="text-start"> 
                <li class="px-3"> 
                  <div class="lm__term mb-3">
                    <label class="lm-check-term ps-4 mb-0 lh-1 text-white">They're posting spam
                      <input type="checkbox"><span class="checkmark"></span>
                    </label>
                  </div>
                </li>
                <li class="px-3"> 
                  <div class="lm__term mb-3">
                    <label class="lm-check-term ps-4 mb-0 lh-1 text-white">They're being offensive
                      <input type="checkbox"><span class="checkmark"></span>
                    </label>
                  </div>
                </li>
                <li class="px-3"> 
                  <div class="lm__term mb-3">
                    <label class="lm-check-term ps-4 mb-0 lh-1 text-white">They're pretending to be someone else
                      <input type="checkbox"><span class="checkmark"></span>
                    </label>
                  </div>
                </li>
              </ul>
            </div>
            <button class="btn btn--primary mt-3">Confirm</button>
            <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
      <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
          <div class="modal-header p-0">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
          </div>
          <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg" src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
          <div class="z-index-1 position-relative lm_mxw50">
            <h4 class="text-white">Mute Post</h4>
            <h6 class="text-white">Are you sure you want to mute this post?.</h6>
            <button class="btn btn--primary mt-3 confirm_mute_post" onclick="OpenConfirmModalFinal()">Confirm</button>
            <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="hidePostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
      <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
          <div class="modal-header p-0">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
          </div>
          <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg" src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
          <div class="z-index-1 position-relative lm_mxw50">
            <h4 class="text-white">Hide post from Feed</h4>
            <h6 class="text-white">Are you sure you want to hide this post from active feed?.</h6>
            <button class="btn btn--primary mt-3 confirm_mute_post" onclick="OpenConfirmModalFinal()">Confirm</button>
            <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
      <div class="modal-content overflow-hidden">
        <div class="modal-body p-4 text-center position-relative">
          <div class="modal-header p-0">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
          </div>
          <div class="d-flex justify-content-center lm_mxw50">
            <div class="z-index-1 position-relative">
              <h4 class="text-start text-white">Report This Post</h4>
              <div class="d-flex justify-content-start">
                <ul class="text-start"> 
                  <li>
                    <div class="lm__term mb-3">
                      <label class="lm-check-term ps-4 mb-0 lh-1 text-white">It’s Spam
                        <input type="checkbox" name="reportPostReason" value="It’s Spam"><span class="checkmark"></span>
                      </label>
                    </div>
                  </li>
                  <li>
                    <div class="lm__term mb-3">
                      <label class="lm-check-term ps-4 mb-0 lh-1 text-white">It’s Offensive
                        <input type="checkbox" name="reportPostReason" value="It’s Offensive"><span class="checkmark"></span>
                      </label>
                    </div>
                  </li>
                  <li>
                    <div class="lm__term mb-3">
                      <label class="lm-check-term ps-4 mb-0 lh-1 text-white">A different Reason
                        <input type="checkbox" name="reportPostReason" value="A different Reason"><span class="checkmark"></span>
                      </label>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="lm_report d-flex justify-content-start">
                <div class="d-block my-3"> 
                  <textarea class="form-control" name="reportPostDescription" id="reportPostDescription" rows="2" placeholder="Add Description"></textarea>
                </div>
              </div>
              <button class="btn btn--primary mt-3" id="reportPost">Confirm</button>
              <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    var filter_type = '{{$_GET["type"]}}';
    getData(filter_type);
  });     
      
    function getActivitiesPosts(post_id = '', param = '', postType = '') {
        let _token = $("input[name=_token]").val();

        console.log(param);

        $.ajax({
            url: "{{route('post_activity_action')}}"
            , type: "POST"
            , data: {
                post_id: post_id
                , param: param
                , type: postType
                , _token: _token
            , }
            , dataType: 'JSON'
            , success: function(data) {
                window.location.reload();
                // getData();

                if (data.error) {
                    // printErrorMsg(data.error);
                    return false;
                } else if (data.status == "200") {

                }
            }
        });
    }
    

    function addOpenClass()
    {
      $('.dropdown dropdown-submenu toggler').addClass('open');
    }
  
  function update_post_type(param='post')
  {
    $('#post_type').val(param);
    $('.print-error-msg').html('');
    
    console.log($('#post_type').val());
    if(param == 'post') {
      $('.content_error').html('');
      $('.print-error-msg').html('');
    } 
    if(param == 'article') {
      $('.article_content_error').html('');
      $('.print-error-msg').html('');
    }    
  }
  
  function getData(type='')
  {
    $.ajax(
	        {
	            url: '{{ route("posts.filtered") }}?type=' + type,
	            type: "get",
	            beforeSend: function()
	            {
	                $('.ajax-load').show();
	            }
	        })
	        .done(function(data)
	        {          
	            if(data.html == " "){
	                $('.ajax-load').html("No more records found");
	                return;
	            }
	            $('.ajax-load').hide();
	            $("#post-data").html(data.html);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              alert('server not responding...');
                
	        });
  }

	var page = 1;
  //loadMoreData(page);
	$(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
	        page++;
	        //loadMoreData(page);
	    }   
	});
       
        
	function loadMoreData(page){
    
    var start = Number($('#start').val());
   var allcount = Number($('#totalrecords').val());
   var rowperpage = Number($('#rowperpage').val());
   start = start + rowperpage;

   if(start <= allcount){
      $('#start').val(start);
      
      
	    $.ajax(
	        {
	            url: '{{ route("posts.filtered") }}?type=' + 'is_save',
	            type: "get",
	            beforeSend: function()
	            {
	                $('.ajax-load').show();
	            }
	        })
	        .done(function(data)
	        {
            // console.log(data);
	            if(data.html == " "){
	                $('.ajax-load').html("No more records found");
	                return;
	            }
	            $('.ajax-load').hide();
	            $("#post-data").append(data.html);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
            console.log('Server error occured');
	        });
    }
	}


function formatDate(date_temp='') {
  var input = document.getElementById(date_temp);
  var date = new Date(input.value);
  
  // Adjust for time zone offset
  var timeZoneOffset = date.getTimezoneOffset() * 60000;
  date.setTime(date.getTime() - timeZoneOffset);
  
  var formattedDate = date.toISOString().replace("T", " ").slice(0, -5);
  
  var input_date = date_temp.replace("_temp", "");
  $("#"+input_date).val(formattedDate);
}

  function copy_post(){
    var text = $('#PostUrl').val();  // Get the text of the element
      var tempInput = $('<input>');    // Create a temporary input element
      $('body').append(tempInput);     // Append the temporary input element to the document
      tempInput.val(text).select();    // Set the value of the temporary input element to the text and select it
      document.execCommand('copy');    // Copy the selected text to the clipboard
      tempInput.remove();              // Remove the temporary input element from the document
  }
 
</script>
      
      
      
      
      

        
        