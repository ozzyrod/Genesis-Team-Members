<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category GTMP
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'gtmp_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function gtmp_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_gtmp_';

	$meta_boxes['test_metabox'] = array(
		'id'         => 'team_metabox',
		'title'      => __( 'Team Member Information', 'gtmp' ),
		'pages'      => array( 'team-member', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Description', 'gtmp' ),
				'desc' => __( 'Short description of this person', 'gtmp' ),
				'id'   => $prefix . 'description',
				'type' => 'textarea_small',
			),
			array(
				'name' => __( 'Facebook URL', 'gtmp' ),
				'desc' => __( 'Full address', 'gtmp' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter URL', 'gtmp' ),
				'desc' => __( 'Full address', 'gtmp' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Google+ URL', 'gtmp' ),
				'desc' => __( 'Full address', 'gtmp' ),
				'id'   => $prefix . 'gplusurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Linkedin URL', 'gtmp' ),
				'desc' => __( 'Full address', 'gtmp' ),
				'id'   => $prefix . 'linkedinurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Dribble URL', 'gtmp' ),
				'desc' => __( 'Full address', 'gtmp' ),
				'id'   => $prefix . 'dribbleurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Email Address', 'gtmp' ),
				'desc' => __( 'Email address', 'gtmp' ),
				'id'   => $prefix . 'emailurl',
				'type' => 'text_email',
			),
			array(
				'name' => __( 'Github URL', 'gtmp' ),
				'desc' => __( 'Full address', 'gtmp' ),
				'id'   => $prefix . 'githuburl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Instagram URL', 'gtmp' ),
				'desc' => __( 'Full address', 'gtmp' ),
				'id'   => $prefix . 'instagramurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Pinterest URL', 'gtmp' ),
				'desc' => __( 'Full address', 'gtmp' ),
				'id'   => $prefix . 'pinteresturl',
				'type' => 'text_url',
			),
		),
	);

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
