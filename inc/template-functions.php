<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Wonkasoft_Starter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wonkasoft_starter_body_classes( $classes ) {
	if ( is_home() || is_front_page() ) {
		$classes[] = 'wonkasoft-theme-home';
	}

	if ( is_singular() && ! is_home() && ! is_front_page() ) {
		$classes[] = 'wonkasoft-theme-single';
	}

	if ( is_archive() ) {
		$classes[] = 'wonkasoft-theme-archive';
	}

	return $classes;
}
add_filter( 'body_class', 'wonkasoft_starter_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function wonkasoft_starter_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'wonkasoft_starter_pingback_header' );

/**
 * Adding bootstrap classes to the form elements
 *
 * @param array $form         contains the form elements to work with.
 * @param array $ajax         unknown.
 * @param array $field_values this is an array of the field values.
 */
function add_bootstrap_container_class( $form, $ajax, $field_values ) {
	$inline_forms = array( 'News Sign up' );
	$field_validators_class = '';

	if ( in_array( $form['title'], $inline_forms ) ) :
		$form['cssClass'] .= 'inline-form wonka-newsletter-form';
	endif;

	if ( in_array( $form['title'], array( 'Contact' ) ) ) :
		$form['cssClass'] .= 'inline-form wonka-contact-form';
	endif;

	foreach ( $form['fields'] as $field ) :
		if ( strpos( $field['cssClass'], 'gform_validation_container' ) === false ) :
			if ( ! empty( $field['cssClass'] ) ) :
				$field['cssClass'] .= ' form-group wonka-form-group';
			else :
				$field['cssClass'] = 'form-group wonka-form-group';
			endif;
			if ( ! empty( $field['size'] ) ) :
				$field['size'] .= ' form-control wonka-form-control';
			else :
				$field['size'] = 'form-control wonka-form-control';
			endif;

			if ( empty( $field['placeholder'] ) ) :
				$field['placeholder'] = $field['label'];
			endif;
		endif;
	endforeach;

	return $form;
}
add_filter( 'gform_pre_render', 'add_bootstrap_container_class', 10, 3 );

/**
 * Adding classes to gform buttons
 *
 * @param  object $button contains the html of the button.
 * @param  object $form   contains the html of the form.
 * @return string         returns the classes that are set for the button.
 */
function wonka_add_classes_to_button( $button, $form ) {
	$dom = new DOMDocument();
	$dom->loadHTML( $button );
	$input = $dom->getElementsByTagName( 'input' )->item( 0 );
	$classes = $input->getAttribute( 'class' );
	$classes = 'wonka-btn btn btn-primary';
	$input->setAttribute( 'class', $classes );

	return $dom->saveHtml( $input );
}
add_filter( 'gform_submit_button', 'wonka_add_classes_to_button', 10, 2 );

/**
 * This is to sanitize the content
 *
 * @param  string $content contains the content of the post.
 * @param  string $post_id contains the content of the post.
 * @return string          returns the content of the post.
 */
function wonka_sanitize_post( $content, $post_id ) {

	echo $content;
}
