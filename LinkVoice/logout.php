<?php
  include_once('definitions.php');

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
  
}
    	 $object->DestroySection();
    	 header("Location:  index.php");

?>