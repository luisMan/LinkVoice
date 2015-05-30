<?php
  //language href
   $language=""; $category="";
   if(isset($_POST['language']))
   {
   	   $language = $_POST['language'];
         setcookie("language",$language,time()+3600);

   }

   if(isset($_POST['category'])){
   	$category = $_POST['category'];
      setcookie("category",$category,time()+3600);
      
   }

   if(isset($_GET['language']))
   {
         $language = $_GET['language'];
         setcookie("language",$language,time()+3600);

   }

   if(isset($_GET['category'])){
      $category = $_GET['category'];
      setcookie("category",$category,time()+3600);
      
   }

if ((!isset($_COOKIE['language']) ) && (!isset($_COOKIE['category']))){
$language = "english";
$category="general";
}
#if cookies are set then use them
if(isset($_COOKIE['language'])){
$language = $_COOKIE['language'];
}
if(isset($_COOKIE['category'])){
$category = $_COOKIE['category'];
}
      
 
?>