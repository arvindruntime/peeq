@extends('layouts.admin.master')
@section('content')

<style>
  .btn-follow.active{
    border: 1px solid #E3A130;
    background: #E3A130;
}

.btn-follow{
    border: 1px solid #0d2137;
    background: #0d2137;
}
</style>
<main class="main-content auto-load" id="main"> 
    <section class="lm__dash-con lm__member-con"><span class="lm_vec"><img class="light" src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
      <div class="container">
        <div class="lm__member">
          <div class="row">
            <div class="col-12"> 
              <h4 class="text-primary fw-semibold">Members</h4>
              <ul class="nav nav-tabs lm__member-tab gap-2 gap-sm-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" onclick="getMembersList('all')" id="home-tab" data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab" aria-controls="top" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" onclick="getMembersList('newest')" id="newest-tab" data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab" aria-controls="top" aria-selected="false">Newest</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" onclick="getMembersList('coach')" id="newest-tab" data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab" aria-controls="top" aria-selected="false">Coaches</button>
                </li>
                {{-- <li class="nav-item" role="presentation">
                  <button class="nav-link" onclick="getMembersList('all','newest')" id="hosts-tab" data-bs-toggle="tab" data-bs-target="#hosts" type="button" role="tab" aria-controls="hosts" aria-selected="false">Hosts</button>
                </li> --}}
                {{-- <li class="nav-item" role="presentation">
                  <button class="nav-link" id="onlinenow-tab" data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab" aria-controls="top" aria-selected="false">Online Now</button>
                </li> --}}
                <li class="nav-item" role="presentation">
                  <button class="nav-link" onclick="getMembersList('blocked')" id="blockeduser-tab" data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab" aria-controls="top" aria-selected="false">Blocked User</button>
                </li>
              </ul>
              
              <div class="tab-content mt-sm-3">
                {{-- <div id="loader-container-members" class="loader-container">
                  <div class="loader"></div>
                </div> --}}
                <div class="tab-pane active member-data" id="top" role="tabpanel" aria-labelledby="top-tab" tabindex="0">
                  @include('users.member.member_list_xhr')
                </div>
                <div class="mt-3">
                  <div class="d-flex justify-content-end">
                    {{-- {{ $memberLists->links('pagination::bootstrap-4') }} --}}
                    {{-- {!! $memberLists->appends(['user_type' => 'newest'])->links('pagination::bootstrap-4') !!} --}}
                  </div>
                </div>
                {{-- <div id="no-records" style="display: none;"><!-- Inside your Blade file -->
                  <p>{{ $no_records }}</p>
                </div> --}}
              </div>
              
              
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
    
  <script>        
    function memberActivityAction(type='',member_id='',is_follow='',is_block_member='',tab_type='') {
        let _token = $("input[name=_token]").val();
        var dataArray = {
                  type: type,
                  _token: _token
                };
        if(type=="follow")
        {
          dataArray.followers = member_id;
          dataArray.is_follow = is_follow;
        }
        if(type=="block")
        {
          dataArray.block_user_id = member_id;
          dataArray.is_block_member = is_block_member;
        }
        if(is_block_member==1)
        {
          // type = "all";
          //type = "blocked";
        }
        if(type=="host")
        { 
          dataArray.followers = member_id;
          dataArray.is_follow = is_follow;        
        }
            $.ajax({
                url: "{{route('member.activity.action')}}"
                , type: "POST"
                , data: dataArray
                , dataType: 'JSON',
                beforeSend: function() {
                    console.log('ajax-load show called');
                    //showLoader();
                }
                , success: function(response) {                                    
                    if (response.error) {
                        return false;
                    } else if (response.status == "200") {
                        var success_message = response.message;
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
                        
                        if(type=="follow" && response.data.is_follow==1)
                        {
                          $('.memberId'+member_id).html('Following');
                          $(".memberId" + member_id).attr("onclick", "memberActivityAction('follow'," + member_id + ",0,1,'"+tab_type+"')");
                          $('.memberId'+member_id).addClass('active');
                        }
                        else if(type=="follow" && response.data.is_follow==0){
                          $('.memberId'+member_id).html('Follow');
                          $(".memberId" + member_id).attr("onclick", "memberActivityAction('follow'," + member_id + ",1,1,'"+tab_type+"')");
                          $('.memberId'+member_id).removeClass('active');
                        }
                        if(type=="block")
                        {                
                          getMembersList(tab_type);
                        }
                    }  
                },
                error: function () {
                    console.log('Error occurred during the AJAX request');
                },
                complete: function () {
                  // Your code to be executed after the AJAX request is complete
                  console.log('AJAX request completed');
                  //hideLoader();
              }
            });
    }
    
    function reportMember(report_user_id='',reason = '',tab_type='all') {
        let _token = $("input[name=_token]").val();     

            $.ajax({
                url: "{{route('member.report')}}"
                , type: "POST"
                , data: {
                  _token: _token,
                  report_user_id: report_user_id,
                  report_for: 'member',
                  report_type: reason,
                  }
                , dataType: 'JSON'
                , success: function(data) {
                  getMembersList(tab_type);

                    if (data.error) {
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
                    }  
                }
            });
    }
    
    function OpenMemberModal(modalId = '', memberName = '', memberId = '',tab_type='') {
      $('.memberName').html('Block ' + memberName);
      $('#memberId').val(memberId);
      $(".tab_type").val(tab_type);
      if (modalId != '') {
          // alert(modalId);
            $("#"+modalId).modal('show');
        }
    }
    
    $(document).ready(function() {
      $(".block_member_btn").on('click', function(event){
        var member_id = $('#memberId').val();
        var tab_type = $(".tab_type").val();
        memberActivityAction('block',member_id,'','1',tab_type);
        $("#member_block_modal").modal('hide');
      });
    
      $(".report_member_btn").on('click', function(event){
        var member_id = $('#memberId').val();
        var tab_type = $(".tab_type").val();
        var memberReportReasons = [];
        // get all checked checkboxes with the given name
        var checkboxes = document.querySelectorAll("input[name='memberReportReasons']:checked");
        console.log(checkboxes.length);
        // iterate over the checked checkboxes and extract their values
        for (var i = 0; i < checkboxes.length; i++) {
          memberReportReasons.push(checkboxes[i].value);
        }
        let memberReportReasons_string = memberReportReasons.toString();
        
        reportMember(member_id, memberReportReasons_string,tab_type);
        $("#reportMemberModal").modal('hide');
      });
    });
    
    
  </script>
  <script>
    var ENDPOINT = "{{ route('member.list') }}";
    var page = 1;
    var user_type = 'all';
    
    var isLoadingData = false;
    var hasMoreData = true; 
    
    //getMembersList('all',1);
    // $(window).scroll(function () {
    //     if (!isLoadingData && hasMoreData && $(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
    //       isLoadingData = true;
    //       page++;
    //       getMembersList(user_type,page);
    //     }
    // });
    
    
    // function getMembersList(user_type,page='1') {
      
    //   console.log(ENDPOINT + "?page=" + page + "&user_type=" +user_type);
    //   if(page==1)
    //   {
    //     $('#no-records').hide();
    //     $(".member-data").html('');
    //   }
    //   $.ajax({
    //             url: ENDPOINT + "?page=" + page + "&user_type=" +user_type,
    //             datatype: "html",
    //             type: "get",
    //             beforeSend: function () {     
    //               // Show the loader initially
    //               showLoader('members');                  
    //                 // $('.auto-load').show();
    //             }
    //         })
    //         .done(function (response) {
              
    //           isLoadingData = false;
              
    //             if (response.html == '') {
    //               hasMoreData = false;
    //               $('#no-records').show();
    //             }
    //             else{
    //               $('#no-records').hide();
    //               $(".member-data").html(response.html);
                  
    //               if (response.current_page <= response.last_page ) {
    //               hasMoreData = true;
    //               } else {
    //                   hasMoreData = false;
    //               }
            
    //             }
    //             // Hide the loader and show the content
    //             // hideLoader('members');
    //             //showContent();
                
    //         })
    //         .fail(function (jqXHR, ajaxOptions, thrownError) {
    //             console.log('Server error occured');
    //             isLoadingData = false;
    //         });
            
    // }   

    function getMembersList(user_type, page = 1) {
    console.log(ENDPOINT + "?page=" + page + "&user_type=" + user_type);
    if (page === 1) {
        $('#no-records').hide();
        $(".member-data").html('');
    }
    
    $.ajax({
      url: ENDPOINT + "?page=" + page + "&user_type=" +user_type+ "&per_page=300",
      datatype: "html",
      type: "get",
      beforeSend: function() {
          console.log('ajax-load show called');
          showLoader();
          // $('.loader-list').show(); // Show loader before making the request
      }
    })
    .done(function(response) {
      isLoadingData = false;
              
              if (response.html == '') {
                hasMoreData = false;
                $('#no-records').show();
              }
              else{
                $('#no-records').hide();
                $(".member-data").html(response.html);
                
                if (response.current_page <= response.last_page ) {
                hasMoreData = true;
                } else {
                    hasMoreData = false;
                }
          
              }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {
        console.log('Server error occurred');
        isLoadingData = false;
    })
    .always(function() {
        console.log('ajax-load hide called');
        hideLoader();
        // $('.loader-list').hide();
    });
}

</script>
@endsection