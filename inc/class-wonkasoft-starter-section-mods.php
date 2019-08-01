<?php
/**
 * This contains the class Wonkasoft_Starter_Section_Mods
 *
 * This class builds the mods for the sections on the front page.
 *
 * @package Wonkasoft_Starter
 * @since 1.0.0
 * @author Rudy Lister <rlister@wonkasoft.com>
 * auth
 */

defined( 'ABSPATH' ) || die();

/**
 * Class for constructing and sanitizing section mods.
 *
 * @since 1.0.0
 * @author Rudy Lister <rlister@wonkasoft.com>
 */
class Wonkasoft_Starter_Section_Mods {
	/**
	 * Will be a string of the section to process.
	 *
	 * @var string
	 */
	public $section = null;

	/**
	 * Will be passed if needing to echo the response.
	 *
	 * @var boolean
	 */
	public $e_response = false;

	/**
	 * Gets sections.
	 *
	 * @var int
	 */
	protected $sections = '';

	/**
	 * Gets sections quantity.
	 *
	 * @var int
	 */
	public $sections_qty = '';

	/**
	 * This is the constructor for getting the section mods.
	 *
	 * @param string  $section    Section to process.
	 * @param boolean $e_response Sets if needs to echo or return.
	 */
	public function __construct( $section = null, $e_response = false ) {
		$this->section = $section;
		$this->e_response = $e_response;
		$this->sections_qty = ( ! empty( get_theme_mod( 'section_qty' ) ) ) ? get_theme_mod( 'section_qty' ) : 0;
		$this->sections = new stdClass();
		self::get_sections();
	}

	/**
	 * This is the function that sanitizes the section mods.
	 *
	 * @return array          Send to front end.
	 */
	public function get_sections() {
		if ( 'front_page' === $this->section ) :
			if ( 0 < $this->sections_qty ) :
				for ( $i = 1; $i <= $this->sections_qty; $i++ ) {
					$this->sections->{"section_$i"} = self::get_mods( $i );
				}
				return $this->sections;
			endif;
		endif;

		return false;
	}

	/**
	 * The mods of the section.
	 *
	 * @param int $index contains the section index.
	 * @return int returns the object mods.
	 */
	private function get_mods( $index ) {
		$sec = new stdClass();
		$sec->img = get_theme_mod( 'home_page_section_bg_image_' . $index, '' );
		$sec->color = get_theme_mod( 'home_page_section_color_' . $index, '#ffffff' );
		$sec->page_id = get_theme_mod( 'home_page_section_' . $index, null );
		return $sec;
	}
}
