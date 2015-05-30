      !function(){
       var foremost_news = $('.foremost_content');
       var foremost_ptype = $('.foremost_pcontent');
       var foremost_lang = $('#foremost_language');
       var foremost_news = $('#foremost_news');
       var foremost_tag =  $('.foremost_tag');
       var foremost_type = $('.foremost_type');
       var checkIn =  $('.button_user');
       var signUp =  $('.checkIn');
       var profilePhotoButton = $('#profilePhoto');
       var profileBackgroundButton = $('#backgroundPhoto');
       
       //click listener to foremost_news
       /*foremost_tag.click(function()
       {   
         if($('.voice_advertisement').position().top>=500)
           {$('.voice_advertisement').animate({'top':'70px'},500);}
         else{$('.voice_advertisement').animate({'top':'500px'},500);}
         foremost_news.slideToggle(500);
       });

       foremost_type.click(function()
       {
        if($('.voice_advertisement').position().top>=500)
         {$('.voice_advertisement').animate({'top':'70px'},600);}
       else{$('.voice_advertisement').animate({'top':'500px'},600);}
       foremost_ptype.slideToggle(500);
      });*/
      //foremost context news
     foremost_type.click(function ()
     {  
        if($('.voice_padvertisement').position().top>=90&&$('.voice_padvertisement').position().top<=590)
         {$('.voice_padvertisement').animate({'top':'1080px'},600);}
       else{$('.voice_padvertisement').animate({'top':'140px'},600);}
        foremost_ptype.slideToggle(1000);
     });


      foremost_lang.click(function()
        { 
            $('.foremost_n').hide(100);
            $('.languages').show(1000);

        });
      foremost_news.click(function(){
        $('.languages').hide(100);
        $('.foremost_n').show(100);
      });
      

      function addView(id,currentDiv)
{
         var ajaxPostData  =  $.post("postnews.php",
            {"task": "add_view",
             "announcement_id": id});
            ajaxPostData.fail(function(dataError) {
             console.log(dataError);
          });
          //this function will always listen to the post request if done succefully this can update the div 
            ajaxPostData.always(function(data) {
              console.log( currentDiv.find("td")[2].children[0].children[0].innerHTML)
          currentDiv.find("td")[2].children[0].children[0].innerHTML = "+"+data+'<span class="glyphicon glyphicon-eye-open">';
          });
}

  
      $('.post_news').each(function(){
   $(this).click(function(evt)
   { 
      evt.preventDefault();
      if(evt.target.nodeName=="DIV"){
       var div=$(this).find("div")[4].id;
       console.log(div)
      $("#"+div).slideToggle(500).toggleClass('opened');
      var isVisible = $("#"+div).is(".opened");
      if(isVisible==true){
       $("#"+div).css({'background-color':'rgba(255,255,255,0.8)'});
       $(this).css({'border-left':'3px dotted rgba(0,0,0, 0.5)'});
      $(this).find("input").focus();
       var id = $(this).attr("id").substring(4, $(this).attr("id").length);
      addView(id,$(this));}
      else{
        $(this).css({'border-left':'2px solid rgba(64,153,255, 0.9)'});
      }
    }
   });
});

$('.post_news').each(function(){
   $(this).mouseover(function(e)
   {
    e.preventDefault();
     console.log($(this).find("div")[3].children);
     //$(this).css({'border':'1px solid rgba(0,0,255,0.3)'});
    // $(this).css({'background-color':'rgba(0,0,255,0.1)'});
    // $(this).css({'border-left':'2px solid rgba(0,0,255,0.3)'});
    if($(this).find("div")[3].children.length>0){
     var ulId= $(this).find("div")[3].children[0].id;
      $("#"+ulId).show(100);
    }
   });
    $(this).mouseleave(function(e)
   {
    e.preventDefault();
     //$(this).css({'border':' 1px solid rgba(255,255,255,1)'});
     //$(this).css({'background-color':'rgba(255,255,255,1)'});
     //$(this).css({'border-left':'2px solid rgba(0,0,255,0.3)'});
     if($(this).find("div")[3].children.length>0){
      var ulId= $(this).find("div")[3].children[0].id;
      $("#"+ulId).hide(100);
    }
   });
});

$('.reply-buttons-holder').each(function()
{
 
    $(this).mouseover(function(e)
   {
      e.preventDefault();
     if($(this).find("div")[0].children.length>0){
      var ulId = $(this).find("div")[0].children[0].id;
      $("#"+ulId).show(100);
      var liId= $(this).find("div")[0].children[0].children[0].id;
      $("#"+liId).css({"border":"1px solid rgba(64,153,255, 0.9)"});
    }
   
   
   
   });
    $(this).mouseleave(function(e)
   {
    e.preventDefault();
     if($(this).find("div")[0].children.length>0){
     var ulId = $(this).find("div")[0].children[0].id;
      $("#"+ulId).hide(100);
      var liId= $(this).find("div")[0].children[0].children[0].id;
      $("#"+liId).css({"border":"1px solid transparent"});
    }
    
   });
})




    

      checkIn.click(function()
      {
          var $nav = $('.button_user ul');
          $nav.css({"margin-left": "-270px"});
          $nav.css({"margin-top": "-20px"});
          $nav.slideToggle(500);
      });

       
       $("#login").click(function()
       {
          $('.registration').hide();
           $('.loggingUser').show();
           signUp.slideToggle(1000);
           signUp.animate({left:($(window).width()/2-200),
                           top: ($(window).height()/2-100)},100);

       });

       $('#signup').click(function()
       {
            console.log("clicked");
           $('.loggingUser').hide();
           $('.registration').show();
           signUp.slideToggle(1000);
           signUp.animate({left:($(window).width()/2-200),
                           top: ($(window).height()/2-100)},100);
       });

   
      $(document).scroll(function() {
       if($(window).scrollTop()>300){
         $(".footer").fadeIn(200);
       }else{
        $(".footer").fadeOut(200);
       }
      });

      //click listener for category
      $("#category").click(function()
      {
         $('#categoryDiv').slideToggle(1000);
      });

      //set the reputation var to the profile page
       $(".rep").css({"width": $(".rep").attr('value')+"%"});
      //do tooltip text for each image badge
      $('.badgelinks').each(function()
      {
         $(this).hover(function()
         {
            var isHovered = $(this).is(":hover"); // returns true or false
            if(isHovered){
            var text = "<p style='color:white; width:100px; height:30px; text-align:center;background-color:black; margin-left:-100px; margin-top:-70px;'>"+$(this).attr('value')+"</p>";
            $(this).append(text);
          }else{
             $( "p" ).detach();
          }
         });
      });






      profilePhotoButton.click(function()
   {
        var innerCode = "<form method='post' action='profile.php' enctype='multipart/form-data'>"+
         "<div><span class= 'SocialName'>Profile Photo:</span></div>"+
         "<div><input  type='file' name='profile' size='14' maxlength='32' /></div>"+
         "<div><input type='submit' value='Submit'/></form>";
         $('#profileAtributes').slideToggle(1000);
         $('#profileAtributes').html(innerCode);

   });
   profileBackgroundButton.click(function()
   {
       var innerCode = "<form method='post' action='profile.php' enctype='multipart/form-data'>"+
         "<div><span class= 'SocialName'>Background Photo:</span></div>"+
         "<div><input  type='file' name='image' size='14' maxlength='32' /></div>"+
         "<div><input type='submit' value='Save Photo' /></div></form>";
           $('#profileAtributes').slideToggle(1000);
          $('#profileAtributes').html(innerCode);

   });
      }();

