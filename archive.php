<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					if( function_exists('the_ad_placement') ) { 
						the_ad_placement('leaderboard');
					}
					// print_r($q);
				
				// the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<!-- set up two columns -->
			<div class="wp-block-columns ag-site-sidebar-layout">
			<div class="wp-block-column">
			<!-- <div class="col-12 m-col-9"> -->
			<?php $q = get_queried_object(  );
					if (is_category(  )) {
						echo '<h1 class="page-title">'.$q->cat_name.'</h1>';
						echo '<p style="font-size: 20px;">'.$q->category_description.'</p>';
					} else {
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					} ?>
				<div class="row">

			
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				if ($wp_query->current_post === 4 && function_exists('the_ad_placement') ){
					echo '</div><div style="display: flex; justify-content: center;">';
					the_ad_placement('in-content');
					echo '</div><div class="row">';
				}
				get_template_part( 'template-parts/content', 'get_post_type()' );
				

			endwhile; ?>
			</div>
			<?php the_posts_navigation(); ?>
			</div>

		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		<div class="wp-block-column">
		<?php get_sidebar('category'); ?>
		</div>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
