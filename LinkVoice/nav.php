	
	 <div class="voice_nav">
	 <a href="index.php"><div class="voice_logo"></div></a>
	 <?php

	 if(!$loggedin){
	 echo '<div class="button_user"><label>Check In</label>
	 <ul>	
	 	<li><div id="login">Log In</div></li>
	 	<li><div id="signup">Sing up</div></li>
	 </ul>';}else{
	  echo '
	     <div style="float:right;margin-top:25px;"><button type="button" id="settingButton"class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-cog"></span>
          <button type="button" id="globeFeed" style="float:left;" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-globe"></span>
          </button>
        </button><div id="list" style="display:none;"><center><a href="logout.php" style="color:white;">log out</a></center></div>
        <div id="listF" style="display:none;"></div></div>';
	    
	  echo '<a href="profile.php?view='.$user.'"><div class="button_user"><label>'.$user.'</label>';
	 }
	 ?>
	 </div></a>
	</div>
