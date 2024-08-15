<?php
/**
 * Ag Sites functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ag_Sites
 */

if ( ! defined( '_ag_site_theme_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_ag_site_theme_VERSION', '1.1');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ag_sites_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Ag Sites, use a find and replace
		* to change 'ag-sites' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ag-sites', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	register_nav_menus(
		array(
			'primary'   => __( 'Top primary menu', 'ag-sites' ),
			'top_bar'   => __( 'Top bar menu', 'ag-sites' ),
			'top_bar_22'   => __( 'Top bar menu 2022', 'ag-sites' ),
			'bottom_menu'   => __( 'Bottom menu', 'ag-sites' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ag_sites_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );



	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'ag_sites_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ag_sites_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ag_sites_content_width', 640 );
}
add_action( 'after_setup_theme', 'ag_sites_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ag_sites_widgets_init() {
	$before_widget = NULL;
	$after_widget = NULL;

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ag-sites' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ag-sites' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(array(
	'name' => __( 'Category Sidebar' ),
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'id'			=> 'category-sidebar',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
	));
}
add_action( 'widgets_init', 'ag_sites_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ag_sites_scripts() {
	wp_enqueue_style( 'ag-sites-style', get_stylesheet_uri(), array(), _ag_site_theme_VERSION );
	wp_style_add_data( 'ag-sites-style', 'rtl', 'replace' );
	wp_enqueue_script( 'headroom', get_template_directory_uri() . '/js/headroom.js', array(), _ag_site_theme_VERSION , true );
	wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array(), _ag_site_theme_VERSION , true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery', 'headroom','waypoint'), _ag_site_theme_VERSION , true );
	wp_enqueue_script( 'ag-sites-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _ag_site_theme_VERSION, true );
	wp_localize_script( 'main', 'params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'currentpage'	=> '',
		'currentRecentPage'	=> 1,
		'currentPopularPage'	=> 1
	) );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ag_sites_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Contact Info',
		'menu_title'	=> 'Contact Info',
		'menu_slug'		=> 'contact-info',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_page(array(
		'page_title' 	=> 'Footer',
		'menu_title'	=> 'Footer',
		'menu_slug'		=> 'footer',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

/**
 * Offset magazine archive page and stop pagination
 */
function mag_offset($query) {
	if (is_post_type_archive('magazine') && is_main_query()) {
		// $query->set('offset', 1);
		$query->set('nopaging', 1);
	}
}

add_action('parse_query', 'mag_offset');



function load_more_cats() {
	// error_log(var_dump($_POST, true));
	$args = array(
		'post_type'			=> 'post',
		// 'cat'				=> $_POST['cat'],
		'posts_per_page'	=> 10,
		'post_status'       => 'publish',
		'paged'				=> $_POST['page']
	);
	if ($_POST['cat']) {
		$args['cat'] = $_POST['cat'];
	} else { // this is a tag page
		$args['tag'] = $_POST['tag'];
	}
	$cat_query = new WP_Query($args);
	// var_dump(print_r($cat_query, true));
	if($cat_query->have_posts()): 
		// echo '<h2>max pages is '.$cat_query->max_num_pages.'</h2>';
		echo '<div class="row">';
		while($cat_query->have_posts()): $cat_query->the_post(); ?>
		<div class="col-12 m-col-12 l-col-6 custom-article-list">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
		<div class="two-thirds-container">
		<?php ag_sites_post_thumbnail(get_the_ID(), 'stm-gm-635-345'); ?>
		</div></a>
		
		<?php 
		//echo '<p class="cat-text"><a href="'.esc_url(get_category_link($cat[0]->term_id)).'">'.$cat[0]->name.'</a></p>';
		echo '<h2><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h2>';?>
		
	</div>
		<?php endwhile;
		echo '</div>'; // .row
	endif;
	wp_reset_postdata(  );
	// wp_reset_query();
	wp_die( );
}
add_action('wp_ajax_loadMoreCats', 'load_more_cats');
add_action('wp_ajax_nopriv_loadMoreCats', 'load_more_cats');

function load_more_search() {
	// error_log(var_dump($_POST, true));
	$args = array(
		'post_type'			=> 'post',
		's'				=> $_POST['search'],
		'posts_per_page'	=> 10,
		'post_status'       => 'publish',
		'paged'				=> $_POST['page']
	);
	query_posts($args);
	if(have_posts()): 
		echo '<div class="row">';
		while(have_posts()): the_post(); ?>
		<div class="col-12 m-col-12 l-col-6 custom-article-list">
		<a href="<?php echo esc_url( get_permalink() ); ?>">
		<div class="two-thirds-container">
		<?php ag_sites_post_thumbnail(get_the_ID(), 'stm-gm-635-345'); ?>
		</div></a>
		
		<?php 
		//echo '<p class="cat-text"><a href="'.esc_url(get_category_link($cat[0]->term_id)).'">'.$cat[0]->name.'</a></p>';
		echo '<h2><a class="title-link" href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h2>';?>
		
	</div>
		<?php endwhile;
	endif;
	echo '</div>'; // .row
	wp_reset_query();
	wp_die(  );
}
add_action('wp_ajax_loadMoreSearch', 'load_more_search');
add_action('wp_ajax_nopriv_loadMoreSearch', 'load_more_search');

add_filter( 'redirection_role', function( $role ) {
	return 'edit_posts';  // Add your chosen capability or role here
	} );
