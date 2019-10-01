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
		wonkasoft_front_starter_post_thumbnail();
	else :
		?>
		<div class="front-page-default-thumbnail">
			<div class="circles-wrap">
				<div class="first-circle"></div>
				<div class="second-circle"></div>
				<div class="third-outline-circle"></div>
				<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/business-3370832.jpg' ); ?>" class="default-featured-image" />
			</div>
		</div>
	<?php endif; ?>
	<?php
	if ( ! empty( get_theme_mod( 'cta_message' ) ) ) :
		$cta_title    = ( ! empty( get_theme_mod( 'cta_message' ) ) ) ? get_theme_mod( 'cta_message' ) : '';
		$cta_link     = ( ! empty( get_theme_mod( 'cta_link' ) ) ) ? get_permalink( get_theme_mod( 'cta_link' ) ) : '';
		$cta_btn_text = ( ! empty( get_theme_mod( 'cta_btn_text' ) ) ) ? get_theme_mod( 'cta_btn_text' ) : '';
		?>
		<div class="cta-message">
			<header class="header-cta-message"><h4><?php echo wp_kses_post( $cta_title ); ?></h4>
			</header>
			<a href="<?php echo esc_url( $cta_link ); ?>" class="wonka-btn btn btn-primary"><?php echo wp_kses_post( $cta_btn_text ); ?></a>
		</div>
	<?php endif; ?>
	</div>
	<div class="entry-content">
		<div class="inner-loop">
			<?php
			$query = new WP_Query(
				array(
					'post_type'     => array( 'page' ),
					'post_per_page' => 3,
				)
			);
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
					get_template_part( 'template-parts/inner', get_post_format() );

				endwhile;
				wp_reset_postdata();
				the_posts_navigation();

				else :

					get_template_part( 'template-parts/inner', 'none' );

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
