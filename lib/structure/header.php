<?php

/**
 * Cleanup <head>
 *
 * @since 2.0.0
 */
remove_action( 'wp_head', 'rsd_link' );									// RSD link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );				// Parent rel link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );				// Start post rel link
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );	// Adjacent post rel link
remove_action( 'wp_head', 'wp_generator' );								// WP Version

add_action( 'genesis_doctype', 'yg_x_ua_compatible' );
/**
 * For IE to render in edge mode
 *
 * @since 2.0.20
 */
function yg_x_ua_compatible() {

	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">' . "\n";

}

remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'yg_load_stylesheets' );
/**
 * Overrides the default Genesis stylesheet with child theme specific.
 *
 * Only load these styles on the front-end.
 *
 * @since 2.0.0
 */
function yg_load_stylesheets() {

    if( !is_admin() ) {
		// Main theme stylesheet
	    wp_enqueue_style( 'bfg', get_stylesheet_directory_uri() . '/style.css', array(), null );

	    // IE-only stylesheet
	    // wp_enqueue_style( 'yg-ie', get_stylesheet_directory_uri() . '/css/ie.css', array('bfg'), null );

	    // Fallback for old IE
	    wp_enqueue_style( 'yg-ie-universal', '//universal-ie6-css.googlecode.com/files/ie6.1.1.css', array(), null );

	    // Google Fonts
    	// wp_enqueue_style(
    	// 	'google-fonts',
    	// 	'//fonts.googleapis.com/css?family=Open+Sans:300,400,700',		// Open Sans (light, normal, and bold), for example
    	// 	array(),
    	// 	null
    	// );
	}

}

add_action( 'wp_enqueue_scripts', 'yg_load_scripts' );
/**
 * Load scripts
 *
 * Only load these scripts on the front-end.
 *
 * @since 2.0.0
 */
function yg_load_scripts() {

    if( ( is_single() || is_page() || is_attachment() ) && comments_open() & get_option( 'thread_comments' ) == 1 && !is_front_page() ) {
		wp_enqueue_script( 'comment-reply' );
    } else {
		wp_dequeue_script( 'comment-reply' );
    }

    if( !is_admin() ) {
		// Override WP default self-hosted jQuery with version from Google's CDN
    		wp_enqueue_script( 'yg_lr',get_bloginfo('url') . ':35729/livereload.js?snipver=1', null, false, true);
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array(), null, true );
		add_filter( 'script_loader_src', 'yg_jquery_local_fallback', 10, 2 );

	      wp_enqueue_script( 'yg_script', get_stylesheet_directory_uri() . '/assets/js/main.min.js', array( 'yg_plugins' ), null, true );
    }

}

add_filter( 'style_loader_tag', 'yg_ie_conditionals', 10, 2 );
/**
 * Wrap stylesheets in IE conditional comments.
 *
 * Load the main stylesheet for all non-IE browsers & IE8+, the IE stylesheet for IE8+, and the IE universal stylesheet for IE 7-.
 *
 * @since 1.x
 */
function yg_ie_conditionals( $tag, $handle ) {

	if( 'bfg' == $handle ) {
        $output = '<!--[if !IE]> -->' . "\n" . $tag . '<!-- <![endif]-->' . "\n";
        $output .= '<!--[if gte IE 8]>' . "\n" . $tag . '<![endif]-->' . "\n";
	} elseif( 'yg-ie' == $handle ) {
        $output = '<!--[if gte IE 8]>' . "\n" . $tag . '<![endif]-->' . "\n";
	} elseif( 'yg-ie-universal' == $handle ) {
        $output = '<!--[if lt IE 8]>' . "\n" . $tag . '<![endif]-->' . "\n";
	} else {
		$output = $tag;
	}

    return $output;

}

/**
 * jQuery local fallback, if Google CDN is unreachable
 *
 * See: https://github.com/roots/roots/blob/aa59cede7fbe2b853af9cf04e52865902d2ff1a9/lib/scripts.php#L37-L52
 *
 * @since 2.0.20
 */
add_action( 'wp_head', 'yg_jquery_local_fallback' );
function yg_jquery_local_fallback( $src, $handle = null ) {

	static $add_jquery_fallback = false;

	if( $add_jquery_fallback ) {
		echo '<script>window.jQuery || document.write(\'<script src="' . includes_url() . 'js/jquery/jquery.js"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}

	if( $handle === 'jquery' ) {
		$add_jquery_fallback = true;
	}

	return $src;

}

// add_filter( 'genesis_pre_load_favicon', 'yg_pre_load_favicon' );
/**
 * Simple favicon override to specify your favicon's location
 *
 * @since 2.0.0
 */
function yg_pre_load_favicon() {

	return get_stylesheet_directory_uri() . '/images/favicon.ico';

}

// remove_action( 'wp_head', 'genesis_load_favicon' );
// add_action( 'wp_head', 'yg_load_favicons' );
/**
 * Show the best favicon, within reason
 *
 * See: http://www.jonathantneal.com/blog/understand-the-favicon/
 *
 * @since 2.0.4
 */
function yg_load_favicons() {

	$favicon_path = get_stylesheet_directory_uri() . '/images/favicons';

	// Use a 152px X 152px PNG for the latest iOS devices
	echo '<link rel="apple-touch-icon" href="' . $favicon_path . '/favicon-152.png">';

	// Use a 96px X 96px PNG for modern desktop browsers
	echo '<link rel="icon" href="' . $favicon_path . '/favicon-96.png">';

	// Give IE <= 9 the old favicon.ico (16px X 16px)
	echo '<!--[if IE]><link rel="shortcut icon" href="' . $favicon_path . '/favicon.ico"><![endif]-->';

	// Use a 144px X 144px PNG for Windows tablets, or just serve them the iOS7 152px icon
	// echo '<meta name="msapplication-TileImage" content="' . $favicon_path . '/favicon-144.png">';
	echo '<meta name="msapplication-TileImage" content="' . $favicon_path . '/favicon-152.png">';

	// Optional: specify a background color for your Windows tablet icon
	// echo '<meta name="msapplication-TileColor" content="#d83434">';

}

add_filter( 'body_class', 'yg_no_js_body_class' );
/**
 * Adds a 'no-js' class to <body>, for testing the presence of JavaScript
 *
 * @since 2.0.0
 */
function yg_no_js_body_class( $classes ) {

	$classes[] = 'no-js ui';
	return $classes;

}

/**
 * Remove the header
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_header', 'genesis_do_header' );

/**
 * Remove the site title and/or description
 *
 * @since 2.0.9
 */
// remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
// remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
