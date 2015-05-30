  !function(){


   function MakeId()
    {var text = "";var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";for( var i=0; i < 8; i++ )text += possible.charAt(Math.floor(Math.random() * possible.length)); return text;}
    

  /* attach a submit handler to the form */
  $(".signupButton").click(function(event) {

    /* stop form from submitting normally */
    event.preventDefault();
    
    var parameters = { 
      'name': $('input[name="newuser"]').val(),
      'password': $('input[name="newpass"]').val(),
      'email': $('input[name="newemail"]').val(),
      'id':MakeId()
       };

         if(parameters.name.length==0||parameters.password.length==0||parameters.email.length==0){
           $('.error').append("missing values host!");

         }else{
         
           //the ajax function toggle
         var ajaxPostData  =  $.post("user_in.php",
         {'newname': $('input[name="newuser"]').val(),
          'password': $('input[name="newpass"]').val(),
          'email': $('input[name="newemail"]').val(),
          'id':MakeId()});
            ajaxPostData.done(function(data) {
            console.log("account created");
          });
            ajaxPostData.fail(function(dataError) {
         // console.log(dataError)
          });
          //this function will always listen to the post request if done succefully this can update the div 
            ajaxPostData.always(function(data) {
            //this means that we have done the process
            console.log(data);
            $('.error').text("Account created host!");
            $(".checkIn").fadeOut(5000);
          });

         }//end else

    });


 
  }();