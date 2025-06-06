<?php
/**
 * The template for displaying all single magazine posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ag_Sites
 */

get_header();
?>

	<main id="primary" class="site-main container">
    <?php if( function_exists('the_ad_placement') ) { 
			the_ad_placement('top-leaderboard');
		} ?>
        <div class="row">

		<?php
		while ( have_posts() ) :
			the_post();
			// get_template_part( 'template-parts/content', get_post_type() );
            echo '<h1 class="page-header col-12">'.get_the_title(  ).'</h1>';
            echo '<div class="col-12">';
            echo the_content();
            echo '</div>';
            $calameo = get_post_meta(get_the_ID(  ), 'calameo_id');
            echo '<div class="col-12 m-col-12 mag-container"><iframe style="margin: 0 auto;" src="//v.calameo.com/?bkcode=' . $calameo[0] . '&amp;page=1" width="100%" height="800" frameborder="0" scrolling="no" allowfullscreen="allowfullscreen"></iframe></div>'; 
            ?>
            

            <?php
            $mag_args = array(
                'post_type'         => 'magazine',
                'posts_per_page'    => -1,
                'post_status'       => 'publish',

            );
            $mag_list = new WP_Query($mag_args);

            if ($mag_list->have_posts()): ?>
                <h2 class="col-12 m-col-12">All Magazines</h2>
                <?php while ($mag_list->have_posts()): $mag_list->the_post();
                get_template_part( 'template-parts/content', 'magazine' );
                endwhile; 
            endif;
             // the_post_navigation(
			// 	array(
			// 		'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'ag-sites' ) . '</span> <span class="nav-title">%title</span>',
			// 		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'ag-sites' ) . '</span> <span class="nav-title">%title</span>',
			// 	)
			// );

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>
        </div>
	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
