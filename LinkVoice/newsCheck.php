<?php
require("definitions.php");
   if(isset($_POST["user"])){
    

     $user = $_POST["user"];
   //we will check the last news 
     if( $object->isNewsRefreshed()==1)
   	     	{

   	             //return the last post right the way
   	       $query = $object->execSQL("select * from news_post order by id desc limit 1") or die(mysqli_error());
   	       $query = mysqli_fetch_row($query) or die(mysqli_error());
           $userName = $object->executeSQL("SELECT * FROM member WHERE serialCode='$query[1]'");
           $userName = mysqli_fetch_row($userName);
            //update announcements data base after 10 seconds
           $object->execSQL("update news_post SET updated=1 WHERE id=$query[0]");
          
   
           
           if(file_exists("membersPhoto/$userName[1].jpg"))
           { 
            $saveto = '<img src="membersPhoto/'.$userName[1].'.jpg" style=" margin-left:3%;border-radius:100%;width:70px;height:70px;"/>
              ';
           }else{
              $saveto = '<span class="glyphicon glyphicon-user" style="color:rgba(64,153,255, 0.9);font-size:30px; margin-left:3%;border-radius:100%;width:70px;height:70px;"></span>';
           }
          echo '<div class="post_news" id="news'.$query[0].'">
          <table style="background-image:url('.$query[3].'); background-size:100% 100%; "> 
          <thead><th colspan="4"></th></thead>
          <tbody>
            <tr>
           <td>';
        if($object->didPersonVoted($query[0],$userName[0])>=1){
           echo '<div id="'.$query[0].'" class="upvote-btn" name="'.$user.'" style="color:black; font-size:24px;"><div style=" width:90px; height:70px; background-color:rgba(0,0,0,0.2);"><center><span class="glyphicon glyphicon-chevron-up" style=" color:  rgba(64,153,255, 0.9);font-size:34px; cursor:pointer;"></span></center>
           <center><p>+'.$object->getNumVoters($row[0]).'</p></center></div></div>';
         }else{
           echo '<div id="'.$query[0].'" class="upvote-btn" name="'.$user.'" style="color:black; font-size:24px;"><div style=" width:90px; height:70px; background-color:rgba(0,0,0,0.2);"><center><span class="glyphicon glyphicon-chevron-up" style=" color:  rgba(1,1,1, 0.9);font-size:34px; cursor:pointer;"></span></center>
           <center><p>+'.$object->getNumVoters($query[0]).'</p></center></div></div>';
         }

          echo '</td>
            <td>
             <a href=profile.php?view='.$userName[1].' id="user">'.$saveto.'</a>
            </td>
            <td style=" color:white; background-color: rgba(1,1,1,0.3);font-weight: bold;" ><div class="postTitle" >'.$query[2].'<label style=" margin-left:2%; background-color: rgba(1,1,1,0.3); color:white;">+'.$query[6].'</lable><span class="glyphicon glyphicon-eye-open"></div></td>
             <td><font color="#a1a1a1" style="margin-left:5px; color:white; ;background-color: rgba(1,1,1,0.5);" id="timepost'.$query[9].'">';

              echo '<script type="text/javascript">';
              echo 'var div = "#timepost"+'.$query[9].';';
                  echo '$(div).text($.timeago('.$query[9].'))';
                  echo '</script>';
                  echo '</font>';
                  echo '</td>
                  <td>';
                  echo '<div id="comment-buttons-holder">';
      if($user==$userName[1]){
        echo '<ul id="ul'.$query[0].'"> 
           <li id="'.$query[0].'" class="delete-btn" name="'.$userName[1].'"  style=";background-color: rgba(1,1,1,0.5);color:red;"><span class="glyphicon glyphicon-trash" ></span></li> 
        </ul>';   
        }
           echo '</div>
          </td>
          </tr>
        </tbody>
       </table>
       <div id="box'.$query[0].'" class="" value="'.$query[0].'" style="display:none;">
       <div style="display: block; width: 80%;margin-left:10%;font-size: 14px;word-wrap: normal;">
                    '.$query[5].'</div>
          
        <div>
            <div style="background-color: rgba(255,255,255,0.3); width:80%; margin-left:10%; margin-top:10%;">';
             $object->getComments($query[0],$query[2],$query[9]);
            echo'
            </div>
          <input type="text" id="comment" name="comment" placeholder="input a comment" style="width:75%; min-height:50px; border:1px; margin-top:5%; margin-left:12%; margin-bottom:2%;"></input>
          <button type="button" class="buttonComment" class="btn btn-default btn-sm" name="'.$query[0].'" title="'.$query[2].'" time="'.$query[9].'"  caption="'.$user.'">
                  <span class="glyphicon glyphicon-share-alt"></span> Post
          </button> </div>';
       echo '<div class="upVoters">Voters :';
        $object->getVoters($query[0]);
       echo '</div>
     </div>
    <script type="text/javascript" src="script/linkedScript.js"></script>
    <script type="text/javascript" src="script/button.js"></script>
    </div>';
  
   // sleep(2);
   }else{
    echo -1;
   }
}
  
?>