<?php
/**
 * The template for displaying the Front-page
 *
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

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
			<?php
			// start loop
			while ( have_posts() ) : the_post();

				//Include the page content template
				get_template_part('template-parts/content', 'page');

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number()) {

					comments_template();
				}

				// End of the loop
			endwhile;
			?>

		</main><!-- .site-main-->
		

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>