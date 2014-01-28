<?php
/**
 * Genesis Team Members CPT
 *
 * Registers the custom post type required for the plugin
 *
 * @package     GTMP
 * @subpackage  Custom Post Types
 * @copyright   Copyright (c) 2014, Ozzy Rodriguez
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function gtmp_register_team_post_type() {
	$labels = array(
		'name' => __( 'Team Members', 'gtmp' ),
		'singular_name' => __( 'Team Member', 'gtmp' ),
		'add_new' => __( 'Add New Team Member', 'gtmp' ),
		'add_new_item' => __( 'Add New Team Member', 'gtmp' ),
		'edit_item' => __( 'Edit Team Member', 'gtmp' ),
		'new_item' => __( 'New Team Member', 'gtmp' ),
		'view_item' => __( 'View Team Member', 'gtmp' ),
		'search_items' => __( 'Search Team Members', 'gtmp' ),
		'not_found' =>  __( 'No team members found', 'gtmp' ),
		'not_found_in_trash' => __( 'No team members found in trash', 'gtmp' ),
		'parent_item_colon' => '',
		'menu_name' => __( 'Team Members', 'gtmp' )
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'rewrite' => array( 'slug' => 'team-members'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_icon' => '',
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail', 'genesis-layouts', 'genesis-seo', 'genesis-cpt-archives-settings' )
	);

	register_post_type( 'team-member', $args );
}

add_action( 'init', 'gtmp_register_team_post_type' );