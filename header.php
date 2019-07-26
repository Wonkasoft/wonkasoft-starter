<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wonkasoft_Starter
 */

$enable_top_msg = ( ! empty( get_theme_mod( 'enable_topbar' ) ) ) ? true : false;
$top_message = ( ! empty( get_theme_mod( 'topbar_message', false ) ) ) ? get_theme_mod( 'topbar_message', false ) : '';

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wonkasoft-starter' ); ?></a>

	<header id="masthead" class="site-header">
		<?php if ( ! empty( $enable_top_msg ) ) : ?>
			<div class="contact-number">
				<span class="contact-number-text"><?php echo $top_message; ?></span>
			</div><!-- .contact-number -->
		<?php endif; ?>

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="hang-a-bur hang-a-bur-top"></span>
				<span class="hang-a-bur hang-a-bur-mid"></span>
				<span class="hang-a-bur hang-a-bur-bottom"></span>
			</button>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container_id'   => 'top-main',
					)
				);
				?>
		</nav><!-- #site-navigation -->
		<?php
		if ( has_custom_logo() ) :
			?>
		
		<div class="site-branding-with-logo">
				<div class="custom-logo"><?php the_custom_logo(); ?></div>
			<?php
			if ( is_front_page() && is_home() ) :
				?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1><?php bloginfo( 'name' ); ?></h1></a></div>
					<?php
				endif;
		else :
			?>
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1><?php bloginfo( 'name' ); ?></h1></a></div>
					<?php
				endif;
		endif;

			$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) :
			?>
				<div class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></div>
			<?php
			endif;
		?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->
