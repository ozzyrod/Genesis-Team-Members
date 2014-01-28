<?php
/**
 * General Functions
 *
 * @package     GMTP
 * @subpackage  Functions
 * @copyright   Copyright (c) 2014, Ozzy Rodriguez
 * @license     GPL-2.0+
 * @since       1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Add image size used for the plugin
add_image_size( 'genesis-team-member', 300, 300, true );

// Add image size to gallery drop downs
add_filter('image_size_names_choose', 'gtmp_show_image_sizes');
function gtmp_show_image_sizes($sizes) {
	$sizes['genesis-team-member'] = __( 'Team Member', 'gtmp' );

	return $sizes;
}

function gtmp_team_member_archive_template( $archive_template ) {
	global $post;

	if ( is_post_type_archive ( 'team-member' ) ) {
		$archive_template = GTMP_PLUGIN_DIR . 'includes/archive_team-member.php';
	}

	return $archive_template;
}

//add_filter( 'archive_template', 'gtmp_team_member_archive_template' ) ;