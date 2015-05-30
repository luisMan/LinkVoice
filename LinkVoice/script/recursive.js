
//dynamic site feed update function
$(document).ready(function(){

function RefreshReply()
{
  this.id = -1;
  this.postAuthor = -1;
  this.div = null;
  this.canRefresh = false;
}
//construct a class object 
var reply_update =  new  RefreshReply();


function getStatus()
{
         var ajaxPostData  =  $.post("ajax/statusCheck.php",
              {"feed_status": "load_feed"});
              ajaxPostData.done(function(data) {
               //this ajax post has done
            });
              ajaxPostData.fail(function(dataError) {
             // console.log(dataError)
            });
            //this function will always listen to the post request if done succefully this can update the div 
              ajaxPostData.always(function(data) {
              data = data.replace("-1", "");
              $(".feed_updates").html(data);
            });
}

function getChannel()
{
         var ajaxPostData  =  $.post("ajax/channelCheck.php",
              {"feed_status": "load_channel"});
              ajaxPostData.done(function(data) {
               //this ajax post has done
            });
              ajaxPostData.fail(function(dataError) {
             // console.log(dataError)
            });
            //this function will always listen to the post request if done succefully this can update the div 
              ajaxPostData.always(function(data) {
              data = data.replace("-1", "");
              $(".channel_updates").html(data);
              $("#channelScript").html('<script type="text/javascript" src="js/channelFunctionality.js"></script>');
            });
}


function getReplies(id,user_post_author, div, reply_id)
{
  var ajaxPostData  =  $.post("ajax/replyCheck.php",
              {"reply_status": "load_reply",
                "id": id,
                "post_author": user_post_author,
                "reply_id":reply_id
               });
              ajaxPostData.done(function(data) {
               //this ajax post has done
              $("#"+div).html(data);
              $("#"+div).append('<script type="text/javascript" src="script/linkedScript.js"></script>');
              $("#"+div).append('<script type="text/javascript" src="script/button.js"></script>');
          
            });
              ajaxPostData.fail(function(dataError) {
             // console.log(dataError)
            });
            //this function will always listen to the post request if done succefully this can update the div 
              ajaxPostData.always(function(data) {
                //console.log(data);
               });
}
//recursive check will always check to see if we have to update and paste last post from  data base
  
  function recursiveCheck()
  {


     var ajaxPostData  =  $.post("newsCheck.php",
              {"user": $("#loggedUser").attr("value")
               });
              ajaxPostData.done(function(data) {
               //this ajax post has done
              if(data==-1){
              }else{
              $(".userPost" ).prepend(data);         
              }
            });
              ajaxPostData.fail(function(dataError) {
             // console.log(dataError)
            });
            //this function will always listen to the post request if done succefully this can update the div 
              ajaxPostData.always(function(data) {
            

           });
  
       //check for a recent reply 
       // var ajaxPostData  =  $.post("ajax/replyCheck.php",
       //        {"check_reply": "load_reply",
       //          "recent_post": "new_reply"
       //         });
       //        ajaxPostData.done(function(data) {
       //         //this ajax post has done
       //      });
       //        ajaxPostData.fail(function(dataError) {
       //       // console.log(dataError)
       //      });
       //      //this function will always listen to the post request if done succefully this can update the div 
       //        ajaxPostData.always(function(data) {
       //          data = data.replace("-1", "");
       //          data = jQuery.parseJSON(data);
       //          if(jQuery.isArray(data) &&data[0]!==null){
       //            getReplies(data[0][0].comment_id,data[0][0].user_id,"replyBox"+data[0][0].comment_id,data[0][0].id);
       //          }
       //      });

       //do reupdate after 3 seconds
        setTimeout(function(){recursiveCheck();}, 300);
  
  }


//call to recursive check function
  recursiveCheck();
});

