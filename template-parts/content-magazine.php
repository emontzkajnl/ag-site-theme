<?php //if ($first_mag == false): ?>
<div class="col-12 m-col-4 l-col-3 mag custom-article-list">
	<a href="<?php echo esc_url( get_permalink() ); ?>">
	<?php ag_sites_post_thumbnail(get_the_ID(), 'stm-gm-635-345'); ?>
    </a>
	
	<?php 
	
	echo '<a href="'.esc_url( get_permalink() ).'"><h2>'.get_the_title().'</h2></a>';?>
	
</div>
<?php //endif; $first_mag = false; ?>