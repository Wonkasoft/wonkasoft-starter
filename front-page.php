<?php
/**
 * The template for displaying the Front-page
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @since  1.0.0
 * @package Wonkasoft_Starter
 */
get_header(); ?>

	<main id="main" class="site-main" role="main">
					<?php
					// start loop
					while ( have_posts() ) :
						the_post();

						// Include the page content template
						get_template_part( 'template-parts/page/content', 'home' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {

							comments_template();
						}

						// End of the loop
					endwhile;
					?>

	</main><!-- .site-main-->
	<?php
	$get_qty_sections = ( ! empty( get_theme_mod( 'section_qty' ) ) ) ? get_theme_mod( 'section_qty' ) : 0;
	if ( $get_qty_sections > 0 ) :
		for ( $i = 1; $i <= $get_qty_sections; $i++ ) :
			$page_id = ( ! empty( get_theme_mod( 'home_page_section_' . $i ) ) ) ? get_theme_mod( 'home_page_section_' . $i ) : null;
			if ( ! empty( $page_id ) ) :
				$this_post = get_post( $page_id );
				$bg_color = ( ! empty( get_theme_mod( 'home_page_section_color_' . $i ) ) ) ? 'style="background:' . get_theme_mod( 'home_page_section_color_' . $i ) . ';" ' : '';
				?>
				<section id="section-<?php echo $i; ?>" class="front-page-section <?php echo $this_post->post_name; ?>"<?php echo $bg_color; ?>>
					<?php
						do_blocks( $this_post->post_content );
					?>
				</section>
				<?php
			endif;
		endfor;
	endif;

	get_footer();
