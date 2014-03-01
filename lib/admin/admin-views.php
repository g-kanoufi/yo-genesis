<?php

/**
 * Only show the admin bar to users who can at least use Posts
 *
 * @since 2.0.0
 */
if( !current_user_can( 'edit_posts' ) ) {
	add_filter( 'show_admin_bar', '__return_false' );
}


// add_action('widgets_init', 'yg_unregister_default_widgets');
/**
 * Disable some or all of the default widgets.
 *
 * @since 2.0.0
 */
function yg_unregister_default_widgets() {

	// unregister_widget( 'WP_Widget_Pages' );
	// unregister_widget( 'WP_Widget_Calendar' );
	// unregister_widget( 'WP_Widget_Archives' );
	// unregister_widget( 'WP_Widget_Meta' );
	// unregister_widget( 'WP_Widget_Search' );
	// unregister_widget( 'WP_Widget_Text' );
	// unregister_widget( 'WP_Widget_Categories' );
	// unregister_widget( 'WP_Widget_Recent_Posts' );
	// unregister_widget( 'WP_Widget_Recent_Comments' );
	// unregister_widget( 'WP_Widget_RSS' );
	// unregister_widget( 'WP_Widget_Tag_Cloud' );
	// unregister_widget( 'WP_Nav_Menu_Widget' );

}

add_filter( 'default_hidden_meta_boxes', 'yg_hidden_meta_boxes', 2 );
/**
 * Change which meta boxes are hidden by default on the post and page edit screens.
 *
 * @since 2.0.0
 */
function yg_hidden_meta_boxes( $hidden ) {

	global $current_screen;
	if( 'post' == $current_screen->id ) {
		$hidden = array( 'postexcerpt', 'trackbacksdiv', 'postcustom', 'commentstatusdiv', 'slugdiv', 'authordiv' );
		// Other hideable post boxes: genesis_inpost_scripts_box, commentsdiv, categorydiv, tagsdiv, postimagediv
	} elseif( 'page' == $current_screen->id ) {
		$hidden = array( 'postcustom', 'commentstatusdiv', 'slugdiv', 'authordiv', 'postimagediv' );
		// Other hideable post boxes: genesis_inpost_scripts_box, pageparentdiv
	}
	return $hidden;

}

/**
 * Remove Dashboard Meta Boxes
 */
function yg_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['normal']['yoast_db_widget']);
}

/**
 * Change Admin Menu Order
 */
function yg_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		// 'index.php', // Dashboard
		// 'separator1', // First separator
		// 'edit.php?post_type=page', // Pages
		// 'edit.php', // Posts
		// 'upload.php', // Media
		// 'gf_edit_forms', // Gravity Forms
		// 'genesis', // Genesis
		// 'edit-comments.php', // Comments
		// 'separator2', // Second separator
		// 'themes.php', // Appearance
		// 'plugins.php', // Plugins
		// 'users.php', // Users
		// 'tools.php', // Tools
		// 'options-general.php', // Settings
		// 'separator-last', // Last separator
	);
}

/**
 * Hide Admin Areas that are not used
 */
function yg_remove_menu_pages() {
	// remove_menu_page('link-manager.php');
}


// add_action( 'admin_footer-post-new.php', 'yg_media_manager_default_view' );
// add_action( 'admin_footer-post.php', 'yg_media_manager_default_view' );
/**
 * Change the media manager default view to 'upload', instead of 'library'
 *
 * See: http://wordpress.stackexchange.com/questions/96513/how-to-make-upload-filesselected-by-default-in-insert-media
 *
 * @since 2.0.11
 */
function yg_media_manager_default_view() {

    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            wp.media.controller.Library.prototype.defaults.contentUserSetting=false;
        });
    </script>
    <?php

}

// add_filter( 'posts_where', 'yg_restrict_attachment_viewing' );
/**
 * Prevent authors and contributors from seeing media that isn't theirs
 *
 * See: http://wordpress.org/support/topic/restrict-editors-from-viewing-media-that-others-have-uploaded
 *
 * @since 2.0.20
 */
function yg_restrict_attachment_viewing( $where ) {

	global $current_user;
	if(
		is_admin() &&
		!current_user_can('edit_others_posts') &&
		isset($_POST['action']) &&
		$_POST['action'] == 'query-attachments'
	) {
			$where .= ' AND post_author=' . $current_user->data->ID;
	}
	return $where;

}

/**
 * Add a stylesheet for TinyMCE
 *
 * @since 2.0.0
 */
// add_editor_style( 'css/editor-style.css' );

add_filter( 'tiny_mce_before_init', 'yg_tiny_mce_before_init' );
/**
 * Modifies the TinyMCE settings array
 *
 * @since 2.0.0
 */
function yg_tiny_mce_before_init( $options ) {

	$options['wordpress_adv_hidden'] = false;										// Shows the 'kitchen sink' by default
	$options['theme_advanced_blockformats'] = 'p,h2,h3,h4,blockquote';				// Restrict the Formats available in TinyMCE. Currently excluded: h1,h5,h6,address,pre
	return $options;

}

add_filter( 'mce_buttons', 'yg_tinymce_buttons' );
/**
 * Enables some commonly used formatting buttons in TinyMCE
 *
 * @since 2.0.15
 */
function yg_tinymce_buttons( $buttons ) {

	// $buttons[] = 'hr';															// Horizontal line
	$buttons[] = 'wp_page';															// Post pagination
	return $buttons;

}

add_filter( 'user_contactmethods', 'yg_user_contactmethods' );
/**
 * Updates the user profile contact method fields for today's popular sites.
 *
 * See: http://wpmu.org/shun-the-plugin-100-wordpress-code-snippets-from-across-the-net/
 *
 * @since 2.0.0
 */
function yg_user_contactmethods( $fields ) {

	//$fields['facebook'] = 'Facebook';												// Add Facebook
	//$fields['twitter'] = 'Twitter';												// Add Twitter
	//$fields['linkedin'] = 'LinkedIn';												// Add LinkedIn
	unset( $fields['aim'] );														// Remove AIM
	unset( $fields['yim'] );														// Remove Yahoo IM
	unset( $fields['jabber'] );														// Remove Jabber / Google Talk
	return $fields;

}

// add_action( 'admin_menu', 'yg_remove_dashboard_menus' );
/**
 * Remove default admin dashboard menus
 *
 * See: http://speckyboy.com/2011/04/27/20-snippets-and-hacks-to-make-wordpress-user-friendly-for-your-clients/
 *
 * @since 2.0.0
 */
function yg_remove_dashboard_menus() {

	global $menu;
    $restricted = array(
    	__('Dashboard'),
    	__('Posts'),
    	__('Media'),
    	__('Links'),
    	__('Pages'),
    	__('Comments'),
    	__('Appearance'),
    	__('Plugins'),
    	__('Users'),
    	__('Tools'),
    	__('Settings')
    );
    end($menu);
    while( prev($menu) ) {
        $value = explode( ' ', $menu[key($menu)][0] );
        if( in_array($value[0] != NULL ? $value[0] : "" , $restricted) ) {
	        unset( $menu[key($menu)] );
        }
    }

}

add_filter( 'login_errors', 'yg_login_errors' );
/**
 * Prevent the failed login notice from specifying whether the username or the password is incorrect.
 *
 * See: http://wpdaily.co/top-10-snippets/
 *
 * @since 2.0.0
 */
function yg_login_errors() {

    return 'Invalid username or password.';

}

add_action( 'admin_head', 'yg_hide_admin_help_button' );
/**
 * Hide the top-right help pull-down button by adding some CSS to the admin <head>
 *
 * See: http://speckyboy.com/2011/04/27/20-snippets-and-hacks-to-make-wordpress-user-friendly-for-your-clients/
 *
 * @since 2.0.0
 */
function yg_hide_admin_help_button() {

	?><style type="text/css">
		#contextual-help-link-wrap {
			display: none !important;
		}
	</style>
<?php

}
