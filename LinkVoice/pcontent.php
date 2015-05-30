				<div class="voice_content">
				<div class="foremost_type">Type some good news! <span class="glyphicon glyphicon-plus-sign" style="font-size:34px; color:rgba(1,1,1,0.4);"></span></div>
				<div class="foremost_pcontent">
				<div id="button">
				 	<table>
				 		<thead><th colspan="2"></th></thead>
				 		<tbody>
			            <tr>
			             <td><button id="speaker"  onclick="voice.MicToggleButton()"><img id="status_img" src="img/mic.gif" alt="Start"></button></td>
			             <td><button id="postFeed" value="<?php echo $user; ?>">Post</button></td>
			            </tr>
			            <!--<tr>
			             <td><button id="link"><span class="glyphicon glyphicon-link"></span></button></td>
			             <td><button id="video"><span class="glyphicon glyphicon-facetime-video"></span></button></td>     
			            </tr>
			            <tr>
			             <td><button id="picture"> <span class="glyphicon glyphicon-picture"></span></button></td>
			             <td><button id="capitalize"><span class="glyphicon glyphicon-font"></span></button></td> 
			            </tr>
			            <tr>
			             <td><button id="italize"><span class="glyphicon glyphicon-italic"></span></button></td>
			            </tr>-->
				 		</tbody>
				 	</table>
				</div>

				 <form id="voice_type" method="post">
					<fieldset>
						<legend>news post</legend>
							<table id="postNewsTable">
							<thead><th colspan="2"><div id="status"></div></th></thead>
							<tbody>
							<tr>
							<td id="col1">
							<label>Title:</label>
							</td>
							<td id="col2">
							<input class="titleQuestion" name="title" id="input_title" size="150"  placeholder="post title">
							</td>
							</tr>
							<tr>
							<td id="col1">
							<label>image:</label>
							</td>
							<td id="col2">
							<input class="titleQuestion" name="title" id="input_image" size="150" placeholder='post image link'>
							</td>
							</tr>
							<tr>
							<td id="col1">
							<label>Video:</label>
							</td>
							<td id="col2">
							<input class="titleQuestion" name="title" id="input_video" size="150" placeholder='post embeded video link or None'>	
							</td>
							</tr>
							<tr>
							<td>
							<label style="color: white; top:0;">Docuementary:</label>
							</td>
							<td id="col2">
							<div id="content-container">
      <div id="editor-wrapper">
        <div id="formatting-container">
          <select title="Font" class="ql-font">
            <option value="sans-serif" selected>Sans Serif</option>
            <option value="Georgia, serif">Serif</option>
            <option value="Monaco, 'Courier New', monospace">Monospace</option>
          </select>
          <select title="Size" class="ql-size">
            <option value="10px">Small</option>
            <option value="13px" selected>Normal</option>
            <option value="18px">Large</option>
            <option value="32px">Huge</option>
          </select>
          <select title="Text Color" class="ql-color">
            <option value="rgb(255, 255, 255)">White</option>
            <option value="rgb(0, 0, 0)" selected>Black</option>
            <option value="rgb(255, 0, 0)">Red</option>
            <option value="rgb(0, 0, 255)">Blue</option>
            <option value="rgb(0, 255, 0)">Lime</option>
            <option value="rgb(0, 128, 128)">Teal</option>
            <option value="rgb(255, 0, 255)">Magenta</option>
            <option value="rgb(255, 255, 0)">Yellow</option>
          </select>
          <select title="Background Color" class="ql-background">
            <option value="rgb(255, 255, 255)" selected>White</option>
            <option value="rgb(0, 0, 0)">Black</option>
            <option value="rgb(255, 0, 0)">Red</option>
            <option value="rgb(0, 0, 255)">Blue</option>
            <option value="rgb(0, 255, 0)">Lime</option>
            <option value="rgb(0, 128, 128)">Teal</option>
            <option value="rgb(255, 0, 255)">Magenta</option>
            <option value="rgb(255, 255, 0)">Yellow</option>
          </select>
          <select title="Text Alignment" class="ql-align">
            <option value="left" selected>Left</option>
            <option value="center">Center</option>
            <option value="right">Right</option>
            <option value="justify">Justify</option>
          </select>
          <div id="textB" title="Bold" class="ql-format-button ql-bold">Bold</div>
          <div id="textB" title="Italic" class="ql-format-button ql-italic">Italic</div>
          <div id="textB" title="Underline" class="ql-format-button ql-underline">Under</div>
          <div id="textB" title="Strikethrough" class="ql-format-button ql-strike">Strike</div>
          <!--<div id="textB" title="Link" class="ql-format-button ql-link">Link</div>-->
          <div id="textB" title="Image" class="ql-format-button ql-image">Image</div>
          <div id="textB" title="Bullet" class="ql-format-button ql-bullet">Bullet</div>
          <div id="textB" title="List" class="ql-format-button ql-list">List</div>
        </div>
        <div id="editor-container"></div>
      </div>
    <script type="text/javascript" src="script/quill.js"></script>
    <script type="text/javascript">
      var editor = new Quill('#editor-container', {
        modules: {
          'toolbar': { container: '#formatting-container' },
          'link-tooltip': true,
          'image-tooltip': true
        }
      });
      editor.on('selection-change', function(range) {
        console.log('selection-change', range)
      });
      editor.on('text-change', function(delta, source) {
        console.log('text-change', delta, source)
      });
    </script>


							</td>
							</tr>	
							</tbody>
							</table>
						</fieldset>
				 	</form>
				  	<div id="div_language">
				  	<table style="float:left;">
				  		<thead><th colspan="2"></th></thead>
				  	 <tbody>
				  	 	<tr>
				   <td style="color:gray;">Language : <select id="select_language" onchange="updateCountry()"></select>
				    <select id="select_dialect"></select></td>
				    <td style="color:gray;"> Category :
				    	<select id="cat">
			                <option>General</option>
			                <option>Social</option>
			                <option>Entertainment</option>
			                <option>Funny</option>
			                <option>Politics</option>
			                <option>Economy</option>
			                <option>Music</option>
			                <option>Education</option>
			                <option>Social Networks</option>
			                <option>Research</option>
			                <option>Celebrity</option>
			                <option>Sports</option>
			                <option>Food</option>
				    </select></td>
				</tr>
				    </tbody>
				</table>
				</div>
				<br/><br/><br/>
				</div>
				<div class="voice_news" id="pNews<?php echo $user; ?>">
				 <?php $object->getUserNews($user);?>
				</div>

				<div class="voice_padvertisement">
				<!-- contents that refers to all hot news topics on the news -->
				 <div class="profile">
				 <table>
			     <thead><th colspan="3"></th></thead>
			     <tbody>
			     <tr>
			     <td><img src="<?php echo 'membersPhoto/'.$user.'.jpg'; ?>" width="50px" height="50px"></img></td>
			     <td>name:<?php echo"$user"; ?></td>
			     </tr>
			     <tr>
			     <td class="td">constribution<div><?php echo $object->getUserConstribution($user);?></div></td>
			     <td class="td">followers<div><?php echo $object->getUserFollower($user);?></div></td>
			     <td class="td">num stars<div class="stars"><?php $object->getUserStars($user);?></div></td>
			     </tr>
			     <tr>
			     	<td>reputation:<div class="rep" value="<?php echo$object->getUserRep($user); ?>"><label><?php echo $object->getUserRep($user)."%";?></label></div></td>
			     </tr>
			     </tbody>
				 </table>
				 </div>
				 <div class="userProfNav">
			         <ul>
			            <li id="profilePhoto">Profile</li>
			            <!--<li id="backgroundPhoto">Background</li>-->
			         </ul>
			      </div>
			      <div id="profileAtributes">
			          
			     </div>
				 <div class="badges">
				 	<center><label>Recognition Badges</label></center>
				 	<?php $object->getWritterBadge($user);?>
				 </div>
				</div>
				</div>