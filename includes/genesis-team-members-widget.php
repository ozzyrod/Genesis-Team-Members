<?php
/**
 * Genesis Team Member Widget
 *
 * Displays team members from the custom
 * post type.
 *
 * @package     GTMP
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
 */

/**
 * Genesis Team Member widget class.
 *
 * @category GTMP
 * @package Widgets
 *
 * @since 1.0.0
 */
class Genesis_Team_Member_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 */
	function __construct() {

		$this->defaults = array(
			'title'      => '',
			'order'      => '',
			'orderby'    => '',
		);

		$widget_ops = array(
			'classname'   => 'genesis-team-members',
			'description' => __( 'Displays team members in a 3 column format.', 'gtmp' ),
		);

		$control_ops = array(
			'id_base' => 'genesis-team-members',
			'width'   => 300,
			'height'  => 450,
		);

		parent::__construct('genesis-team-members', __('Genesis Team Members', 'gtmp'), $widget_ops, $control_ops);

	}

	/**
	 * Echo the widget content.
	 *
	 * @param array $args Display arguments including after_icon, before_icon, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {


	}
}
