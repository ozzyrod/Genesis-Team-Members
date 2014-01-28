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
			'number'     => '9',
			'order'      => 'DESC',
			'orderby'    => 'date',
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

			echo $before_title . $gtmp_title . $after_title;
			echo '<ul class="team-members">';

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
			$image_url = GTMP_PLUGIN_URL . 'assets/images/';

			// Enqueue style if widget is present
			wp_enqueue_style( 'gtmp-styles' );

			// Display the team member
			if ( $team_members->have_posts() ) :
			   while( $team_members->have_posts() ) : $team_members->the_post();

					echo '<li class="one-third"><article class="'. implode( ' ', get_post_class() ) .'" itemscope="itemscope" itemtype="http://schema.org/Person">';
						if ( FALSE === genesis_image( array( 'size' => 'genesis-team-member', 'attr' => array( 'class' => 'aligncenter' ) ) ) )
							echo '<img class="aligncenter" src="'. $image_url . 'genesis-team-member-default-image.jpg">';

						echo '<h4 class="team-member-title" itemprop="name"><a itemprop="url" href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h4>';
						$team_member_description = genesis_get_custom_field( '_gtmp_description' );
						$team_member_facebook = genesis_get_custom_field( '_gtmp_facebookurl' );
						$team_member_twitter = genesis_get_custom_field( '_gtmp_twitterurl' );
						$team_member_gplus = genesis_get_custom_field( '_gtmp_gplusurl' );
						$team_member_linkedin = genesis_get_custom_field( '_gtmp_linkedinurl' );
						$team_member_dribble = genesis_get_custom_field( '_gtmp_dribbleurl' );
						$team_member_email = genesis_get_custom_field( '_gtmp_emailurl' );
						$team_member_github = genesis_get_custom_field( '_gtmp_githuburl' );
						$team_member_instagram = genesis_get_custom_field( '_gtmp_instagramurl' );
						$team_member_pinterest = genesis_get_custom_field( '_gtmp_pinteresturl' );

						echo '<p><span itemprop="description">'. $team_member_description .'</span></p>';
						echo '<ul class="aligncenter">';
							if ( $team_member_facebook ) {
								echo '<li class="gtmp-facebook">';
									echo '<a href="'. $team_member_facebook .'" title="'. get_the_title() .' '. __( 'Facebook', 'gtmp' ) .'"><i class="fa fa-facebook"></i></a>';
								echo '</li>';
							}

							if ( $team_member_twitter ) {
								echo '<li class="gtmp-twitter">';
									echo '<a href="'. $team_member_twitter .'" title="'. get_the_title() .' '. __( 'Twitter', 'gtmp' ) .'"><i class="fa fa-twitter"></i></a>';
								echo '</li>';
							}

							if ( $team_member_gplus ) {
								echo '<li class="gtmp-gplus">';
									echo '<a href="'. $team_member_gplus .'" title="'. get_the_title() .' '. __( 'Google+', 'gtmp' ) .'"><i class="fa fa-google-plus"></i></a>';
								echo '</li>';
							}

							if ( $team_member_linkedin ) {
								echo '<li class="gtmp-linkedin">';
									echo '<a href="'. $team_member_linkedin .'" title="'. get_the_title() .' '. __( 'LinkedIn', 'gtmp' ) .'"><i class="fa fa-linkedin"></i></a>';
								echo '</li>';
							}

							if ( $team_member_dribble ) {
								echo '<li class="gtmp-dribble">';
									echo '<a href="'. $team_member_dribble .'" title="'. get_the_title() .' '. __( 'Dribble', 'gtmp' ) .'"><i class="fa fa-dribbble"></i></a>';
								echo '</li>';
							}

							if ( $team_member_email ) {
								echo '<li class="gtmp-email">';
									echo '<a href="mailto:'. $team_member_email .'" title="'. get_the_title() .' '. __( 'Email', 'gtmp' ) .'"><i class="fa fa-envelope"></i></a>';
								echo '</li>';
							}

							if ( $team_member_github ) {
								echo '<li class="gtmp-github">';
									echo '<a href="'. $team_member_github .'" title="'. get_the_title() .' '. __( 'Github', 'gtmp' ) .'"><i class="fa fa-github"></i></a>';
								echo '</li>';
							}

							if ( $team_member_instagram ) {
								echo '<li class="gtmp-instagram">';
									echo '<a href="'. $team_member_instagram .'" title="'. get_the_title() .' '. __( 'Instagram', 'gtmp' ) .'"><i class="fa fa-instagram"></i></a>';
								echo '</li>';
							}

							if ( $team_member_pinterest ) {
								echo '<li class="gtmp-pinterest">';
									echo '<a href="'. $team_member_pinterest .'" title="'. get_the_title() .' '. __( 'Pinterest', 'gtmp' ) .'"><i class="fa fa-pinterest"></i></a>';
								echo '</li>';
							}

						echo '</ul>';

						wpautop( $team_member_description );

					echo '</li></article>';

				endwhile;

			endif;
			echo '</ul>';

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
		$gtmp_number['teamnumber']  =  wp_strip_all_tags( $instance['teamnumber'] );
		$gtmp_order['order']   =  wp_strip_all_tags( $instance['order'] );
		$gtmp_orderby['orderby'] =  wp_strip_all_tags( $instance['orderby'] );

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
		$number  = wp_strip_all_tags( $instance['teamnumber'] );
		$order = wp_strip_all_tags( $instance['order'] );
		$orderby = wp_strip_all_tags( $instance['orderby'] );

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'gtmp' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<?php _e( 'Display', 'gtmp' ); ?>
			<input id="<?php echo $this->get_field_id( 'teamnumber' ); ?>" name="<?php echo $this->get_field_name( 'teamnumber' ); ?>" value="<?php echo $instance['teamnumber']; ?>" style="width:30px" />
			<?php _e( 'Team Members', 'gtmp' ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order', 'gtmp' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'order' ); ?>" id="<?php echo $this->get_field_id( 'order' ); ?>">
				<option value="ASC" <?php selected( 'ASC', $instance['order'] ); ?>><?php _e( 'Ascending' , 'gtmp' ); ?></option>
				<option value="DESC" <?php selected( 'DESC', $instance['order'] ); ?>><?php _e( 'Descending' , 'gtmp' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By', 'gtmp' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id( 'orderby' ); ?>">
				<option value="title" <?php selected( 'title', $instance['orderby'] ); ?>><?php _e( 'Title' , 'gtmp' ); ?></option>
				<option value="date" <?php selected( 'date', $instance['orderby'] ); ?>><?php _e( 'Date' , 'gtmp' ); ?></option>
				<option value="rand" <?php selected( 'rand', $instance['orderby'] ); ?>><?php _e( 'Random' , 'gtmp' ); ?></option>
				<option value="ID" <?php selected( 'ID', $instance['orderby'] ); ?>><?php _e( 'Team Member ID' , 'gtmp' ); ?></option>
			</select>
		</p>

		<?php
	}
}
