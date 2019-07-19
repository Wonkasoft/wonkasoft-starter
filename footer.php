<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wonkasoft_Starter
 */

$copyright = ( ! empty ( get_theme_mod( 'copyright_bar_message', false ) ) ) ? get_theme_mod( 'copyright_bar_message', false ): 'all rights reserved.';
?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<span class="copyright-text">
			<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( '%1s &copy; %2s', 'wonkasoft-starter' ), date("Y"), $copyright );
			?>
			</span>
			<span class="sep"> | </span>
			<span class="website-credit-text">
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Website by %s.', 'wonkasoft-starter' ), '<a href="https://wonkasoft.com">Wonkasoft</a>' );
			?>
			</span>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
