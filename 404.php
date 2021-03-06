<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Wonkasoft_Starter
 */

get_header(); ?>

		<main id="main" class="site-main-error-404">

			<header class="entry-header">
			<?php
			if ( has_post_thumbnail() ) :
				wonkasoft_starter_post_thumbnail();
				?>
			<?php else : ?>
				<div class="post-thumbnail">
					<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/chalk_board_image.jpeg'; ?>" class="img-responsive wonkasoft-logo-cover" />
				</div>
			<?php endif; ?>
			
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<hr />
			</header><!-- .entry-header -->

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wonkasoft-starter' ); ?></h1>
				</header><!-- .page-header -->
				<searchform class="search-form-container">
					<?php get_search_form(); ?>
				</searchform>
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wonkasoft-starter' ); ?></p>

					<?php

						the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'wonkasoft-starter' ); ?></h2>
						<ul>
						<?php
							wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							);
							?>
						</ul>
					</div><!-- .widget -->

					<?php

						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'wonkasoft-starter' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->

<?php
get_footer();
