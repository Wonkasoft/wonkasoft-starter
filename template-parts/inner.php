<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wonkasoft_Starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h2 class="entry-title">', '</h2>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
		<div class="entry-meta">
			<?php
				wonkasoft_starter_posted_on();
				wonkasoft_starter_posted_by();
			?>
		</div><!-- .entry-meta -->
			<?php
		endif;
		?>
	</header><!-- .entry-header -->
	<a href="<?php echo esc_url( get_permalink() ); ?>">
	<?php
	if ( has_post_thumbnail() ) :
		wonkasoft_starter_post_thumbnail();
		?>
	<?php else : ?>
		<div class="post-thumbnail">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/chalk_board_image.jpeg' ); ?>" class="img-responsive wonkasoft-logo-cover" />
		</div>
	<?php endif; ?>
	</a>
	<div class="entry-content">
		<?php
			the_excerpt();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wonkasoft-starter' ),
					'after'  => '</div>',
				)
			);
			?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wonkasoft_starter_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

