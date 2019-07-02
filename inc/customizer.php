<?php
/**
 * Wonkasoft Starter Theme Customizer
 *
 * @package Wonkasoft_Starter
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wonkasoft_starter_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'wonkasoft_starter_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'wonkasoft_starter_customize_partial_blogdescription',
		) );
	}

	/*=====================================================
	=            Themes options for customizer            =
	=====================================================*/
	/**
	* Theme options panel
	*
	* @since 1.0.0
	*/
	$wp_customize->add_panel(
	  'wonkasoft_theme_options',
	  array(
		'priority'        => 5,
		'capability'      => 'edit_theme_options',
		'theme_supports'  => '',
		'title'           => __( 'Wonkasoft Starter Homepage Options', 'Wonkasoft_Starter' ),
		'description'     => __( 'Theme Settings', 'Wonkasoft_Starter' ),
	)
	);

	/**
	* Top bar message settings Section
	*
	* @since  1.0.0
	*/
	$wp_customize->add_section(
	  'topbar_messgae_section',
	  array(
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'priority'       => 10,
		'title'          => __( 'Topbar Message Section', 'Wonkasoft_Starter' ),
		'description'    => __( 'Topbar Options version 1.0.0', 'Wonkasoft_Starter' ),
		'panel'          => 'wonkasoft_theme_options',
	)
	);

	/**
	* Enable topbar message settings Section
	*
	* @since  1.0.0
	*/
	$wp_customize->add_setting(
	  'enable_topbar',
	  array(
		'default'   => '',
		'transport' => 'refresh',
	)
	);

	// Enable topbar message Setting Control
	$wp_customize->add_control( new WP_Customize_Control( 
	  $wp_customize, 
	  'enable_topbar_control', 
	  array(
		'label'       => __( 'Topbar Message Option', 'Wonkasoft_Starter' ),
		'section'     => 'topbar_messgae_section',
		'settings'    => 'enable_topbar',
		'type'        => 'checkbox',
		'description' => 'Enable Topbar',
	) ) );
	
	
	/**
	* Topbar color settings Section
	* @since  1.0.0
	*/
	$wp_customize->add_setting( 'topbar_color' , array(
	  'default'           => '',
	  'transport'         => 'refresh',
	) );

	// Topbar color Setting Control
	$wp_customize->add_control( new WP_Customize_Control( 
	  $wp_customize, 
	  'topbar_color_control', 
	  array(
		'label'       => __( 'Topbar Color Option', 'Wonkasoft_Starter' ),
		'section'     => 'topbar_messgae_section',
		'settings'    => 'topbar_color',
		'type'        => 'color',
		'description' => 'Topbar color',
	) ) );

	/**
	* Topbar message settings Section
	* @since  1.0.0
	*/
	$wp_customize->add_setting( 'topbar_message' , array(
	  'default'           => '',
	  'transport'         => 'refresh',
	) );

	// Topbar color Setting Control
	$wp_customize->add_control( new WP_Customize_Control( 
	  $wp_customize, 
	  'topbar_message_control', 
	  array(
		'label'       => __( 'Topbar Message Option', 'Wonkasoft_Starter' ),
		'section'     => 'topbar_messgae_section',
		'settings'    => 'topbar_message',
		'type'        => 'text',
		'description' => 'Topbar message',
	) ) );
	/*=====  End of Themes options for customizer  ======*/
	
}
add_action( 'customize_register', 'wonkasoft_starter_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wonkasoft_starter_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wonkasoft_starter_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wonkasoft_starter_customize_preview_js() {
	wp_enqueue_script( 'wonkasoft-starter-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wonkasoft_starter_customize_preview_js' );
