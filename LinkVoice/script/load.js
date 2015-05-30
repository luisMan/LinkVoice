!function()
{
     var startIndex  =0;
     var stopIndex = 10;
     var endIndex=0;
     var endHeight = 180;
     //get end index 
     $(".post_news").each(function()
     {
         endIndex++;
     });

     //right now i have the start index and stopindex likewise the max number of post 
     //make all the other post invisible from stop index
     for(var i=stopIndex; i<endIndex; i++)
     {
     	$(".post_news").eq(i).css({"display":"none"});
     }
     
   //lets now listen to page scroll 
   $(window).load(function(){
   $(window).scroll(function() {
   if($(window).scrollTop() >= endHeight) {
   	   console.log("at the bottom");
   	   //$("#stats").html("Loading more content..");
   	   //$("#stats").fadeIn(5000).delay(10000);

   	   if(stopIndex<=endIndex)
   	   {
   	   	   var temp = stopIndex+10;
   	   	   for(var i = stopIndex; i<temp; i++)
   	   	   {
   	   	   	$(".post_news").eq(i).slideToggle(1000);
   	   	   }
          stopIndex = temp;
          endHeight+=700;
   	   }else{
   	   	// $("#stats").html("no more data to pull");
         //$("#stats").fadeOut(100);
   	   }
     
   }else{
   	  //$("#stats").fadeOut(100);
   }

   });
    });


  
}();
