<?php 
    $umov = get_field('use_megahero_or_video' );
	if ($umov && $umov !== 'none'):
        echo '<div class="megahero" style="height: 600px; width: 100%;">';
        if ($umov === 'image'): 
        $img = get_field('megahero_image'); ?>
        <div class="megahero_img" style="background-image: url(<?php echo $img['url']; ?>); ">
        </div>
        <?php else: // is video
        $vid = get_field('megahero_video');
        // print_r($vid);
        ?>
        <video autoplay loop muted style="object-fit: cover;">
            <source src="<?php echo $vid['url']; ?>" type="video/mp4">
        </video>
        <?php endif;
        echo "</div>";
    endif;
?>