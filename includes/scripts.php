<?php
/**
 * Font-End Scripts
 *
 * @package     GTMP
 * @subpackage  Functions
 * @copyright   Copyright (c) 2014, Ozzy Rodriguez
 * @license     GPL-2.0+
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'gtmp_enqueue_styles' );
/**
 * Registers and the Font Awesome stlyes for use in the Awesome Featured Widget.
 *
 * @since 1.0.0
 * @global $wp_styles
 */
function gtmp_enqueue_styles() {
	$css_url = GTMP_PLUGIN_URL . 'assets/css/';
	// Register styles
	wp_register_style( 'gtmp-icon-fonts', $css_url . 'gtmp-icon-fonts.css', array(), GTMP_VERSION );
	wp_register_style( 'gtmp-styles', $css_url . 'gtmp-styles.css', array(), GTMP_VERSION );
}
