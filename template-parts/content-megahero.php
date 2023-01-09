<?php 
    $umov = get_field('use_megahero_or_video' );
	if ($umov && $umov !== 'none'):
        echo '<div class="megahero">';
        if ($umov === 'image'): 
        $img = get_field('megahero_image'); ?>
        <div class="megahero_img" style="background-image: url(<?php echo $img['url']; ?>); ">
        </div>
        <?php elseif ($umov === 'video'): // is video
        $vid = get_field('megahero_video');
        // print_r($vid);
        ?>
        <video autoplay loop muted style="object-fit: cover;">
            <source src="<?php echo $vid['url']; ?>" type="video/mp4">
        </video>
        <?php else: // is youtube 
        $yt = get_field('megahero_youtube'); ?>
        <div id="player"></div> 
        <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
        //   height: 'auto',
        //   width: '100%',
          videoId: '<?php echo $yt; ?>',
          playerVars: {
            'playsinline': 1,
            'loop'       : 1,
            'controls'   : 0,
            'fs'        : 0,
            'disablekb'  : 1,
            'modestbranding': 1,
            'playlist'   : '<?php echo $yt; ?>'
          },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }
      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.setVolume(0);
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
    //   var done = false;
      function onPlayerStateChange(event) {
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
        <?php endif;
        echo "</div>";
    endif;
?>