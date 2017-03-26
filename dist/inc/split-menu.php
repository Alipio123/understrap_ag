<?php
/**
 * Understrap Theme Menu Setting
 *
 * @package understrap
 */

$header_layout = get_theme_mod( 'understrap_header_layout' );

if( $header_layout == "header-split" ){
	add_action( 'admin_menu', 'understrap_split_menus' );
}

if ( ! function_exists( 'understrap_split_menus' ) ) {

	function understrap_split_menus() {
	  register_nav_menus(
	    array(
	      'understrap-left-menu' => __( 'Split Menu: Left', 'understrap' ),
	      'understrap-right-menu' => __( 'Split Menu: Right', 'understrap' ),
	      'understrap-mobile-menu' => __( 'Mobile Menu', 'understrap' )
	    )
	  );
	}
	add_action( 'init', 'understrap_split_menus' );

} // endif function_exists( 'understrap_split_menus' ).