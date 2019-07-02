<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Wonkasoft_Starter
 */
?>
  <form method="get" id="searchform" class="wonka-form-inline form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  	<div class="input-group">
    <label for="s" class="assistive-text sr-only"><?php _e( 'Search', 'apera' ); ?></label>
    <input type="text" class="field wonka-form-control" name="s" id="s" placeholder="<?php esc_attr_e( 'Enter your search...', 'apera' ); ?>" />
    <button type="submit" class="submit wonka-btn" name="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
	</div>
  </form>