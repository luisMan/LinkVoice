    <div class="voice_content">
      <div class="foremost_tag">
        <ul>
          <li id="foremost_language">News Languages</li>
          <li id="foremost_news">Foremost News click me!</li>
        </ul>
      </div>
      <div class="foremost_content">
       <!-- contents that refers to the hot topics on the news -->
       <div class="languages">
        <?php $object->newLanguages();?>
       </div>
       <div class="foremost_n">
         <?php $object->slideShow($language,$category);?>
       </div>
     </div>
     <div class="voice_news">
      <!-- contents that refers to all hot news topics on the news -->
    <div class="userPost">
       <?php $object->getGlobalNews($user,$language,$category);?>

    </div><!--close voice news -->

    <div class="voice_advertisement">
      <!-- contents that refers to all hot news topics on the news -->

    </div>
    </div>