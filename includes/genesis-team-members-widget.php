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

		extract( $args );

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		// User-selected settings.
		$gtmp_title   = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$gtmp_number  = $instance['teamnumber'];
		$gtmp_order   = $instance['order'];
		$gtmp_orderby = $instance['orderby'];


		// Output the widget's HTML.
		echo $before_widget;

			// Setup the query
			$query_args = array(
				'suppress_filters' => true,
				'posts_per_page'   => $gtmp_number,
				'post_type'        => 'team-member',
				'orderby'          => $gtmp_orderby,
				'order'            => $gtmp_order,
			);

			// Use the loop to retrieve team members, but we only want the information attached to this team member
			$team_members = new WP_Query( $query_args );

			// Display the team member
			if ( $team_members->have_posts() ) :
			   while( $team_members->have_posts() ) : $team_members->the_post();

					echo '<article class="'. implode( ' ', get_post_class() ) .'" itemscope="itemscope" itemtype="http://schema.org/Person">';
						if ( FALSE === genesis_image( array( 'size' => 'genesis-team-member', 'attr' => array( 'class' => 'aligncenter' ) ) )
							echo 'NO IMAGE';

						echo '<a itemprop="url" href="'. get_permalink() .'" title="'. get_the_title() .'"><h4 class="team-member-title" itemprop="name">'. get_the_title() .'</h4></a>';
						$team_member_description = genesis_get_custom_field( '_gtmp_description' );
						$team_member_facebook = genesis_get_custom_field( '_gtmp_facebookurl' );
						$team_member_twitter = genesis_get_custom_field( '_gtmp_twitterurl' );
						$team_member_gplus = genesis_get_custom_field( '_gtmp_gplusurl' );
						$team_member_linkedin = genesis_get_custom_field( '_gtmp_linkedinurl' );
						$team_member_dribble = genesis_get_custom_field( '_gtmp_dribbleurl' );
						$team_member_email = genesis_get_custom_field( '_gtmp_emailurl' );
						$team_member_githubin = genesis_get_custom_field( '_gtmp_githuburl' );
						$team_member_instagram = genesis_get_custom_field( '_gtmp_instagramurl' );
						$team_member_pinterest = genesis_get_custom_field( '_gtmp_pinteresturl' );

						echo '<p><span itemprop="description">'. $team_member_description .'</span></p>';
						echo '<ul class="aligncenter">';
							if ( $team_member_facebook ) {
								echo '<li class="gtmp-facebook">';
									echo '<a href="'. $team_member_facebook .' title="'. get_the_title() . __( 'Facebook', 'gtmp' ) .'"></a>';
								echo '</li>';
							}

							if ( $team_member_twitter ) {
								echo '<li class="gtmp-twitter">';
									echo '<a href="'. $team_member_twitter .' title="'. get_the_title() . __( 'Twitter', 'gtmp' ) .'"></a>';
								echo '</li>';
							}

							if ( $team_member_gplus ) {
								echo '<li class="gtmp-gplus">';
									echo '<a href="'. $team_member_gplus .' title="'. get_the_title() . __( 'Google+', 'gtmp' ) .'"></a>';
								echo '</li>';
							}

							if ( $team_member_linkedin ) {
								echo '<li class="gtmp-linkedin">';
									echo '<a href="'. $team_member_linkedin .' title="'. get_the_title() . __( 'LinkedIn', 'gtmp' ) .'"></a>';
								echo '</li>';
							}

							if ( $team_member_dribble ) {
								echo '<li class="gtmp-dribble">';
									echo '<a href="'. $team_member_dribble .' title="'. get_the_title() . __( 'Dribble', 'gtmp' ) .'"></a>';
								echo '</li>';
							}

					echo '</article>';

				endwhile;

			endif;

		echo $after_widget;

	}

	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$new_instance['title']            = wp_strip_all_tags( $new_instance['title'] );
		$new_instance['awesome_icon']     = wp_strip_all_tags( $new_instance['awesome_icon'] );
		$new_instance['icon_color']       = wp_strip_all_tags( $new_instance['icon_color'] );
		$new_instance['icon_size']        = wp_strip_all_tags( $new_instance['icon_size'] );
		$new_instance['title_placement']  = wp_strip_all_tags( $new_instance['title_placement'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$new_instance['awesome_text'] =  $new_instance['awesome_text'];
		} else {
			$new_instance['awesome_text'] = wp_kses_data( $new_instance['awesome_text'] );
		}
		$new_instance['awesome_filter']   = isset( $new_instance['awesome_filter'] );

		return $new_instance;
	}

	/**
	 * Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		/** Merge with defaults */
		$instance      = wp_parse_args( (array) $instance, $this->defaults );
		$title         = wp_strip_all_tags( $instance['title'] );
		$awesome_text  = esc_textarea( $instance['awesome_text'] );
		$awesome_icons = afcw_get_icons();

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (Optional)', 'afcw' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_placement' ); ?>"><?php _e( 'Display the Title', 'afcw' ); ?>:</label>
			<select class="widefat awesome-select" id="<?php echo $this->get_field_id( 'title_placement' ); ?>" name="<?php echo $this->get_field_name( 'title_placement' ); ?>">
				<option value="before_icon" <?php selected( 'before_icon', $instance['title_placement'] ); ?>><?php _e( 'Before the Icon', 'afcw' ); ?></option>
				<option value="after_icon" <?php selected( 'after_icon', $instance['title_placement'] ); ?>><?php _e( 'After the Icon', 'afcw' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'awesome_icon' ); ?>"><?php _e( 'Choose an Icon', 'afcw' ); ?>:</label>
			<select class="widefat font-awesome" id="<?php echo $this->get_field_id( 'awesome_icon' ); ?>" name="<?php echo $this->get_field_name( 'awesome_icon' ); ?>">
				<?php foreach ( (array) $awesome_icons as $icon  ) { ?>
					<option value="<?php echo $icon['value']; ?>"<?php selected( $icon['value'], $instance['awesome_icon'] ); ?>><?php _e( $icon['name'], 'afcw' ) ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_color' ); ?>"><?php _e( 'Icon Color', 'afcw' ); ?>:</label>
			<select class="widefat awesome-select" id="<?php echo $this->get_field_id( 'icon_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_color' ); ?>">
				<option value="inverse" <?php selected( 'inverse', $instance['icon_color'] ); ?>><?php _e( 'Light', 'afcw' ); ?></option>
				<option value="dark" <?php selected( 'dark', $instance['icon_color'] ); ?>><?php _e( 'Dark', 'afcw' ); ?></option>
				<option value="overlay" <?php selected( 'overlay', $instance['icon_color'] ); ?>><?php _e( 'Overlay', 'afcw' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_size' ); ?>"><?php _e( 'Icon Size', 'afcw' ); ?>:</label>
			<select class="widefat awesome-select" id="<?php echo $this->get_field_id( 'icon_size' ); ?>" name="<?php echo $this->get_field_name( 'icon_size' ); ?>">
				<option value="lg" <?php selected( 'lg', $instance['icon_size'] ); ?>><?php _e( '1x', 'afcw' ); ?></option>
				<option value="2x" <?php selected( '2x', $instance['icon_size'] ); ?>><?php _e( '2x', 'afcw' ); ?></option>
				<option value="3x" <?php selected( '3x', $instance['icon_size'] ); ?>><?php _e( '3x', 'afcw' ); ?></option>
				<option value="4x" <?php selected( '4x', $instance['icon_size'] ); ?>><?php _e( '4x', 'afcw' ); ?></option>
				<option value="5x" <?php selected( '5x', $instance['icon_size'] ); ?>><?php _e( '5x', 'afcw' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'content_id' ); ?>"><?php _e( 'Link to Content', 'afcw' ); ?>:</label>
			<?php afcw_dropdown_posts( $this->get_field_name( 'content_id' ), $instance['content_id'] ); ?>
		</p>

		<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'awesome_text' ); ?>" name="<?php echo $this->get_field_name( 'awesome_text' ); ?>"><?php echo $awesome_text; ?></textarea>
		<p>
			<input id="<?php echo $this->get_field_id( 'awesome_filter' ); ?>" name="<?php echo $this->get_field_name( 'awesome_filter' ); ?>" type="checkbox" <?php checked( isset( $instance['awesome_filter'] ) ? $instance['awesome_filter'] : 0 ); ?> />&nbsp;
			<label for="<?php echo $this->get_field_id( 'awesome_filter' ); ?>"><?php _e( 'Automatically add paragraphs', 'afcw' ); ?></label>
		</p>

		<?php
	}
}
