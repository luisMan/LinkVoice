!function()
{
    /*author : luis manon */
    var profileNews = $(".voice_news");
    var setting = $("#settingButton");
    var globalFeed = $("#globeFeed");
     var obj;
    var counter = 0;
    var divErrorObj = {
      count: 0,
      maxError: 60,
      maxErrorText: "There has been an error retrieving updates from the server. Please wait a few minutes and then refresh your browser. Thank you :)"
    };
    
    function getContent(div){
      var divObj = {};
      divObj.id = div.id;
      $.ajax({
        url: "feedupdate.php",
        data: divObj,
        success: function(data, textStatus, jqXHR){
          //do something with the data here. 
          $(div).html(data);
        },
        error: function(jqXHR, textStatus, errorThrown ){
          divErrorObj.count++;
          divErrorObj.lastError = errorThrown;
        },
        complete: function(){
          
          if (divErrorObj.count++ >= div.maxError){
            //do something to display the errors. 
            alert(divErrorObj.maxErrorText);
            //finaly return out of the function.
            return;
          }

        }
      });
    }
    /*===========================end of get content===========================*/





    function ajaxCategory(value){
    var ajaxPostData  =  $.post("languageScript.php",
         {'category': value});
            ajaxPostData.done(function(data) {
            console.log(data);
          });
            ajaxPostData.fail(function(dataError) {
            console.log(dataError);
          });
          //this function will always listen to the post request if done succefully this can update the div 
            ajaxPostData.always(function(data) {
            //this means that we have done the proces
            window.location.href="index.php";//$.parseHTML(data)[0].data;
          });}

    function ajaxLanguage(value){
    var ajaxPostData  =  $.post("languageScript.php",
         {'language': value});
            ajaxPostData.done(function(data) {
            console.log(data);
          });
            ajaxPostData.fail(function(dataError) {
            console.log(dataError);
          });
          //this function will always listen to the post request if done succefully this can update the div 
            ajaxPostData.always(function(data) {
            //this means that we have done the process
             window.location.href="index.php";//$.parseHTML(data)[0].data;
          });}

   $('.choiceToRead').each(function()
   {
   	$(this).click(function()
   	{
          ajaxCategory($(this).html());
   	});
   });

   $('.languageTranslate').each(function()
   {
   	$(this).click(function()
   	{
		 ajaxLanguage($(this).html());
       
   	});
   });


   //ajax attribute for the post text button
   $("#postFeed").click(function(evt){
         evt.preventDefault();
          var titleSet =false, newSet = false;
          if($("#input_title").val().length==0)
          {
          alert("Please input a title!");
          }else{titleSet=true;}


          if($("#editor-container").text().length<5)
          {
             alert("Please input a news!");
          }else{newSet=true;}

          console.log("tittle set = "+titleSet+" news set = "+newSet);
          if(titleSet&&newSet)
          {
              var parameters={
                'user':$(this).val(),
                 'title':$("#input_title").val(),
                 'img':$("#input_image").val(),
                 'video':$("#input_video").val(),
                 'newsText':$("#editor-container").html(),
                 'language':$("#select_language")[0][$("#select_language").val()].innerHTML,
                 'category':$("#cat").val(),
                 'time': $.now()
              };
      
         var ajaxPostData  =  $.post("postnews.php",
               parameters);
            ajaxPostData.done(function(data) {
             console.log(data);
           });
            ajaxPostData.fail(function(dataError) {
             console.log(dataError)
          });
          //this function will always listen to the post request if done succefully this can update the div 
            ajaxPostData.always(function(data) {
              //lets now post anything to our profile 
              //let have the recursive function to take care of that
       if($('.voice_padvertisement').position().top>=90&&$('.voice_padvertisement').position().top<=590)
      {$('.voice_padvertisement').animate({'top':'730px'},600);}
       else{$('.voice_padvertisement').animate({'top':'140px'},600);}
        $('.foremost_pcontent').slideToggle(1000);

          });

           
          }
   });


   function postNews(data)
   {
//voice_news
       if($('.voice_padvertisement').position().top>=90&&$('.voice_padvertisement').position().top<=590)
         {$('.voice_padvertisement').animate({'top':'730px'},600);}
       else{$('.voice_padvertisement').animate({'top':'140px'},600);}
        $('.foremost_pcontent').slideToggle(1000);

        profileNews.load(location.href + "#pNews");
      

   }

  $('.buttonComment').each(function(){

   $(this).click(function(evt)
   {
      evt.preventDefault();

      var divText =$(this).parent().children()[1]; 
      //$(this).parent().parent().parent().parent().children().css({"background-color":"red"});
      var div = $(this).prev().prev()[0]; 
      if($(divText).val().length >0){
      console.log("title "+$(this).attr("title")+" time = "+$(this).attr("time")+" id = "+$(this).attr("name")+" commenter = "+$(this).attr("caption"));
      var ajaxPostData  =  $.post("postnews.php",
               {'title':$(this).attr("title"),
                'time':$(this).attr("time"),
                'id':$(this).attr("name"),
                'commenter':$(this).attr("caption"),
                'text':$(divText).val(),
                'time_posted': $.now()});
         ajaxPostData.always(function(data) {

         var dat = jQuery.parseJSON(data);
         if(dat[0].result == 1){
         var text = '<table style="background-color:rgba(0,0,0,0.1);border-bottom: 1px solid rgba(0,0,0,0.2); width:80%; margin-left:10%; z-index:999999;" class="reply-buttons-holder"><thead><th colspan="2"></th></thead>';
      text +='<tbody><tr><td><!--<img src="$_SERVER["DOCUMENT_ROOT"] . "/" . $user->profile_img; " class="user-img-pic"/>-->';
      text +='<img src="'+dat[0].saveto+'" style="border-radius:100%;width:40px;height:40px;"/>';
      text += dat[0].name+'<font color="#a1a1a1" id="reply'+dat[0].name+'">';
      text+='<script type="text/javascript">';
      text+='var div = "#reply"+'+dat[0].name+';';
      text+='$(div).text($.timeago('+dat[0].timePost+'))';
      text+='</script>';
      text+='</font></td><td>';
      text+='<div>';
      text+='<ul id="ulR'+dat[0].name+'">';
      text+='<li id="'+dat[0].name+'" class="delete-replybtn"><span class="glyphicon glyphicon-trash"></span></li>';
      text+='</ul>';
      text+='</div></td></tr>';
      text+='<tr id="tableTextTr"><td style="font-weight: bold;">'+dat[0].text+'</td>';
      text+='</tr></tbody></table> <script type="text/javascript" src="js/button.js"></script>';
         
          //$(this).parent().parent().parent().parent().find("#comment_ul").html(t);
            $(div).append(text);
            $(divText).val("");
      }else{
            $(divText).css({"border":"1px dotted red"});
            $(divText).val("please sign up to post!");
          }
           });
       }//close if 
   });
 });


 /*==================================ENDS HERE===============================*/
     //delete post bottom ajax implementation 
 $('.delete-btn').each(function() {
    $(this).click(function (e)
     {
      e.preventDefault();
      var div = $("#news"+$(this).attr("id"));
      var ajaxPostData  =  $.post("postnews.php",
            {"task": "comment_delete",
             "announcement_id":  $(this).attr("id")});
            ajaxPostData.fail(function(dataError) {
             console.log(dataError);
          });
          //this function will always listen to the post request if done succefully this can update the div 
            ajaxPostData.always(function(data) {
              div.slideToggle(50);
          });
     });
   });

/*============================LISTENER TO delete-replybtn ACTIONS=============*/
 $(".delete-replybtn").each(function(){
      $(this).click(function(e)
      {
         e.preventDefault();
          var id = $(this).attr("id");
          var ajaxPostData  =  $.post("postnews.php",
            {"task": "reply_delete",
             "announcement_id":  $(this).attr("id")});
            ajaxPostData.fail(function(dataError) {
             console.log(dataError);
          });
          //this function will always listen to the post request if done succefully this can update the div 
            ajaxPostData.always(function(data) {
              console.log(data);
            $("#commenter"+id).slideToggle(100);
          });
      });
 });

 /*============================LISTENER TO delete-replybtn ENDS HERE===================*/
/*============================LISTENER TO upvote BUTTON FOR POST========================*/


   $('.upvote-btn').each(function()
   {
       $(this).click(function(e)
       {
         e.preventDefault();
           console.log("flag button clicked = " +$(this));
           var id = $(this).attr("id");
           var userId = $(this).attr("name");
           var obj = $(this);
           var ajaxPostData  =  $.post("postnews.php",
            {"task": "upvote_post",
             "announcement_id":  $(this).attr("id"),
            "user_id":$(this).attr("name") });
            ajaxPostData.fail(function(dataError) {
             console.log(dataError);
          });
          //this function will always listen to the post request if done succefully this can update the div 
            ajaxPostData.always(function(data) {
              if(userId.length > 0){
              obj.html('<div style=" width:90px; height:70px; background-color:rgba(0,0,0,0.2);"><center><span class="glyphicon glyphicon-chevron-up" style=" color:  rgba(64,153,255, 0.9);font-size:34px; cursor:pointer;"></span></center><center><p>+'+data+'</p></center></div>');
               }
           });
       })
   });
 /*============================LISTENER TO upvote BUTTON ENDS============================*/


  


  //setting click listener
  setting.click(function()
  {
    $("#list").css({"width":"200px"});
    $("#list").css({"height":"30px"});
    $("#list").css({"position":"absolute"});
    $("#list").css({"z-index":"9999"});
    $("#list").css({"margin-left":"-170px"});
    $("#list").css({"background-color":"rgba(0,0,0,0.6)"});
    $("#list").css({"border":"1px solid rgba(255,255,255,1)"});
    $("#list").slideToggle(100);
  })

  globalFeed.click(function()
  {
    $("#listF").css({"width":"200px"});
    $("#listF").css({"height":"400px"});
    $("#listF").css({"position":"absolute"});
    $("#listF").css({"z-index":"9999"});
    $("#listF").css({"margin-left":"-170px"});
    $("#listF").css({"background-color":"rgba(0,0,0,0.6)"});
    $("#listF").css({"border":"1px solid rgba(255,255,255,1)"});
    $("#listF").slideToggle(100);
  })

 $("#contact").click(function()
 {
    $("#contactForm").slideToggle(1000);
 })

  $('#submitContact').click(function(evt)
                        {
                               evt.preventDefault();
                              
                              var name = $('#firstname').val();
                              var lastname = $('#lastname').val();
                              var reason = $('#reason').val();
                              var email = $('#emailAddres').val();
                              var pattern = /\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b/;
                              var message = $('#message').val();
                               var OutPutError=[];
                               if(!name.length>0)
                              {
                                $('.nameError').text("Please input your name");
                                OutPutError[0]=false;
                              }else
                              {  
                                $('.nameError').text("valid");
                                OutPutError[0]=true;
                              }

                              if(!lastname.length>0)
                              {
                                $('.lastError').text("Please input your last name");
                                OutPutError[1]=false;
                              }else{
                                $('.lastError').text("valid");
                                OutPutError[1]=true;
                              }


                              if(!email.length>0)
                              {
                               $('.emailError').text("this Field is Required");
                               OutPutError[2]=false;
                              }else if(!pattern.test(email))
                              {
                                $('.emailError').text('Please input valid email');
                                OutPutError[2]=false;

                              }else
                              {
                                OutPutError[2]=true;
                                $('.emailError').text("valid");
                              }


                              if(!message.length>0)
                              { 
                                 $('.messageError').text("Please input your message");
                                 OutPutError[3]=false;

                              }else
                              {
                                $('.messageError').text("valid");
                                OutPutError[3]=true;
                              }


                               if(OutPutError[0]&&OutPutError[1]&&OutPutError[2]
                                &&OutPutError[3])
                                {
                                     var t="You Form has been sended! "+"\n"+
                                      "Inputs Form"+"\n"+"Name ="+name+"\n"+
                                      "Last Name ="+lastname+"\n"+"Email ="+email+"\n"+
                                      "Subject ="+reason+"\n"+"Message ="+message;
                                     console.log(t);
                                }else
                                {
                                      evt.preventDefault();

                                }


                        });
    
 $("#submitContact").click(function()
 {
    $("#contactForm").slideToggle(1000);
 })


}();  