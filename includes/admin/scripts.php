<?php
/**
 * Admin Scripts
 *
 * @package     GTMP
 * @copyright   Copyright (c) 2014, Ozzy Rodriguez
 * @license     GPL-2.0+
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_enqueue_scripts', 'gtmp_admin_enqueue_styles' );
/**
 * Load admin stylesheets
 *
 * @since 1.0.0
 * @global $afcw_settings_page
 */
function gtmp_admin_enqueue_styles( $hook ) {
	$css_uri = GTMP_PLUGIN_URL . 'assets/css/';

	wp_enqueue_style( 'gtmp-admin', $css_uri . 'admin.css', array(), GTMP_VERSION );
}