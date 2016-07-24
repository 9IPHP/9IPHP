<?php

/**
 * The Disable Google Fonts Plugin
 *
 * Disable enqueuing of Open Sans and other fonts used by WordPress from Google.
 *
 * @package Disable_Google_Fonts
 * @subpackage Main
 */

/**
 * Plugin Name: Disable Google Fonts
 * Plugin URI:  http://blog.milandinic.com/wordpress/plugins/disable-google-fonts/
 * Description: Disable enqueuing of Open Sans and other fonts used by WordPress from Google.
 * Author:      Milan Dinić
 * Author URI:  http://blog.milandinic.com/
 * Version:     1.0
 * License:     GPL
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

class Wp_Disable_Google_Font {
	/**
	 * Hook actions and filters.
	 * 
	 * @since 1.0
	 * @access public
	 */
	public function __construct() {
		add_filter( 'gettext_with_context', array( $this, 'disable_open_sans'             ), 888, 4 );
		add_action( 'after_setup_theme',    array( $this, 'register_theme_fonts_disabler' ), 1      );
	}

	/**
	 * Force 'off' as a result of Open Sans font toggler string translation.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param  string $translations Translated text.
	 * @param  string $text         Text to translate.
	 * @param  string $context      Context information for the translators.
	 * @param  string $domain       Text domain. Unique identifier for retrieving translated strings.
	 * @return string $translations Translated text.
	 */
	public function disable_open_sans( $translations, $text, $context, $domain ) {
		if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
			$translations = 'off';
		}

		return $translations;
	}

	/**
	 * Force 'off' as a result of Lato font toggler string translation.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param  string $translations Translated text.
	 * @param  string $text         Text to translate.
	 * @param  string $context      Context information for the translators.
	 * @param  string $domain       Text domain. Unique identifier for retrieving translated strings.
	 * @return string $translations Translated text.
	 */
	public function disable_lato( $translations, $text, $context, $domain ) {
		if ( 'Lato font: on or off' == $context && 'on' == $text ) {
			$translations = 'off';
		}

		return $translations;
	}

	/**
	 * Force 'off' as a result of Source Sans Pro font toggler string translation.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param  string $translations Translated text.
	 * @param  string $text         Text to translate.
	 * @param  string $context      Context information for the translators.
	 * @param  string $domain       Text domain. Unique identifier for retrieving translated strings.
	 * @return string $translations Translated text.
	 */
	public function disable_source_sans_pro( $translations, $text, $context, $domain ) {
		if ( 'Source Sans Pro font: on or off' == $context && 'on' == $text ) {
			$translations = 'off';
		}

		return $translations;
	}

	/**
	 * Force 'off' as a result of Bitter font toggler string translation.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param  string $translations Translated text.
	 * @param  string $text         Text to translate.
	 * @param  string $context      Context information for the translators.
	 * @param  string $domain       Text domain. Unique identifier for retrieving translated strings.
	 * @return string $translations Translated text.
	 */
	public function disable_bitter( $translations, $text, $context, $domain ) {
		if ( 'Bitter font: on or off' == $context && 'on' == $text ) {
			$translations = 'off';
		}

		return $translations;
	}

	/**
	 * Register filters that disable fonts for bundled themes.
	 *
	 * This filters can be directly hooked as Disable_Google_Fonts::disable_open_sans()
	 * but that would mean that comparison is done on each string
	 * for each font which creates performance issues.
	 *
	 * Instead we check active template's name very late and just once
	 * and hook appropriate filters.
	 *
	 * Note that Open Sans disabler is used for both WordPress core
	 * and for Twenty Twelve theme.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @uses get_template() To get name of the active parent theme.
	 * @uses add_filter()   To hook theme specific fonts disablers.
	 */
	public function register_theme_fonts_disabler() {
		$template = get_template();

		switch ( $template ) {
			case 'twentyfourteen' :
				add_filter( 'gettext_with_context', array( $this, 'disable_lato'            ), 888, 4 );
				break;
			case 'twentythirteen' :
				add_filter( 'gettext_with_context', array( $this, 'disable_source_sans_pro' ), 888, 4 );
				add_filter( 'gettext_with_context', array( $this, 'disable_bitter'          ), 888, 4 );
				break;
		}
	}
}

/* Although it would be preferred to do this on hook,
 * load early to make sure Open Sans is removed
 */
$disable_google_fonts = new Wp_Disable_Google_Font;