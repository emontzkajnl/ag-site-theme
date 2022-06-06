<?php
/**
 * The searchform.php template.
 *
 *
 * @link https://developer.wordpress.org/reference/functions/wp_unique_id/
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

    $agsite_unique_id = wp_unique_id( 'search-form-' );
 ?>

 <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' )); ?>">
     <label for="<?php echo esc_attr( $agsite_unique_id ); ?>"><?php _e('Search&hellip;','ag-sites') ?></label>
     <input type="search" placeholder="Search..." class="search-field" name="s" id="<?php echo esc_attr( $agsite_unique_id ); ?>">
     <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>