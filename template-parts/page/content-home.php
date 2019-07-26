<?php
/**
 * Template part for displaying page content on front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wonkasoft_Starter
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="img-cta-wrap">
	<?php
	if ( has_post_thumbnail() ) :
		wonkasoft_starter_post_thumbnail();
	else :
		?>
		<div class="front-page-default-thumbnail">
			<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/business-3370832.jpg'; ?>" class="default-featured-image" />
		</div>
	<?php endif; ?>
	<?php
	if ( ! empty( get_theme_mod( 'cta_message' ) ) ) :
		?>
		<div class="cta-message">
			<header class="header-cta-message"><h4><?php echo esc_html__( get_theme_mod( 'cta_message' ) ); ?></h4>
			</header>
			<a href="<?php echo esc_attr__( get_theme_mod( 'home_page_cta_link' ) ); ?>" class="cta-action-btn btn btn-primary">Learn More</a>
		</div>
	<?php endif; ?>
	</div>
	<div class="entry-content">
		<div class="inner-loop">
			<?php
			$query = new WP_Query( array( 'post_type' => array( 'post' ) ) );
			if ( $query->have_posts() ) :
				?>

				<?php

				/* Start the Loop */
				while ( $query->have_posts() ) :
					$query->the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;
				wp_reset_postdata();
				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wonkasoft-starter' ),
						'after'  => '</div>',
					)
				);
				?>
		</div><!-- .inner-loop -->
	</div><!-- .entry-content -->
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit Page <span class="screen-reader-text">%s</span>', 'wonkasoft-starter' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
