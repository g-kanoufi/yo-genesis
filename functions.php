<?php

/**
 * Theme Setup
 * @since 1.0.0
 *
 * This setup function attaches all of the site-wide functions
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */

add_action( 'genesis_setup','child_theme_setup', 15 );
function child_theme_setup() {

	/****************************************
	Define child theme version
	*****************************************/

	define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/style.css' ) );


	/****************************************
	Include theme helper functions
	*****************************************/

	include_once( CHILD_DIR . '/lib/theme-helpers.php' );


	/****************************************
	Setup child theme functions
	*****************************************/

	include_once( CHILD_DIR . '/lib/theme-functions.php' );

	// Setup Child Theme Settings
	include_once( CHILD_DIR . '/lib/child-theme-settings.php' );

	/****************************************
	Theme Views
	*****************************************/

	include_once( CHILD_DIR . '/lib/theme-views.php' );


	/****************************************
	Required Plugins
	*****************************************/

	require_once( CHILD_DIR . '/lib/class-tgm-plugin-activation.php' );
	require_once( CHILD_DIR . '/lib/theme-require-plugins.php' );

	add_action( 'tgmpa_register', 'yg_register_required_plugins' );

	/****************************************
	Admin and Structure set up
	****************************************/
	// Developer Tools
	// include_once( CHILD_DIR . '/lib/developer-tools.php' );		// DO NOT USE THESE ON A LIVE SITE

	// Genesis
	include_once( CHILD_DIR . '/lib/genesis.php' );				// Customizations to Genesis-specific functions

	// Admin
	include_once( CHILD_DIR . '/lib/admin/admin-functions.php' );	// Customization to admin functionality
	include_once( CHILD_DIR . '/lib/admin/admin-views.php' );		// Customizations to the admin area display
	include_once( CHILD_DIR . '/lib/admin/admin-branding.php' );	// Admin view customizations that specifically involve branding


	// Structure (corresponds to Genesis's lib/structure)
	include_once( CHILD_DIR . '/lib/structure/archive.php' );
	include_once( CHILD_DIR . '/lib/structure/comments.php' );
	include_once( CHILD_DIR . '/lib/structure/footer.php' );
	include_once( CHILD_DIR . '/lib/structure/header.php' );
	include_once( CHILD_DIR . '/lib/structure/layout.php' );
	include_once( CHILD_DIR . '/lib/structure/loops.php' );
	include_once( CHILD_DIR . '/lib/structure/menu.php' );
	include_once( CHILD_DIR . '/lib/structure/post.php' );
	include_once( CHILD_DIR . '/lib/structure/search.php' );
	include_once( CHILD_DIR . '/lib/structure/sidebar.php' );
	include_once( CHILD_DIR . '/lib/structure/plugins.php' );

}



