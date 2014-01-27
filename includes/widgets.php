<?php
/**
 * Font-End Widgets
 *
 * @package     GTMP
 * @subpackage  Widgets
 * @copyright   Copyright (c) 2014, Ozzy Rodriguez
 * @license     GPL-2.0+
 * @since       1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'widgets_init', 'gtmp_load_widgets' );

/**
 * Register Genesis Team Member widget.
 *
 * @since 1.0.0
 */
function gtmp_load_widgets() {

	register_widget( 'Genesis_Team_Member_Widget' );

}
