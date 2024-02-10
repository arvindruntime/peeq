@foreach($post_comments as $comment) 

{{-- {{ dd($comment) }} --}}
<div class="d-flex gap-2">
    <div class="avtar p-0"><img class="rounded-circle" src="{{ ($comment['user']['profile_image_url']) ?? asset('assets/images/post-user.jpg') }}" alt=""></div>
    <div class="d-lnline text-start">
        <p class="mb-0 lh-sm title-font text-dark fw-bold">@php echo ($comment['user']['first_name']) ?? ''; echo "&nbsp;",($comment['user']['last_name']) ?? '' @endphp</p>
        <p class="mb-0 lh-sm text-sm-12">@php echo ($comment['user']['user_type']) ?? ''; @endphp</p>
    </div><span class="title-font text-sm-10">@php echo ($comment['created_at']->diffForHumans()) ?? ''; @endphp</span>
</div>
<div class="lm_cm-rep text-start ms-5 my-1">
    <p class="text-sm-16 text-dark mb-0 title-font">{{$comment['comment_text']}}</p>
    <div class="lm_rep mb-2 lm_rep{{ $comment['id'] }}">
        <a class="text-primary title-font rep-btn" onclick="cmt_reply({{ $comment['id'] }})">Reply </a>
        
        @if(Auth::user()->id== $comment['commented_by'] || Auth::user()->is_admin==1)
        <a onclick="getDeletPostCommentModal({{ $comment['postcommentable_id'] }},{{ ($comment['id']) ?? '' }},2)" class="text-primary title-font text-sm-16" type="button">Delete</a>
        @endif
        <div class="post_comment-rep mb-2">
            <div class="post_comment-reply d-flex gap-2 mt-2">
                <div class="avtar p-0">
                    <img class="rounded-circle" src="{{ (Auth::user()->profile_image_url) ?? asset('assets/images/logo2.svg') }}" alt="">
                </div>
                <div class="post_comment-wrap position-relative w-100">
                        <div class="position-relative">
                            <input data-emojiable="true" class="form-control border border-dark-subtle rounded-2 p-2 post_cmtt yourReply" name="yourReply" id="yourReply{{ $comment['id'] }}" type="text" placeholder="Leave a reply...">
                            <span class="position-absolute top-50 end-0 translate-middle-y me-2">
                                
                            </span>
                        </div>
                        <div class="">
                            <div class="d-flex align-items-center justify-content-end mt-2 gap-2 active">
                                <button class="btn btn--replay py-1 title-font" onclick="writeReply({{ $comment['id'] }})">Reply</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        
        
        
        @foreach($comment['replies'] as $replies)  
        <div class="d-flex gap-2">
            <div class="avtar p-0"><img class="rounded-circle" src="{{ ($replies['user']['profile_image_url']) ?? asset('assets/images/post-user.jpg') }}" alt="">
            </div>
            <div class="d-lnline text-start">
                <p class="mb-0 lh-sm title-font text-dark fw-bold">@php echo ($replies['user']['first_name']) ?? ''; echo "&nbsp;",($replies['user']['last_name']) ?? '' @endphp</p>
                <p class="mb-0 lh-sm text-sm-14">@php echo ($replies['user']['user_type']) ?? ''; @endphp</p>
            </div><span class="title-font text-sm-10">@php echo ($replies['created_at']->diffForHumans()) ?? ''; @endphp</span>
        </div>
        <div class="lm_cm-rep text-start ms-5 my-1">
            <p class="text-sm-16 text-dark mb-0 title-font">{{$replies['comment_text']}}</p>
            {{-- <div class="lm_rep mb-2"><a class="text-primary title-font" onclick="cmt_reply({{ $replies['id'] }})" >Reply </a> 
                 <div class="post_comment-rep mb-2">
                    <div class="post_comment-reply d-flex gap-2 mt-2">
                        <div class="avtar p-0"><img class="rounded-circle"
                                src="{{ asset('assets/images/post-user.jpg') }}" alt=""></div>
                        <div class="post_comment-wrap position-relative w-100">
                            <form action="" method="get">
                                <div class="position-relative"> <input
                                        class="form-control border border-dark-subtle rounded-2 p-2 post_cmtt"
                                        type="text" placeholder="Share your thoughts..."><span
                                        class="position-absolute top-50 end-0 translate-middle-y me-2"><img
                                            class="in-svg" src="{{ asset('assets/images/emoji.svg') }}" alt=""></span>
                                </div>
                                <div class="post_cmtt-show post_cmtt-hide">
                                    <div
                                        class="d-flex align-items-center justify-content-end mt-2 gap-2">
                                        <button
                                            class="btn btn--replay py-1 title-font">Reply</button><button
                                            class="btn btn-cancle lh-1 w-auto p-0">cancle</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div> --}}
        </div>
        @endforeach
        
    </div>
</div>
@endforeach

{{-- <script>  
    $(document).ready(function() {
        $(".emojionearea-editor").html('');
    $('.post_cmtt').each(function(index) {
      var emojiPicker = $(this).emojioneArea({
        pickerPosition: "bottom",
        tonesStyle: "bullet",
        filtersPosition: "bottom",
        search: false
      });
      
      if($(this).find('.post_cmtt').val())
      {
        console.log('post_cmtt can not be blank!');
      }
      
    // $(this).find('.lm_rep28').removeClass('active');
    // $(this).find('.lm_rep28').addClass('active');
  
      $(this).find('.emoji-icon').click(function() {
        emojiPicker[index].emojioneArea.showPicker();
      });
    });
  });
    
  </script> --}}
  
  
  <script>
    var assetsPath = "{{ asset('assets/emoji/img/')}}";
    $(function() {
      // Initializes and creates emoji set from sprite sheet
      window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: assetsPath,
        popupButtonClasses: 'fa fa-smile-o'
      });
      // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
      // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
      // It can be called as many times as necessary; previously converted input fields will not be converted again
      window.emojiPicker.discover();
    });
  </script>
