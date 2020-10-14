

(function($) {
"use strict";
  


  var loading_html = '<div class="container text-center" style="padding: 200px"><div class="spinner-md"></div></div>';
  var loader_md = '<div class="container text-center" style="padding: 100px"><div class="spinner-md"></div></div>';
  var loader_btn = '<div class="spinners"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
  var base_url = $('#base_url').val();

  // follow user
  $(document).on('click', ".follow", function() {
      var id = $(this).attr('data-id');

      var url = base_url+'home/follow/'+id;
      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){
              $("#item_"+id+" .follow").html('<i class="fa fa-check"></i> Following');
              $("#item_"+id+" .follow").addClass('unfollow');
              $("#item_"+id+" .follow").removeClass('follow');
          }
       },'json');
      return false;
  });


  $(".custom-btngp").on('click', function() {
      var priceVal = $(this).find('.switch_price').val();

      if (priceVal == 'monthly') {
          $('.monthly_price').show();
          $('.yearly_price').hide();
          $('.billing_type').val('monthly');
      } else {
          $('.yearly_price').show();
          $('.monthly_price').hide();            
          $('.billing_type').val('yearly');
      }
  });



  // unfollow user
  $(document).on('click', ".unfollow", function() {
      var id = $(this).attr('data-id');
      var url = base_url+'home/unfollow/'+id;
      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
          if(json.st == 1){
              $("#item_"+id+" .unfollow").html('<i class="fa fa-user-plus"></i> Follow');
              $("#item_"+id+" .unfollow").addClass('follow');
              $("#item_"+id+" .unfollow").removeClass('unfollow');
          }
       },'json');
      return false;
  });

  $(".sort_user").change(function(){
      var url = $(this).val();
      window.location = url;
  });

  $(".terms_cond").on('click', function() {
    var $box = $(this);
    if ($box.is(":checked")) {
      $($box).val("1");
      $box.prop("checked", true);
    } else {
      $($box).val("");
      $box.prop("checked", false);
    }
  });

  $(document).on('click', ".package_btn", function() {
    
      var billType = $('.billing_type').val();
      var url = $(this).attr('href')+'/'+billType;

      $('.pricing_area').hide();
      $(".loader").html(loading_html);
      $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
        if(json.st == 1){  
            window.location.href = json.url;
        }else{
          $('.pricing_area').show();
        }
      }, 'json' );
      return false;
  });



  $(window).on('bind', "beforeunload", function(e) {
      if ($(".leave_con").serialize() != form_original_data) {
          var needToConfirm = true;
      }
      if(needToConfirm)
          return msg_made_changes_not_saved;
      else 
      e=null; // i.e; if form state change show warning box, else don't show it.
  });


})(jQuery);