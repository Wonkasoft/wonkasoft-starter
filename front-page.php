<?php
/**
 * The template for displaying the Front-page
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Wonkasoft_Starter
 * @author  Wonkasoft, LLC <support@wonkasoft.com>
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @since   1.0.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
<?php
	// Include the page content template.
	get_template_part( 'template-parts/page/content', 'home' );
?>

</main><!-- .site-main-->
<?php

$section_mods = new Wonkasoft_Starter_Section_Mods( 'front_page' );
$sections     = $section_mods->get_sections();
if ( 0 < $section_mods->sections_qty ) :
	for ( $i = 1; $i <= $section_mods->sections_qty; $i++ ) :
		$section   = $section_mods->get_sections()->{"section_$i"};
		$this_post = get_post( $section->page_id );
		$set_color = 'style=background:' . $section->color . '; ';
		$set_bg    = ( ! empty( $section->img ) ) ? 'style=background-image:url("' . $section->img . '"); ' : $set_color;
		$content   = apply_filters( 'the_content', $this_post->post_content, $this_post->post_content );
		?>
<section id="section-<?php echo esc_attr( $i ); ?>" class="front-page-section <?php echo esc_attr( $this_post->post_name ); ?>" <?php echo esc_attr( $set_bg ); ?>>

		<?php wonka_sanitize_post( $content, $page_id ); ?>
</section>
		<?php
	endfor;
endif;
	get_footer();

