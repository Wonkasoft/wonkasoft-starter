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
	  'topbar_message_section',
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
		'section'     => 'topbar_message_section',
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
		'section'     => 'topbar_message_section',
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
		'section'     => 'topbar_message_section',
		'settings'    => 'topbar_message',
		'type'        => 'text',
		'description' => 'Topbar message',
	) ) );

	/**
	* Setting Front page sections
	*
	* @since  1.0.0
	*/
	$wp_customize->add_section(
	  'front_page_sections',
	  array(
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'priority'       => 100,
		'title'          => __( 'Select front page sections', 'Wonkasoft_Starter' ),
		'description'    => __( 'This Panel lets you setup sections on the home page', 'Wonkasoft_Starter' ),
		'panel'          => 'wonkasoft_theme_options',
		)
	);

	/**
	* Setting the number of sections on home page
	* @since  1.0.0
	*/
	$wp_customize->add_setting( 'section_qty' , array(
	  'default'           => '1',
	  'transport'         => 'refresh',
	) );

	// Topbar color Setting Control
	$wp_customize->add_control( new WP_Customize_Control( 
	  $wp_customize, 
	  'section_qty_control', 
	  array(
		'label'       => __( 'Qty of sections', 'Wonkasoft_Starter' ),
		'section'     => 'front_page_sections',
		'settings'    => 'section_qty',
		'type'        => 'number',
		'description' => 'Set the amount of sections for the home page',
	) ) );

	$section_qty = ( ! empty ( get_theme_mod( 'section_qty' ) ) ) ? get_theme_mod( 'section_qty' ): 1;
	/**
	* Looping for amount of sections
	* @since  1.0.0
	*/
	if ( $section_qty > 0 ) : 
		
		for ($i=1; $i <= $section_qty; $i++) { 
			$wp_customize->add_setting( 'home_page_section_color_' . $i , array(
			  'default'           	=> '#fff',
			  'transport'         	=> 'refresh',
			) );
			
			// home_page_section_ Setting Control
			$wp_customize->add_control( new WP_Customize_Control( 
			  $wp_customize, 
			  'home_page_section_color_control' . $i, 
			  array(
				'label'       		=> __( 'Section Color ' . $i, 'Wonkasoft_Starter' ),
				'section'     		=> 'front_page_sections',
				'settings'    		=> 'home_page_section_color_' . $i,
				'type'        		=> 'color',
				'description' 		=> 'Select background color for this section',
			) ) );

			$wp_customize->add_setting( 'home_page_section_bg_image_' . $i , array(
			  'default'           	=> '',
			  'transport'         	=> 'refresh',
			) );
			
			// home_page_section_ Setting Control
			$wp_customize->add_control( new WP_Customize_Media_Control( 
			  $wp_customize, 
			  'home_page_section_bg_image_control' . $i, 
			  array(
				'label'       		=> __( 'Section Background Image ' . $i, 'Wonkasoft_Starter' ),
				'section'     		=> 'front_page_sections',
				'settings'    		=> 'home_page_section_bg_image_' . $i,
				'type'        		=> 'image',
				'description' 		=> 'Select background image for this section',
			) ) );

			$wp_customize->add_setting( 'home_page_section_' . $i , array(
			  'default'           	=> '0',
			  'transport'         	=> 'refresh',
			) );

			// home_page_section_ Setting Control
			$wp_customize->add_control( new WP_Customize_Control( 
			  $wp_customize, 
			  'home_page_section_control' . $i, 
			  array(
				'label'       		=> __( 'Section ' . $i, 'Wonkasoft_Starter' ),
				'section'     		=> 'front_page_sections',
				'settings'    		=> 'home_page_section_' . $i,
				'type'        		=> 'dropdown-pages',
				'allow_addition'	=> true,
				'description' 		=> 'Select page to parse page content in this section',
			) ) );
		}
	endif;

	/**
	* Website Copyright Info Section
	*
	* @since  1.0.0
	*/
	$wp_customize->add_section(
	  'website_copyright_info',
	  array(
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'priority'       => 100,
		'title'          => __( 'Website Copyright Info', 'Wonkasoft_Starter' ),
		'description'    => __( 'Copyright Info', 'Wonkasoft_Starter' ),
		'panel'          => 'wonkasoft_theme_options',
		)
	);
	
	/**
	* Website Copyright Info Section
	* @since  1.0.0
	*/
	$wp_customize->add_setting( 'copyright_bar_color' , array(
	  'default'           => '',
	  'transport'         => 'refresh',
	) );

	// Topbar color Setting Control
	$wp_customize->add_control( new WP_Customize_Control( 
	  $wp_customize, 
	  'copyright_bar_color_control', 
	  array(
		'label'       => __( 'Copyright Bar Color Option', 'Wonkasoft_Starter' ),
		'section'     => 'website_copyright_info',
		'settings'    => 'copyright_bar_color',
		'type'        => 'color',
		'description' => 'Copyright bar color',
	) ) );

	/**
	* Website Copyright Info Section
	* @since  1.0.0
	*/
	$wp_customize->add_setting( 'copyright_bar_message' , array(
	  'default'           => '',
	  'transport'         => 'refresh',
	) );

	// Topbar color Setting Control
	$wp_customize->add_control( new WP_Customize_Control( 
	  $wp_customize, 
	  'copyright_bar_message_control', 
	  array(
		'label'       => __( 'Copyright Bar Message Option', 'Wonkasoft_Starter' ),
		'section'     => 'website_copyright_info',
		'settings'    => 'copyright_bar_message',
		'type'        => 'text',
		'description' => 'Copyright Bar message',
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
