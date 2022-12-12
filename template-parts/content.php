<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ag_Sites
 */

?>
<?php if ( is_singular() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-content '); ?>>
	<?php if( function_exists('the_ad_placement') ) { 
			the_ad_placement('leaderboard');
		} ?>


	
	<div class="ag-site-sidebar-layout wp-block-columns">
	<div class="wp-block-column">
	<header class="entry-header">
		<?php
		
		$categories = get_the_terms( get_the_ID(  ), 'category' );
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				
				if ($categories) : ?>
					<div class="category-wrap">
						<ul>
							<?php foreach ($categories as $category): ?>
								<li><a class="background__primary" href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					
				<?php endif;

				the_title( '<h1 class="entry-title">', '</h1>' );
				ag_sites_posted_by();
				// echo ' | ';
				// ag_sites_posted_on();
				if (function_exists( 'ADDTOANY_SHARE_SAVE_KIT' )) {
					echo do_shortcode('[addtoany url="' . esc_url(get_the_permalink(get_the_ID())).'" ]');
				}
				if (get_field('subheading')) {echo '<p class="post-excerpt">'.get_field('subheading').'</p>';}
				if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
				  }
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ag-sites' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ag-sites' ),
				'after'  => '</div>',
			)
		);
		// you might also like section
		if ($categories) {
			$cat_ids = [];
			foreach($categories as $c){
				$cat_ids[] = $c->term_id;
			}
			$rel_args = array(
				'post_type'         => 'post',
				'post_status'       => 'publish',
				'posts_per_page'    => 3,
				'orderby'           => 'rand',
				'category__in'      => $cat_ids
			);
			$rel_articles = new WP_Query($rel_args);
			if ($rel_articles->have_posts( )): ?>
			<div class="related-articles">
				<h2 class="comment-reply-title font__serif" style="text-align: center;">You Might Also Like</h2>
				
				<ul class="row">
				<?php while ($rel_articles->have_posts()): $rel_articles->the_post(); ?>
				<li class="col-12 m-col-4">
					<a href="<?php echo get_the_permalink(); ?>">
						<div class="two-thirds-container">
							<?php echo get_the_post_thumbnail( ); ?>
						</div>
					</a>
						<?php $yoast_primary_key = get_post_meta( get_the_ID( ), '_yoast_wpseo_primary_category', TRUE );  
						// if ($yoast_primary_key) { echo '<p class="cat-text"><a href="'.get_category_link( $yoast_primary_key ).'">'.get_cat_name($yoast_primary_key).'</a></p>'; } ?>
						<h3><a class="title-link" href="<?php echo get_the_permalink(  ); ?>"><?php echo get_the_title(); ?></a></h3>
				</li>
				<?php endwhile;
				echo '</ul></div>';
			endif;
			wp_reset_postdata( );
		}
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
		
	</div><!-- .entry-content -->
	<div class="wp-block-column sticky">
		<?php get_sidebar(); ?>
	</div>
	</div>

	<footer class="entry-footer">
		<?php // ag_sites_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php else: ?>
	<?php $cat = get_the_category(get_the_ID()); ?>
	<div class="col-12 m-col-12 l-col-6 custom-article-list">
	<a href="<?php echo esc_url( get_permalink() ); ?>">
	<div class="two-thirds-container">
	<?php ag_sites_post_thumbnail(get_the_ID(), 'stm-gm-635-345'); ?>
	</div></a>
	
	<?php 
	// echo '<p class="cat-text"><a href="'.esc_url(get_category_link($cat[0]->term_id)).'">'.$cat[0]->name.'</a></p>';
	echo '<h2><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h2>';?>
	
</div>
<?php endif; 

