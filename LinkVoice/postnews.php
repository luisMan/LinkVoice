<?php
   include_once("definitions.php"); 
   if(isset($_POST['user']) && isset($_POST['title']) && isset($_POST['newsText']))
   {
          $user =  $object->preventInjections($_POST['user']);
          $postTitle =  $object->preventInjections($_POST['title']);
          $img  =$_POST['img'];
          $video = $_POST['video'];
          $newsText =  addslashes( str_replace("\n", "<br/>",$_POST['newsText'] ) );
          $date =  $_POST['time'];
          $language = $_POST['language'];
          $category = $_POST['category'];

          if(strlen($img)<=0)
          	$img = "NULL";

          if(strlen($video)<=0)
          	$video="NULL";

          $userId = $object->executeSQL("SELECT * FROM member WHERE name='$user'");
          $col = mysqli_fetch_row($userId);
          $respon = $object->executeSQL("INSERT INTO news_post VALUES(NULL,'$col[3]','$postTitle','$img','$video','$newsText',0,'$language','$category','$date',0,0)");
          echo $respon;
   }

  

  //post any new oncoming post and return the html entity of such element 
   if(isset($_POST['title'])&&isset($_POST['id']) &&isset($_POST['time'])){
        $title = $_POST['title'];
        $news_id = $_POST['id'];
        $news_time = $_POST['time'];
        $commenter = $_POST['commenter'];
        $time_post = $_POST['time_posted'];
        $text = $object->preventInjections($_POST['text']);
        $saveto = "membersPhoto/$commenter.jpg";
        if(strlen($commenter)>0){
        $object->executeSQL("INSERT INTO commenters VALUES(null,'$news_id','$title',$news_time,'$commenter','$text',$time_post,0)");
          $num = 1;
          echo '['; 
            echo '{';
            echo '"saveto":"'.$saveto.'",';
            echo '"text":"'.$text.'",';
            echo '"name":"'.$commenter.'",';
            echo '"result":'.$num.',';
            echo '"timePost":'.$time_post;
            echo '}';    
          echo ']';
        }else{
          $num = 0;
           echo '['; 
            echo '{';
            echo '"result":'.$num;
             echo '}';    
          echo ']';
        }

   }


  /*===============================DELECT POST===========================*/
  if ( isset( $_POST['task'] ) && $_POST['task'] == 'comment_delete') { 


      if($object->delete($_POST['announcement_id'] ) ) {
        echo 'true';
      }
    
    echo 'false';

  }
  /*=============================END DELECT POST======================*/

   /*=============================== delete Reply  POST===========================*/
  if ( isset( $_POST['task'] ) && $_POST['task'] == 'reply_delete') { 

            if($object->deleteReply($_POST['announcement_id'])){
             echo "true";
           }

    echo 'false';

  }
  /*=============================END delete reply POST======================*/
  /*=============================== upvote   POST===========================*/
  if ( isset( $_POST['task'] ) && $_POST['task'] == 'upvote_post') { 
      
           if(strlen($_POST['user_id'])>0){
            echo $object->vote($_POST['announcement_id'],$_POST['user_id']);
          }
       
    }

  
  /*=============================END upvote POST======================*/
  /*=============================== upvote   POST===========================*/
  if ( isset( $_POST['task'] ) && $_POST['task'] == 'add_view') { 
      
            echo $object->addView($_POST['announcement_id']);

  }
  /*=============================END upvote POST======================*/

?>