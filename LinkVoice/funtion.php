      <?php
       require_once __DIR__ .'/private.php';
      
      class _DataBase
      {  
         public $connection;
         public static function getConnection()
        {
          $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE) or die("Problems");
          return $connect;
        }
        function __construct()
         {
            //init all data conection component
         	  $this->_initDB();

         }

        function execSQL($query)
        {
           if(_DataBase::getConnection())
              {
                return mysqli_query(_DataBase::getConnection(),$query);
              }
    
        }
         function isNewsRefreshed()
        {
          //it will return 1 when it is or 0 when is not
          $q = $this->execSQL("select * from news_post order by id desc limit 1") or die(mysqli_error());
            if(mysqli_num_rows($q)!=0){
            $row = mysqli_fetch_row($q);
             if($row[11]==0){
              //insert a new status update to the feed 
              //select the name of person from student data base
              //$student = $this->execSQL("select * from students where id_user=$row[2]") or die(mysqli_error());
              // $student = mysqli_fetch_row($student) or die(mysqli_error());
              // $html = '<li style="color:white;">'.$student[1].'  '.$student[2].' just posted <a href="#'.$row[0].'">'.addslashes( str_replace("\n", "<br/>", $row[3] ) ).'</a> on '.$row[9].'</li>';
              // $check = $this->execSQL("select * from announcements_feed where message='$html'") or die(mysqli_error());
              // if(mysqli_num_rows($check)==0){
              // $this->execSQL("insert into announcements_feed values(NULL,$row[0],'$html')")or die(mysqli_error());
              //}
                return 1;
               }

              }

         return -1;
        }
        
        function __destruct()
        {
           //destructor the cleaning memory heap alloc
        	 $this->_close();

        }

       
         /*function to connect to mysql */
         function _initDB()
         {
         	  $query = _DataBase::getConnection();
           return $query;
         }


          /*prevent code injection function */
          function preventInjections($var)
             {
                  $var = strip_tags($var);
                  $var = htmlentities($var);
                  $var = stripslashes($var);
                  return mysqli_real_escape_string(_DataBase::getConnection(),$var);
                 
             }
           
          function DestroySection()
             {
                if (session_id() != "" || isset($_COOKIE[session_name()]))
                    setcookie(session_name(), '', time()-2592000, '/');

             }
           /* query function */
           function executeSQL($query)
             {
                $result = mysqli_query($this->_initDB(), $query) or die(mysql_error());
                return $result;
             }

           function createTable($TableName, $query)
           {
           	 $this->executeSQL("CREATE TABLE IF NOT EXISTS $TableName($query)");
                echo 'Table Created or Already Exits<br/>';
           }

         function getNumVoters($post_id) {
      
           return mysqli_num_rows($this->executeSQL("select * from upvote where post_id=$post_id"));
         }

        function delete( $commentId ){ 
      
          $sql = "delete from news_post where id=$commentId";
      
          $query = $this->executeSQL($sql);

          if ( $query ) {

            return true;
          }
           return null;
        }

        function deleteReply( $commentId){ 
      // delete the comment from the comments database using the id of comment_id

      $sql = "delete from commenters where id=$commentId";
      
      $query = $this->executeSQL($sql);

      if ( $query ) {

        return true;
      }
      return null;

    }
    function getVoters($id)
   {
   
      $sql = "select * from upvote where post_id=$id order by id ";        
      $query = $this->executeSQL("SELECT * FROM upvote WHERE post_id=$id ORDER BY id");
      while($col = mysqli_fetch_row($query))
      { 
          $q = mysqli_fetch_row($this->executeSQL("SELECT * FROM member WHERE serialCode='$col[2]'"));
         echo '<a href="profile.php?view='.$q[1].'" ><img src="membersPhoto/'.$q[1].'.jpg" width="50px" height="50px" style="border-radius:100%;"></img></a>';

      }

   }

    function didPersonVoted($post_id,$user_id)
    {
        $q = mysqli_fetch_row($this->executeSQL("select * from member where id='$user_id'"));
       $check = mysqli_num_rows($this->executeSQL("select * from upvote where post_id=$post_id and id_upvoting='$q[3]'"));
     return $check;
    }
    function vote($post_id,$user_id) {
       $q = mysqli_fetch_row($this->executeSQL("select * from member where name='$user_id'"));
       $check = mysqli_num_rows($this->executeSQL("select * from upvote where post_id=$post_id and id_upvoting='$q[3]'"));
     
      if($check==0)
      {
       $this->executeSQL("insert into upvote value(NULL,$post_id,'$q[3]')") or die(mysql_error());
        $this->executeSQL("update news_post SET upvote=upvote+1 WHERE id=$post_id");
       
      }
        return mysqli_num_rows($this->executeSQL("select * from upvote where post_id=$post_id"));
    }

     function addView($post_id)
    {
      $this->executeSQL("update news_post SET post_view=post_view+1 WHERE id=$post_id");
      $row =mysqli_fetch_row($this->executeSQL("select * from news_post where id=$post_id"));
    
      return $row[6];
    
    }


          function newLanguages()
          {
             $langs = array("Afrikaans",
                               "Bahasa Indonesia",
                               "Bahasa Melayu",
                               "Català",
                               "Čeština",
                               "Deutsch",
                               "English",
                               "Español",
                               "Euskara",
                               "Français",
                               "Galego",
                               "IsiZulu",
                               "Íslenska",
                               "Italiano",
                               "Magyar",
                               "Nederlands",
                               "Polski",
                               "Português",
                               "Română",
                               "Slovenčina",
                               "Suomi",
                               "Svenska",
                               "Türkçe",
                               "Pусский",
                               "Српски",
                               "한국어",
                               "中文",
                               "日本語"
                               );
           for($i=0; $i<sizeof($langs); $i++)
           {
            echo"<div class='languageTranslate'>".$langs[$i]."</div>";
           }
      }

       function newsCategory()
          {
             $langs = array("General",
                               "Social",
                               "Entertainment",
                               "Funny",
                               "Politics",
                               "Economy",
                               "Music",
                               "Education",
                               "Social Networks",
                               "Research",
                               "Celebrity",
                               "Sports",
                               "Food");
           for($i=0; $i<sizeof($langs); $i++)
           {
            echo"<div class='choiceToRead'>".$langs[$i]."</div>";
           }
      }

      function slideShow($lang,$cat)
      {

          $query = $this->executeSQL("SELECT * FROM news_post WHERE post_language='$lang' AND post_category='$cat' ORDER BY upvote DESC LIMIT 10");
     
      echo' <div id="slide-show">
       <table>
                  <thead><th colspan="3">
                </th></thead>
                <tbody>
                <tr>
                  <td id="leftB">
                  <div id="moveLeft">

                   </div> 
                  </td>
                  <td id="slideW">';
                 for($i=0; $i<mysqli_num_rows($query); $i++){
                  $row =  mysqli_fetch_row($query);

                  echo '<img src="'.$row[3].'" caption="'.$row[2].'"><a  style="float:right; display:none; background-color:black;" href="index.php#'.$row[0].'" class="btn btn-info btn-lg">
              <span class="glyphicon glyphicon-arrow-down"></span>'.$row[2].'</a></img>';
                  }
                  //here we put the images with some src and captions and also links  
      echo' <div id="image-label">
                       <div id="ids">
                       <p></p>
                       </div>
                       </div>
                  </td>
                  <td id="rightB"> 
                  <div id="moveRight">

                  </div>
                  </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><div id="play-pause"> </div></td>
                </tr>
                </tbody>
               </table>
    </div>';
      }
         /**
           * Function to close db connection
           */
          function _close() {
              mysqli_close($this->_initDB());
          }

          function _insertBadges()
          {
            $this->executeSQL("INSERT INTO badges VALUES(NULL,0,'img/badge/fresh.png','Fresh Start'),
                                                        (NULL,5,'img/badge/freshChange.png','Getting notice'),
                                                        (NULL,15,'img/badge/famous1.png','On Fire Poster'),
                                                        (NULL,25,'img/badge/writter1.png','Writter'),
                                                        (NULL,35,'img/badge/writter2.png','Famous publisher')");
          }
       
          function getUserRep($user)
          {
            $query =  $this->executeSQL("SELECT * FROM member WHERE name='$user'");
            $col =  mysqli_fetch_row($query);
            $userId =  $col[3];
            $rep = $this->executeSQL("SELECT * FROM profile WHERE user_id='$userId'");
            $rep = mysqli_fetch_row($rep);
            return $rep[2];

          }

          function getWritterBadge($user)
          {
            $query =  $this->executeSQL("SELECT * FROM member WHERE name='$user'");
            $col =  mysqli_fetch_row($query);
            $userId =  $col[3];

            $rep = $this->executeSQL("SELECT * FROM profile WHERE user_id='$userId'");
            $rep = mysqli_fetch_row($rep);

            $userpost = $this->executeSQL("SELECT * FROM news_post WHERE id_posting='$userId'");
            $userpost = mysqli_num_rows($userpost);

            $badge =  $this->executeSQL("SELECT * FROM badges ORDER BY id");
            for($i=0; $i<mysqli_num_rows($badge); $i++)
            { 
                 $col = mysqli_fetch_row($badge);
                 if($userpost>=$col[1]){
                  if(mysqli_num_rows($this->executeSQL("SELECT * FROM profile WHERE user_id='$userId' AND badgename='$col[2]'"))!=1){
                    $this->executeSQL("INSERT INTO profile VALUES(NULL,'$userId',$rep[2],'$col[2]',$rep[4],$rep[5],'$col[3]')");
                  }
                 }
            }

           $rep = $this->executeSQL("SELECT * FROM profile WHERE user_id='$userId' ORDER BY id DESC");
           $length = mysqli_num_rows($rep);
           $query = $this->executeSQL("SELECT * FROM profile WHERE user_id='$userId'");
           for($i=0; $i<$length; $i++)
            {
              $rep=mysqli_fetch_row($query);
              if(strcmp($rep[3],'NULL')!=0){
              echo "<a href='' class='badgelinks' value='".$rep[6]."'><img src='".$rep[3]."' width='70px' height='70px'></img></a>";}
            }

          }



          //get constribution
          function getUserConstribution($user)
          {
            $col =  mysqli_fetch_row($this->executeSQL("SELECT * FROM member WHERE name='$user'"));
            return mysqli_num_rows($this->executeSQL("SELECT * FROM news_post WHERE id_posting='$col[3]'"));
          }
          //get user follower 
           function getUserFollower($user)
          {
            $col =  mysqli_fetch_row($this->executeSQL("SELECT * FROM member WHERE name='$user'"));
            return mysqli_num_rows($this->executeSQL("SELECT * FROM followers WHERE id_writter='$col[3]'"));
          }

          //get user stars
          function getUserStars($user)
          {
             $col =  mysqli_fetch_row($this->executeSQL("SELECT * FROM member WHERE name='$user'"));
             $prof =  mysqli_fetch_row($this->executeSQL("SELECT * FROM profile WHERE user_id='$col[3]'"));
             for($i=0; $i<$prof[4]; $i++)
             {
                echo "<div> <span class='glyphicon glyphicon-star'></span></div>";
             }
          }
      
          //get post commenters and comments
          function getComments($posterId,$postTitle,$postTime)
          {
           $result = $this->executeSQL("SELECT * FROM commenters WHERE user_posting='$posterId' AND post_title='$postTitle' AND post_time=$postTime");
           $length= $this->executeSQL("SELECT * FROM commenters WHERE user_posting='$posterId' AND post_title='$postTitle' AND post_time=$postTime");
           while($query = mysqli_fetch_array($result)){
              $saveto = "membersPhoto/$query[4].jpg";
         echo '<table style="background-color:rgba(0,0,0,0.1);border-bottom: 1px solid rgba(0,0,0,0.2); width:80%; margin-left:10%; z-index:999999;" class="reply-buttons-holder" id="commenter'.$query[0].'"><thead><th colspan="2"></th></thead>';
         echo '<tbody><tr><td>';
         echo '<img src="'.$saveto.'" style="border-radius:100%;width:40px;height:40px;"/>';
         echo  $query[4].'<font color="#a1a1a1" id="reply'.$query[0].'">';
         echo '<script type="text/javascript">';
         echo 'var div = "#reply"+'.$query[6].';';
         echo '$(div).text("    "+$.timeago('.$query[6].'))';
         echo '</script>';
         echo '</font></td><td>';
         echo '<div>';
         echo '<ul id="ulR'.$query[6].'">';
         if(isset($_SESSION['user'])){
         $name = $_SESSION['user']; 
         $user =  mysqli_fetch_row($this->executeSQL("select * from member where name='$name'"));
         if($user[3]==$posterId){echo '<li id="'.$query[0].'" class="delete-replybtn"><span class="glyphicon glyphicon-trash"></span></li>';}
         }
         echo '</ul>';
         echo '</div></td></tr>';
         echo '<tr id="tableTextTr"><td style="font-weight: bold;">'.$query[5].'</td>';
         echo '</tr></tbody></table>';

             }
           
          }

    
       function getGlobalNews($user,$lang,$cat)
       {
     
          $query = $this->executeSQL("SELECT * FROM news_post WHERE post_language='$lang' AND post_category='$cat' ORDER BY upvote DESC");
          
          for($i=0; $i<mysqli_num_rows($query); $i++)
          { 
           $row =  mysqli_fetch_row($query);
           $userName = $this->executeSQL("SELECT * FROM member WHERE serialCode='$row[1]'");
           $userName = mysqli_fetch_row($userName);
          
           if(file_exists("membersPhoto/$userName[1].jpg"))
           { 
            $saveto = '<img src="membersPhoto/'.$userName[1].'.jpg" style=" margin-left:3%;border-radius:100%;width:70px;height:70px;"/>
              ';
           }else{
              $saveto = '<span class="glyphicon glyphicon-user" style="color:rgba(64,153,255, 0.9);font-size:30px; margin-left:3%;border-radius:100%;width:70px;height:70px;"></span>';
           }
          echo '<div class="post_news" id="news'.$row[0].'">
          <table style="background-image:url('.$row[3].'); background-size:100% 100%; "> 
          <thead><th colspan="4"></th></thead>
          <tbody>
            <tr>
           <td>';
           if($this->didPersonVoted($row[0],$userName[0])>=1){
           echo '<div id="'.$row[0].'" class="upvote-btn" name="'.$user.'" style="color:black; font-size:24px;"><div style=" width:90px; height:70px; background-color:rgba(0,0,0,0.2);"><center><span class="glyphicon glyphicon-chevron-up" style=" color:  rgba(64,153,255, 0.9);font-size:34px; cursor:pointer;"></span></center>
           <center><p>+'.$this->getNumVoters($row[0]).'</p></center></div></div>';
         }else{
           echo '<div id="'.$row[0].'" class="upvote-btn" name="'.$user.'" style="color:black; font-size:24px;"><div style=" width:90px; height:70px; background-color:rgba(0,0,0,0.2);"><center><span class="glyphicon glyphicon-chevron-up" style=" color:  rgba(1,1,1, 0.9);font-size:34px; cursor:pointer;"></span></center>
           <center><p>+'.$this->getNumVoters($row[0]).'</p></center></div></div>';
         }
          echo'</td>
            <td>
             <a href=profile.php?view='.$userName[1].' id="user">'.$saveto.'</a>
            </td>
            <td style=" color:white; background-color: rgba(1,1,1,0.3);font-weight: bold;" ><div class="postTitle" >'.$row[2].'<label style=" margin-left:2%; background-color: rgba(1,1,1,0.3); color:white;">+'.$row[6].'</lable><span class="glyphicon glyphicon-eye-open"></div></td>
             <td><font color="#a1a1a1" style="margin-left:5px; color:white; ;background-color: rgba(1,1,1,0.5);" id="timepost'.$row[9].'">';

              echo '<script type="text/javascript">';
              echo 'var div = "#timepost"+'.$row[9].';';
                  echo '$(div).text($.timeago('.$row[9].'))';
                  echo '</script>';
                  echo '</font>';
                  echo '</td>
                  <td>';
                  echo '<div id="comment-buttons-holder">';
                  echo '<ul class="shareButtons" id="ul'.$row[0].'">';
                  
                  if($user==$userName[1]){  
                  echo '<li id="'.$row[0].'" class="delete-btn" name="'.$userName[1].'"  style=";background-color: rgba(1,1,1,0.5);color:red;"><span class="glyphicon glyphicon-trash" ></span></li>'; 
                  }else{
                 
                  }
                   echo '</ul>';  
           echo '</div>
          </td>
          </tr>
        </tbody>
       </table>
       <div id="box'.$row[0].'" class="" value="'.$row[0].'" style="display:none;">
       <div style="display: block; width: 80%;margin-left:10%;font-size: 14px;word-wrap: normal;">
                    '.$row[5].'</div>';
       if (filter_var($row[4], FILTER_VALIDATE_URL) === FALSE) {
                     //echo "invalid";
                   }else{
                    echo '<center><iframe  style="background-color: rgba(1,1,1,0.5);" width="500" height="400" src="'.$row[4].'" frameborder="0" allowfullscreen></iframe></center>';
                   }
         //lets implement the share table 
        echo '<table style="margin-top:100px;"><thead><th colspan=3></th></thead>
        <tbody>
        <tr>
        <td>
        <div id="'.$row[0].'" class="share-btn" name="'.$userName[1].'"><label class="fb-share-button"  data-href="https://linkedVoice.com/index.php#'.$row[0].'" data-layout="box_count"></label></div>
        </td>
        </tr>
        </tbody></table>';
        echo'<div>
            <div style="background-color: rgba(255,255,255,0.3); width:80%; margin-left:10%; margin-top:10%;">';
             $this->getComments($row[1],$row[2],$row[9]);
            echo '</div>';
          echo '<input type="text" id="comment" name="comment" placeholder="input a comment" style="width:75%; min-height:50px; border:1px; margin-top:5%; margin-left:12%; margin-bottom:2%;"></input>
          <button type="button" class="buttonComment" class="btn btn-default btn-sm" name="'.$row[1].'" title="'.$row[2].'" time="'.$row[9].'"  caption="'.$user.'">
                  <span class="glyphicon glyphicon-share-alt"></span> Post
          </button> </div>';
       echo '<div class="upVoters">Voters :';
        $this->getVoters($row[0]);
       echo '</div>
     </div>
    </div>';
  }
    }

    function getUserNews($user)
       {
          $userName = $this->executeSQL("SELECT * FROM member WHERE name='$user'");
          $userName = mysqli_fetch_row($userName);
          $query = $this->executeSQL("SELECT * FROM news_post WHERE id_posting='$userName[3]' ORDER BY post_time DESC");
         
          for($i=0; $i<mysqli_num_rows($query); $i++)
          { 
           $row =  mysqli_fetch_row($query);
           $saveto = "membersPhoto/$userName[1].jpg";
          echo '<div class="post_news" id="news'.$row[0].'">
          <table style="background-image:url('.$row[3].'); background-size:100% 100%; "> 
          <thead><th colspan="4"></th></thead>
          <tbody>
            <tr>
           <td>';
             if($this->didPersonVoted($row[0],$userName[0])>=1){
           echo '<div id="'.$row[0].'" class="upvote-btn" name="'.$user.'" style="color:black; font-size:24px;"><div style=" width:90px; height:70px; background-color:rgba(0,0,0,0.2);"><center><span class="glyphicon glyphicon-chevron-up" style=" color:  rgba(64,153,255, 0.9);font-size:34px; cursor:pointer;"></span></center>
           <center><p>+'.$this->getNumVoters($row[0]).'</p></center></div></div>';
         }else{
           echo '<div id="'.$row[0].'" class="upvote-btn" name="'.$user.'" style="color:black; font-size:24px;"><div style=" width:90px; height:70px; background-color:rgba(0,0,0,0.2);"><center><span class="glyphicon glyphicon-chevron-up" style=" color:  rgba(1,1,1, 0.9);font-size:34px; cursor:pointer;"></span></center>
           <center><p>+'.$this->getNumVoters($row[0]).'</p></center></div></div>';
         }
           echo'</td>
            <td>
             <a href=profile.php?view='.$userName[1].' id="user"><img src="'.$saveto.'" style=" margin-left:3%;border-radius:100%;width:70px;height:70px;"/></a>
            </td>
            <td style=" color:white; background-color: rgba(1,1,1,0.3);font-weight: bold;" ><div class="postTitle" >'.$row[2].'<label style=" margin-left:2%; background-color: rgba(1,1,1,0.3); color:white;">+'.$row[6].'</lable><span class="glyphicon glyphicon-eye-open"></div></td>
             <td><font color="#a1a1a1" style="margin-left:5px; color:white; ;background-color: rgba(1,1,1,0.5);" id="timepost'.$row[9].'">';

              echo '<script type="text/javascript">';
              echo 'var div = "#timepost"+'.$row[9].';';
                  echo '$(div).text($.timeago('.$row[9].'))';
                  echo '</script>';
                  echo '</font>';
                  echo '</td>
                  <td>';
                  echo '<div id="comment-buttons-holder">';
                  echo '<ul id="ul'.$row[0].'">';
                  
                  if($user==$userName[1]){  
                  echo '<li id="'.$row[0].'" class="delete-btn" name="'.$userName[1].'"  style=";background-color: rgba(1,1,1,0.5);color:red;"><span class="glyphicon glyphicon-trash" ></span></li>'; 
                   }else{
                   }
                   echo '</ul>';  
           echo '</div>
          </td>
          </tr>
        </tbody>
       </table>
       <div id="box'.$row[0].'" class="" value="'.$row[0].'" style="display:none;">
       <div style="display: block; width: 80%;margin-left:10%;font-size: 14px;word-wrap: normal;">
                    '.$row[5].'</div>';
          if (filter_var($row[4], FILTER_VALIDATE_URL) === FALSE) {
                     //echo "invalid";
                   }else{
                    echo '<center><iframe  style="background-color: rgba(1,1,1,0.5);" width="500" height="400" src="'.$row[4].'" frameborder="0" allowfullscreen></iframe></center>';
                   }
        //lets implement the share table 
        echo '<table><thead><th colspan=3></th></thead>
        <tbody>
        <tr>
        <td>
        <div id="'.$row[0].'" class="share-btn" name="'.$userName[1].'"><label class="fb-share-button"  data-href="https://linkedVoice.com/index.php#'.$row[0].'" data-layout="box_count"></label></div>
        </td>
        </tr>
        </tbody></table>';
        echo'<div>
            <div style="background-color: rgba(255,255,255,0.3); width:80%; margin-left:10%; margin-top:10%;">';
             $this->getComments($row[1],$row[2],$row[9]);
            echo'
            </div>
          <input type="text" id="comment" name="comment" placeholder="input a comment" style="width:75%; min-height:50px; border:1px; margin-top:5%; margin-left:12%; margin-bottom:2%;"></input>
          <button type="button" class="buttonComment" class="btn btn-default btn-sm" name="'.$row[1].'" title="'.$row[2].'" time="'.$row[9].'"  caption="'.$user.'">
                  <span class="glyphicon glyphicon-share-alt"></span> Post
          </button> </div>';
       echo '<div class="upVoters">Voters :';
        $this->getVoters($row[0]);
       echo '</div>
     </div>
    </div>';
      }//close loop


    }//close method



    }
      ?>