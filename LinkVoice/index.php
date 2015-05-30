<title>LinkedVoice</title>
  <?php 
include_once("definitions.php");
include_once("user_in.php");
include_once("languageScript.php");
session_start();  // as section start do this function

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
}
else
{ $loggedin = FALSE; session_destroy();}
?>
<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
<?php include_once('css/css.php');?>
<!--<script type="text/javascript" src="script/fbsdk.js"></script> 
<script type="text/javascript" src="script/fblog.js"></script>-->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="script/timestamp.js"></script>
</head>
<body>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=993537140662983";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
	<div class="voice_wrapper">
     <div>
      <?php include_once('nav.php'); ?>
     </div>	
     <div>
       <?php include_once('content.php');?>
     </div>
    </div>
    <div class="checkIn">
    <div class="registration">
        <form method='post' action='#'
         name="member_form" id="member_form">
            <legend>Registration Information</legend>
            <div><label><div class="error" ></div></label></div>
            <label for='username' class='fieldname'>Username:</label>
            <input class='inputs' type='text' maxlength='16' name='newuser' value=''onBlur=''/>
            <label  for='userPassword' class='fieldname'>Password:</label>
            <input class = 'inputs' type='password' maxlength='16' name='newpass' value='' />
            <label class='fieldname' for="email" >Email Address:</label>
            <input class = 'inputs' type='email' maxlength='50' name='newemail' value='' />
            <input class="signupButton" type='submit' value='Sign up' />
        </form>
    </div>
    <div class="loggingUser">
                    <form method='post' action="index.php">
                     <center><legend>Log in Information</legend></center>
                     <div class="error"></div><br/>
                      <span class='fieldname'>Username :</span>
                      <br/>
                      <input class = 'inputs' type='text' maxlength='16' name='user' value='' />
                      <br/>
                      <span class='fieldname'>Password :</span>
                      <br/>
                      <input class = 'inputs' type='password'maxlength='16' name='pass' value='' />
                      <br/>
                      <input class="loginButton" type='submit' value='Login' />
                      </form>  
    </div>

    </div>
    <div class="footer">
    <div id="categoryDiv">
       <?php $object->newsCategory();?>
    </div>
    <div id="copyRight">&copy linkedVoice</div>
    <div id="contact">FeedBack</div>
    <div id="category">News Category</div>
    <div id="contactForm">
         <form action="#" id="standard" name="standard">
     <table>
         <thead><th colspan="2"></th></thead>
         <tbody>
          <tr>
                <td class="col1"><label for="firstname">First name</label></td>
                <td calss="col2"><div class="formElement"><input type="text" name="firstname" id="firstname" placeholder="enter first name"/><p class="nameError"></p></div></td>
          </tr>
            <tr>
                <td class="col1"><label for="lastname">Last name</label></td>
                <td class="col2"><div class="formElement"><input type="text" name="lastname" id="lastname" placeholder="enter Last name"/>
                  <p class="lastError"></p></div></td>
          </tr>
            <tr>
                <td id="col1"><label for="email">Email</label></td>
                <td id="col2"><div class="formElement"><input id="emailAddres" type="text" name="email" placeholder="enter email"/><p class="emailError"></p></div></td>
          </tr>
      <tr>
     <td>
      <label for="Reason for contact">Reason For contact</label>
    </td>
     <td>
      <div class="formElement">
      <select name="favoritefood" id="reason">
        <option>Ask Question</option>
        <option>Apply for a job</option>
        <option>Report a problem</option>
        <option>Other</option>
      </select></div>
     </td>
    
      </tr>
            <tr>
                <td id="col1"><label for="message">Message</label></td>
                <td id="col2"><div class="formElement"><textArea type="text" name="message" id="message" rows="10" cols="40" ></textArea></div><p class="textError"></p></td>
          </tr>
          <tr> 
              <td></td>
              <td><div class="formElement"><div id="submitContact">Submit</div></div></td>
          </tr>
         </tbody>
          </table>
       </form>
        </div>
    </div>
</body> 
<footer>
<div id="loggedUser" style="display:none;" value="<?php echo $user; ?>"></div>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script type="text/javascript" src="script/linkedScript.js"></script>	
<script type="text/javascript" src="script/slide.js"></script> 
<script type="text/javascript" src="script/ajax.js"></script> 
<script type="text/javascript" src="script/button.js"></script>
<script type="text/javascript" src="script/load.js"></script>
<script type="text/javascript" src="script/recursive.js"></script>
<?php  include('script/script.php'); /*include_once('voice.php');*/ ?>
</footer>
</html>