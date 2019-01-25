<?php

add_action( 'widgets_init', 'mrkapowski_register_hcard' );

function mrkapowski_register_hcard() {
	register_widget( 'MrKapowski_HCard_Widget' );
}

class MrKapowski_HCard_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'MrKapowski_HCard_Widget',                // Base ID
			'MrKapowski H-Card Widget',        // Name
			array(
				'classname'   => 'hcard_widget',
				'description' => __( 'A widget that allows you to display author profile marked up as an h-card. Requires the IndieWeb plugin.', 'mrkapowski' ),
			)
		);

	} // end constructor

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		if ( 1 === (int) get_option( 'iw_single_author' ) ) {
			$display_author = get_option( 'iw_default_author' );
		} else {
			if ( is_single() ) {
				global $wp_query;
				$display_author = $wp_query->post->post_author;
			} else {
				return;
			}
		}

		$user_info = get_userdata( $display_author );

		// phpcs:ignore
		esc_html( $args['before_widget'] );

		?>

		<div id="hcard_widget">
			<?php // phpcs:ignore
			echo self::hcard( $user_info, $instance );
			?>
		</div>

		<?php
		// phpcs:ignore
		echo $args['after_widget'];
	}

	public static function get_hcard_display_defaults() {
		$defaults = array(
			'style'         => 'div',
			'container-css' => '',
			'single-css'    => '',
			'avatar_size'   => '256',
			'avatar'        => true, // Display Avatar
			'location'      => true, // Display location elements
			'notes'         => true, // Display Bio/Notes
			'email'         => false,  // Display email
			'me'            => true, // Display rel-me links inside h-card
		);
		return apply_filters( 'hcard_display_defaults', $defaults );
	}

	public static function hcard( $user, $args = array() ) {
		if ( ! $user ) {
			return false;
		}
		$user = new WP_User( $user );
		if ( ! $user ) {
			return false;
		}

		$args = wp_parse_args( $args, self::get_hcard_display_defaults() );
		if ( $args['avatar'] ) {
			$avatar = get_avatar(
				$user,
				$args['avatar_size'],
				'default',
				'',
				array(
					'class' => array( 'img-fluid', 'card-img-top', 'u-photo', 'hcard-photo' ),
				)
			);
		} else {
			$avatar = '';
		}
		$url   = $user->has_prop( 'user_url' ) ? $user->get( 'user_url' ) : $url = get_author_posts_url( $user->ID );
		$name  = $user->get( 'display_name' );
		$email = $user->get( 'user_email' );
		ob_start();
		include dirname( __FILE__ ) . '/templates/hcard-widget.php';
		$return = ob_get_contents();
		ob_end_clean();
		return $return;
	}
}
