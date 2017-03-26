<?php
/**
 * Understrap Theme Customizer
 *
 * @package understrap
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'understrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function understrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'understrap_customize_register' );

if ( ! function_exists( 'understrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function understrap_theme_customize_register( $wp_customize ) {

		// Theme header settings.
		$wp_customize->add_section( 'understrap_theme_header_options', array(
			'title'       => __( 'Theme Header Settings', 'understrap' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Choose your header layout option', 'understrap' ),
			'priority'    => 120,
		) );

		$wp_customize->add_setting('understrap_header_layout', array(
		    'default'        => 'header-inline',
		    'type'           => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
		    'capability'     => 'edit_theme_options',
		));
		 
		$wp_customize->add_control('understrap_theme_header_options', array(
		    'label'      => __('Header layout', 'understrap'),
		    'section'    => 'understrap_theme_header_options',
		    'settings'   => 'understrap_header_layout',
		    'type'       => 'radio',
		    'choices'    => array(
		    	'header-inline' => 'Inline Header',
		        'header-classic' => 'Classic Header',
		        'header-split' => 'Split Header',
		    ),
		));

		//Theme top bar setting
		$wp_customize->add_setting('understrap_topbar_status', array(
		    'default'        => 'topbar-enable',
		    'type'           => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
		    'capability'     => 'edit_theme_options',
		));

		$wp_customize->add_control('understrap_theme_topbar_options', array(
		    'label'      => __('Top Bar Status', 'understrap'),
		    'section'    => 'understrap_theme_header_options',
		    'settings'   => 'understrap_topbar_status',
		    'type'       => 'radio',
		    'choices'    => array(
		    	'topbar-enable' => 'Enable',
		        'topbar-disable' => 'Disable'
		    ),
		));

		//Theme Page Header Title setting
		$wp_customize->add_setting('understrap_page_header_title_setting', array(
		    'default'        => 'page-header-title-enable',
		    'type'           => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
		    'capability'     => 'edit_theme_options',
		));

		$wp_customize->add_control('understrap_theme_page_header_options', array(
		    'label'      => __('Page Header Title Visibility', 'understrap'),
		    'section'    => 'understrap_theme_header_options',
		    'settings'   => 'understrap_page_header_title_setting',
		    'type'       => 'radio',
		    'choices'    => array(
		    	'page-header-title-enable' => 'Show',
		        'page-header-title-disable' => 'Hide'
		    ),
		));

		// Theme layout settings.
		$wp_customize->add_section( 'understrap_theme_layout_options', array(
			'title'       => __( 'Theme Layout Settings', 'understrap' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Container width and sidebar defaults', 'understrap' ),
			'priority'    => 160,
		) );

		$wp_customize->add_setting( 'understrap_container_type', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'container_type', array(
					'label'       => __( 'Container Width', 'understrap' ),
					'description' => __( "Choose between Bootstrap's container and container-fluid", 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'understrap' ),
						'container-fluid' => __( 'Full width container', 'understrap' ),
					),
					'priority'    => '10',
				)
			) );

		$wp_customize->add_setting( 'understrap_sidebar_position', array(
			'default'           => 'right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_sidebar_position', array(
					'label'       => __( 'Sidebar Positioning', 'understrap' ),
					'description' => __( "Set sidebar's default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.",
					'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_sidebar_position',
					'type'        => 'select',
					'choices'     => array(
						'right' => __( 'Right sidebar', 'understrap' ),
						'left'  => __( 'Left sidebar', 'understrap' ),
						'both'  => __( 'Left & Right sidebars', 'understrap' ),
						'none'  => __( 'No sidebar', 'understrap' ),
					),
					'priority'    => '20',
				)
			) );
	}
} // endif function_exists( 'understrap_theme_customize_register' ).
add_action( 'customize_register', 'understrap_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'understrap_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function understrap_customize_preview_js() {
		wp_enqueue_script( 'understrap_customizer', get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ), '20130508', true );
	}
}
add_action( 'customize_preview_init', 'understrap_customize_preview_js' );
