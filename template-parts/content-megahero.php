<?php 
    $umov = get_field('use_megahero_or_video' );
	if ($umov && $umov !== 'none'):
        echo '<div class="megahero">';
        if ($umov === 'image'): 
        $img = get_field('megahero_image'); ?>
        <div class="megahero_img" style="background-image: url(<?php echo $img['url']; ?>); ">
        </div>
        <?php else: // is video
        endif;
        echo "</div>";
    endif;
?>