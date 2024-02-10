@extends('layouts.admin.master')
@section('content')

<style type="text/css">

.circle2.active {
  animation: fadeIn 0.5s ease forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}
</style>

<section class="lm__dash-con auto-load"><span class="lm_vec"><img class="light" src="{{ asset('assets/images/light.png') }}" alt=""><img class="dark" src="{{ asset('assets/images/dark.png') }}" alt=""></span>
  <div class="container"> 
    <div class="lm_dash-step pb-5">
      <h4 class="text-primary">Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
      <div class="row"> 
        <div class="col">
          <div class="lm__dash-inner">
            <span class="welcomeCheckList">
              @include('admin.dashboard.welcome_checklist_xhr')
            </span>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@include('admin.dashboard.exampleModal')

@endsection
@section('js')

<script>
  $(document).ready(function() {
    
document.addEventListener("DOMContentLoaded", function() {
  const steps = document.getElementsByClassName("circle2");

  // Delay the activation of each step using a timeout
  for (let i = 0; i < steps.length; i++) {
    setTimeout(function() {
      steps[i].classList.add("active");
    }, i * 100); // Adjust the delay time (in milliseconds) as needed
  }
});
     
  });

//add general
  $(document).on('click', '.add_general', function() {
        event.preventDefault();
        var link = '<div class="d-flex">' 
        link += '<input class="form-control shadow" id="general" type="text" name="general[]" placeholder="General" value=""><br/>'
        link += '</div><br/>'
        $('.append_general_link').append(link)
        console.log(link);
        return false;
    });

    //add course
  $(document).on('click', '.add_course', function() {
        event.preventDefault();
        var link = '<div class="d-flex">' 
        link += '<input class="form-control shadow" id="course" type="text" name="course[]" placeholder="Courses" value=""><br/>'
        link += '</div><br/>'
        $('.append_course_link').append(link)
        console.log(link);
        return false;
    });

    //add general
  $(document).on('click', '.add_find_resource', function() {
        event.preventDefault();
        var link = '<div class="d-flex">' 
        link += '<input class="form-control shadow" id="find_resource" type="text" name="find_resource[]" placeholder="Find Resourse" value=""><br/>'
        link += '</div><br/>'
        $('.append_find_resource_link').append(link)
        return false;
    });
</script>

<script>
  //  $(document).on('click', '#profile_image', function () {
  //   // $('#profile_upload').trigger('click');
  //   });

    // $(document).on('click', '#cover_image', function () {
    //   $('#cover_upload').trigger("click");
    // });

    $(document).ready(function (e) {
        $('#profile_upload').change(function(){     
        let reader = new FileReader();
        reader.onload = (e) => { 
          $('.profile_image').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
        
        });
    });
</script>
<script>
  $(document).ready(function (e) {
      $('#cover_upload').change(function(){     
      let reader = new FileReader();
      reader.onload = (e) => { 
        $('.preview-image-before-upload-cover').attr('src', e.target.result); 
      }
      reader.readAsDataURL(this.files[0]); 
      
      });    
  });
  // welcomeChecklistSteps();
  function welcomeChecklistSteps()
    {
      let _token =  $("input[name=_token]").val();
      $.ajax({
        url: "{{route('welcome_checklists')}}",
        method: "GET",  
        data: {
          _token:_token,
          is_mobile: 0
        }  
      }).done(function(data) {
        if(data.status==200)
        {
          if(data.data.welcome_checklist_complete==1)
          {
            //window.location.href='{{ route("posts.index") }}';
          }
          var html ='';
          for(var key in data.data.welcomeChecklists) {
            var value = data.data.welcomeChecklists[key];
              $(".steps-completed"+value.step_number).addClass(value.status);
              var heights = '33%';
              if(value.step_number==2 && value.status=="active")
              {
                heights = (33) * (value.step_number) + '%';
                $(".progress-dash").height(heights);
              }
              if(value.step_number==4 && value.status=="active")
              {
                heights = (33) * (value.step_number) + '%';
                $(".progress-dash").height(heights);
              }
        }    
        }
      });
    }
    
    
    ////////// Start function to getWelcomeChecklist ///////////////////////   
    function getWelcomeChecklist() {
      $(".welcomeCheckList").html('');
      $.ajax({
                url: "{{ route('dashboard') }}",
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    //$('.auto-load').show();
                }
            })
            .done(function (response) {
                // if (response.html == '') {
                //     $('.auto-load').html("We don't have more data to display :(");
                //     return;
                // }
  
                // $('.auto-load').hide();
                $(".welcomeCheckList").html(response.html);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
            
    }
     /////////////////// End getWelcomeChecklist function
</script>
@stop