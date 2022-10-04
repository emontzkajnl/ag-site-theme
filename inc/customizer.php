<?php
/**
 * Ag Sites Theme Customizer
 *
 * @package Ag_Sites
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

// function sanitize_hex_color( $color ) {
// 	if ( '' === $color ) {
// 		return '';
// 	}
 
// 	// 3 or 6 hex digits, or the empty string.
// 	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
// 		return $color;
// 	}
// }

function ag_sites_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->add_setting( 'primary_color_display',  array(
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'default'		=> '#333333',
		'transport' 	=> 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_setting( 'secondary_color_display',  array(
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'default'		=> '#333333',
		'transport' 	=> 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_setting( 'footer_background_display',  array(
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'default'		=> '#333333',
		'transport' 	=> 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
		'label' => __( 'Primary Color', 'ag-sites'), 
		'section' => 'colors',
		'settings'		=> 'primary_color_display'
	)));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
		'label' => __( 'Secondary Color', 'ag-sites'), 
		'section' => 'colors',
		'settings'		=> 'secondary_color_display'
	)));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background', array(
		'label' => __( 'Footer Background', 'ag-sites'), 
		'section' => 'colors',
		'settings'		=> 'footer_background_display'
	)));

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'ag_sites_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'ag_sites_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'ag_sites_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ag_sites_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ag_sites_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ag_sites_customize_preview_js() {
	wp_enqueue_script( 'ag-sites-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _ag_site_theme_VERSION, true );
}
add_action( 'customize_preview_init', 'ag_sites_customize_preview_js' );

function ag_sites_customize_css() { 
	$secondary_color = get_option('secondary_color_display');
	$primary_color = get_option('primary_color_display');
	$footer_background = get_option('footer_background_display'); ?>
<style type="text/css">
	/**
	* customizer.php 
	*/
	a, a:visited {
		color: <?php echo $primary_color; ?>;
	}
	#newsletter input[type="submit"] {
		background-color: <?php echo $primary_color; ?>;
	}
	.color__primary {
		color: <?php echo $primary_color; ?>;
	}
	.color__secondary {
		color: <?php echo $secondary_color; ?>;
	}
	.background__primary {
		background-color: <?php echo $primary_color; ?>;
	}
	.background__secondary {
		background-color: <?php echo $secondary_color; ?>;
	}

	.site-footer {
		background-color: <?php echo $footer_background; ?>;
	}
</style>
<?php }

add_action( 'wp_head', 'ag_sites_customize_css' );
