<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

get_header();
	// $calameo = get_post_meta(get_the_ID(  ), 'calameo_id');
	// echo '<div class="col-12 m-col-12"><iframe style="margin: 0 auto;" src="//v.calameo.com/?bkcode=' . $calameo[0] . '&amp;page=1" width="100%" height="800" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe></div></div>'; 
	// echo '<div class="col-12 m-col-12"><h2 class="page-header">Read Past Issues</h2></div><div class="row">';
?>

	<main id="primary" class="site-main container">



			<header class="page-header">
				<?php
					$q = get_queried_object(  );
					
						the_archive_title( '<h1 class="page-title">', '</h1>' );
				
				//  the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php $first = get_posts(array(
				'posts_per_page'		=> 1,
				'post_type'				=> 'magazine',
				'post_status'			=> 'publish',
			));
			if ($first) {
				$calameo = get_post_meta(get_the_ID(  ), 'calameo_id');
				echo '<div class="col-12 m-col-12"><iframe style="margin: 0 auto;" src="//v.calameo.com/?bkcode=' . $calameo[0] . '&amp;page=1" width="100%" height="800" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe></div>'; 
			} else {
				echo 'there is no post.';
			} ?>
		<?php if ( have_posts() ) : 
			$first_mag = false; ?>
		<div class="wp-block-columns ag-site-sidebar-layout">
			<div class="wp-block-column">

		
		<div class="row">
			<h2 class=" col-12 m-col-12">Previous Magazines</h2>
			<?php while ( have_posts() ) :
				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				if ($first_mag):
				get_template_part( 'template-parts/content', 'magazine' );
				endif;
				$first_mag = true;
				
			endwhile;
			echo '</div>';
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
			</div>
			<div class="wp-block-column">
				<?php get_sidebar('category-sidebar'); ?>
			</div>
		</div>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
