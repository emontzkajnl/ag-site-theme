<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a class="unstyle-link" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			// ag_sites_posted_on();
			// ag_sites_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php //ag_sites_post_thumbnail('small-thumb');
	echo '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail( get_the_ID(), 'small-thumb' ).'</a>'; ?>

	<!-- <footer class="entry-footer"> -->
		<?php //ag_sites_entry_footer(); ?>
	<!-- </footer>.entry-footer -->
	<hr />
</article><!-- #post-<?php the_ID(); ?> -->
