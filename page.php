<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wonkasoft_Starter
 */

global $wp_query;
$pagename_class = ! empty( $wp_query->queried_object->post_name ) ? ' main-' . $wp_query->queried_object->post_name : '';
get_header(); ?>
	
	<main id="main" class="site-main<?php echo esc_attr( $pagename_class ); ?>">
		
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

	</main><!-- #main -->

<?php
get_footer();
