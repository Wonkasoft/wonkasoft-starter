<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wonkasoft_Starter
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'No posts to display', 'wonkasoft-starter' ); ?></h1>
	</header><!-- .page-header -->
	<searchform class="search-form-container">
		<?php get_search_form(); ?>
	</searchform>
	<div class="page-content">
		<?php
		if ( is_home() || is_page( 'home' ) && current_user_can( 'publish_posts' ) ) :
			?>

			<p>
			<?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wonkasoft-starter' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?>
			</p>

		<?php

		else :
			?>

			<p><?php esc_html_e( 'Need to publish your first post to display.', 'wonkasoft-starter' ); ?></p>
			<?php

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
