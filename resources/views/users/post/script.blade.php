<script type="text/javascript">
 $(document).ready(function() {
   ////////////// Get profile Data //////////////////
    
  //  $(".modal_popup").click(function() {
  //     var id = $(this).attr('data-id');
  //     let url = '{{ route("user.edit", ":id") }}';
  //     url = url.replace(':id', id); 
  //     $.ajax({
  //         url: url,
  //         method: "get"    
  //     }).done(function(response) {
        
  //       var rs = response.data.userList;
        
  //       console.log(response.data.userList);
        
  //       $('.preview-image-before-upload-cover').attr('src', rs.cover_image_url);
  //       $('.profile_image').attr('src', rs.profile_image_url); 
        
  //       $("#inputfname_edit").val(rs.first_name);
        
  //         $("#inputfname_edit").val(rs.first_name);
  //         $("#inputsname_edit").val(rs.last_name);
  //         $("#inputjob-title_edit").val(rs.job_title);
  //         $("#inputcomname_edit").val(rs.company_name);
  //         $("#about_me_edit").html(rs.bio);
  //         if(rs.leadership_development == 1)
  //         {
  //           $("#leadership_development_edit").html(rs.leadership_development).prop('checked', true);
  //         } else {
  //           $("#leadership_development_edit").html(rs.leadership_development).prop('checked', false);
  //         }
  //         if(rs.self_development == 1){
  //           $("#self_development_edit").html(rs.self_development).prop('checked', true);
  //         } else {
  //           $("#self_development_edit").html(rs.self_development).prop('checked', false);
  //         }
  //         if(rs.culture_uplift == 1){
  //           $("#culture_uplift_edit").html(rs.culture_uplift).prop('checked', true);
  //         } else {
  //           $("#culture_uplift_edit").html(rs.culture_uplift).prop('checked', false);
  //         }
  //         if(rs.networking == 1){
  //           $("#networking_edit").html(rs.networking).prop('checked', true);
  //         } else {
  //           $("#networking_edit").html(rs.networking).prop('checked', false);
  //         }
          
  //         $("#location_edit").val(rs.location.id);
  //         $("#timezone_edit").val(rs.timezone.id);
  //     });
  //   }); 
     
});
</script>


