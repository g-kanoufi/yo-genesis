<?php

function yg_chlid_theme_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	// $optionsframework_settings = get_option('optionsframework');
	// $optionsframework_settings['id'] = $themename;
	// update_option('optionsframework', $optionsframework_settings);

	echo $themename;
}


add_action( 'pre_ping', 'yg_disable_self_pings' );
/**
 * Prevent the child theme from being overwritten by a WordPress.org theme with the same name.
 *
 * See: http://wp-snippets.com/disable-self-trackbacks/
 *
 * @since 2.0.0
 */
function yg_disable_self_pings( &$links ) {

    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, home_url() ) )
            unset($links[$l]);

}


/**
 * Activate the Link Manager
 *
 * See: http://wordpressexperts.net/how-to-activate-link-manager-in-wordpress-3-5/
 *
 * @since 2.0.1
 */
// add_filter( 'pre_option_link_manager_enabled', '__return_true' );		// Activate
