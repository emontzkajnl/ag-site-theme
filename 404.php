<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ag_Sites
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found entry-content">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ag-sites' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
			<div class="wp-block-columns ag-site-sidebar-layout">
				<div class="wp-block-column on-page-search">
				<p><?php esc_html_e( 'Sorry, we can\'t find what you\'re looking for. Try searching below:', 'ag-sites' ); ?></p>
				<?php
					// the_content();
					get_search_form();
					?>
				</div>
				<div class="wp-block-column">
					<?php get_sidebar(); ?>
				</div>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
