/* programmer Luis Manon */



!function(){}();
$(document).ready(function() {
  // var slideAttr = ["img/hungryWorm.png","img/fruitPlanet.png","img/java.png","img/title.jpg","img/web.png"];
  // var slideCapt =["Hungry Worm World 2d Game","Fruit Planet Comming soon","Java is fun NioCoder Engine is base on java","Hit the Rabit our new Game on Android","Web developnment is awsome why don't you try it"];
   var runningAttr=['img/playing.png','img/paused.png'];
   var running=true, index =0;
   //var slideTOp = slideAttr.length , counter = 0, speed = 2000;//secs ;
   var speed =2000;
   var slideTimer = 5000;
   var nextSlide = $("#slideW img:first-child");
    var eagle = $('#eagle');
    var ScreenX = 0;
    var ScreenY = 0;
    var FlyUPDown= true;
    var FlyRight = true;
    var viewWidth = $( window ).width();
    var viewHeight = $( window ).height();

  // preload images
/* var loadImages =  function()
 {
  $('#slideW img').each(function()
  {
     //create a  new Image object
     var swappedImage = new Image();
         $(this).attr('src',slideAttr[index]); 
         $(this).attr('caption',slideCapt[index]);
         index++;

  });

    
 }
 
 window.onload = loadImages;*/

 //=================================Slide function =============================//
  
     function isRunning()
     {
        if(running)
            running = false;
        else
            running = true;
     }
     
    function setSlide(nextSlide, index)
    {
              $('#play-pause').css('background-image', 'url('+ runningAttr[index]+')');
               $('#play-pause').css('background-repeat', 'no-repeat');
               $('#play-pause').animate({opacity: 1});

                     var slideB = $('#slideW');
                     $('#captions').animate({left: '0'},speed);
                   slideB.fadeIn(speed-1000);
                   slideB.animate({
                   opacity: 1},speed+1000);     
                    if(nextSlide.next().is("a")){
                       nextSlide.next().slideToggle(100);
                    }            
                   slideB.css('background-image', 'url('+nextSlide.attr('src')+')');
                   slideB.css('background-repeat', 'no-repeat');
                   slideB.css('background-size', '100%');
                   slideB.css('width',' 1000px');
                   slideB.css('height','300px');
                   slideB.css('z-index','1');
                   //Call to my Caption Text
                   $('#ids').fadeIn(1000);
                   $('#ids p').text(nextSlide.attr('caption'));
                   
                     //navigate to my next child 
                   slideB.animate({
                   opacity: 0.10},speed);
                    if(nextSlide.next().is("a")){
                       nextSlide.next().slideToggle(speed+5000);
                    }         


    }

  function setSlideOff(nextSlide, index)
  {
        $('#play-pause').css('background-image', 'url('+ runningAttr[index]+')');
               $('#play-pause').css('background-repeat', 'no-repeat');
               $('#play-pause').animate({opacity: 1});

                     var slideB = $('#slideW');
                   slideB.animate({
                   opacity: 1},speed);                  
                   slideB.css('background-image', 'url('+nextSlide.attr('src')+')');
                   slideB.css('background-repeat', 'no-repeat');
                   slideB.css('background-size', 'cover');
                   slideB.css('z-index','1');
                   //Call to my Caption Text
                   $('#ids p').text(nextSlide.attr('caption'));
                     //navigate to my next child 
                  
  }
         timer =  setInterval(function(){
                  if(running)
                   { 
                   
                    if(nextSlide.next().length>0){

                        setSlide(nextSlide, 0);
                        nextSlide = nextSlide.next().next();
                   }else
                   {
                      nextSlide =  $("#slideW img:first-child");
                   }//end of else
                  
                 }else{
                   
                    setSlideOff(nextSlide,1);
                 }//end of else boolean


  }, slideTimer); // end image slide

$('#play-pause').click(function()
{
   isRunning(); 

});

$('#moveRight').click(function(){
     running = false;
   if(nextSlide.next().length > 0)
   { 
       nextSlide =  nextSlide.next();

   }else{
        nextSlide =  $("#slideW img:first-child");
       
   }
});
$('#moveLeft').click(function(){
   running = false;
   if(nextSlide.prev().length > 0)
   { 
       nextSlide =  nextSlide.prev();
      

   }else{
        nextSlide =  $("#slideW img:last-child");
       
   }
});
 

 

});