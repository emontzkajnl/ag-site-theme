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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header sidebar-padding">
		<?php
		// if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		// else :
			// the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		// endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				$categories = get_the_terms( get_the_ID(  ), 'category' );
				if ($categories) : ?>
					<div class="category-wrap">
						<ul>
							<?php foreach ($categories as $category): ?>
								<li><a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					
				<?php endif;
				

				
				ag_sites_posted_by();
				echo ' | ';
				ag_sites_posted_on();
				if (function_exists( 'ADDTOANY_SHARE_SAVE_KIT' )) {
					echo do_shortcode('[addtoany url="' . esc_url(get_the_permalink(get_the_ID())).'" ]');
				}
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<!-- <div class="sidebar-padding"> -->
	<?php //ag_sites_post_thumbnail(); ?>
	<!-- </div>								 -->
	
	<div class="ag-site-sidebar-layout wp-block-columns">
	<div class="entry-content wp-block-column">
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
		?>
	</div><!-- .entry-content -->
	<div class="wp-block-column">

	</div>
	</div>

	<footer class="entry-footer">
		<?php ag_sites_entry_footer(); ?>
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
	echo '<p class="cat-text"><a href="'.esc_url(get_category_link($cat[0]->term_id)).'">'.$cat[0]->name.'</a></p>';
	echo '<a href="'.esc_url( get_permalink() ).'"><h2>'.get_the_title().'</h2></a>';?>
	
</div>
<?php endif; 

