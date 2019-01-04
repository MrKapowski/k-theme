<?php
/**
 * Custom template tags for this theme
 *
 * @package K
 * @since 0.8.4
 */

/**
 * Display an SVG.
 *
 * @param  array  $args  Parameters needed to display an SVG.
 * @since K 0.6.1
 */
function mrkapowski_do_svg( $args = array() ) {
	echo esc_html( mrkapowski_get_svg( $args ) );
}
