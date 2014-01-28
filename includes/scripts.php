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
 * Registers and the Font Awesome stlyes for use in the Genesis Team Member Widget.
 *
 * @since 1.0.0
 * @global $wp_styles
 */
function gtmp_enqueue_styles() {
	$css_url = GTMP_PLUGIN_URL . 'assets/css/';
	// Enqueue styles
	wp_enqueue_style( 'gtmp-icon-fonts', $css_url . 'gtmp-icon-fonts.css', array(), GTMP_VERSION );
	wp_register_style( 'gtmp-styles', $css_url . 'gtmp-styles.css', array(), GTMP_VERSION );

	if ( ! wp_style_is( 'font-awesome', $list = 'enqueued' ) ) {
		wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
	}

}
