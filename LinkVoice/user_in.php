  <?php
   include_once("definitions.php");
  $error = $user = $pass="";
        $error2 = $newuser =$newId = $newpass = $newemail ="";
        $notValid ;
     
 if (isset($_POST['user']) && isset($_POST['pass']))
  {
       echo '<script type="text/javascript"> alert("fields are missing<br />");</script>';
      $user = $object->preventInjections($_POST['user']);
      $pass = $object->preventInjections($_POST['pass']);

      if ($user == "" || $pass == ""  )
      {
          echo '<script type="text/javascript"> alert("fields are missing<br />");</script>';
      }
      else
      {
          $query = "SELECT name,password FROM member
              WHERE name='$user' AND password='$pass'";

          if (mysqli_num_rows($object->executeSQL($query)) == 0)
          {
              echo '<script type="text/javascript"> alert("user name/password invalid<br />");</script>';
          }
          else
          {
            
              session_start();
              $_SESSION['user'] = $user;
              $_SESSION['pass'] = $pass;
              header ("Location: profile.php");
              exit();
          }
      }
  }




  if (isset($_SESSION['newname'])) $object->DestroySection();


  if (isset($_POST['newname']) && isset($_POST['email']) && strlen($_POST['email'])>=10)
  {
      $newuser = $object->preventInjections($_POST['newname']);
      $newpass = $object->preventInjections($_POST['password']);
      $newId   = $object->preventInjections($_POST['id']);
      $newemail= $object->preventInjections($_POST['email']);
    
      echo "<script>console.log('name = '".$newuser."</script>";
      if(strtolower($newuser) == "gay" || strtolower($newuser) == "suck" ){ $error2= "Invalid userName host!";
         $notValid = false;}else{$notValid = true;}
      
      if ($newuser == "" || $newpass == "" || $newemail == " "){
          $error2 = "Not all fields were entered";
          echo '<script type="text/javascript"> alert("error '.$error2.'"); </script>';
     } else
      {  
           if($notValid){
         
          if(mysqli_num_rows($object->executeSQL("SELECT * FROM member
                WHERE name='$newuser'")) || mysqli_num_rows($object->executeSQL("SELECT * FROM member
                WHERE email='$newemail'")))
          {
             $error2 = "That UserName / Email already exits host!";
             echo '<script type="text/javascript"> alert("error ='.$error2.'"); </script>';

          }else
            {
                echo '<script type="text/javascript"> console.log("succesful in the valid"); </script>';

              $object->executeSQL("INSERT INTO member VALUES(null,'$newuser', '$newemail', '$newId', '$newpass')");
              $object->executeSQL("INSERT INTO profile VALUES(NULL,'$newId',0,'NULL',0,0,'NULL')");
              die();
          }
      }
      }
  }
  

        

  ?>