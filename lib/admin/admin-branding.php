<?php

add_filter( 'login_headerurl', 'yg_login_headerurl' );
/**
 * Makes the login screen's logo link to your homepage, instead of to WordPress.org.
 *
 * @since 2.0.0
 */
function yg_login_headerurl() {

    return home_url();

}

add_filter( 'login_headertitle', 'yg_login_headertitle' );
/**
 * Makes the login screen's logo title attribute your site title, instead of 'WordPress'.
 *
 * @since 2.0.0
 */
function yg_login_headertitle() {

    return get_bloginfo( 'name' );

}

add_action( 'login_enqueue_scripts', 'yg_replace_login_logo' );
/**
 * Replaces the login screen's WordPress logo with the 'login-logo.png' in your child theme images folder.
 *
 * Disabled by default. Make sure you have a login logo before using this function!
 *
 * Updated 2.0.1: Assumes SVG logo by default
 * Updated 2.0.20: WP 3.8 logo
 *
 * @since 2.0.0
 */
function yg_replace_login_logo() {

	$brand_color = '#dd002a';
	$complementary_color = '#1e1e1e';
	$border_color = '#a1001f';

	?><style type="text/css">

		body.login{
			background:<?php echo $complementary_color;?>!important;
		}

		body.login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo-login.svg);

			/* Adjust to the dimensions of your logo. WP Default: 80px 80px */
			background-size: 160px 160px;
			width: 160px;
			height: 160px;
		}

           body.login #nav a, body.login #backtoblog a {
	           color: <?php echo $brand_color;?> !important;
	     }
	     body.login #nav a:hover, body.login #backtoblog a:hover {
	           color: <?php echo $border_color;?> !important;
	     }

	     body.login .button-primary {
	            background: <?php echo $brand_color;?>; /* Old browsers */
	            background: -moz-linear-gradient(top, <?php echo $brand_color;?> 0%, darken(<?php echo $brand_color;?>, 10%) 100%); /* FF3.6+ */
	            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $brand_color;?>), color-stop(100%, darken(<?php echo $brand_color;?>, 10%))); /* Chrome,Safari4+ */
	            background: -webkit-linear-gradient(top, <?php echo $brand_color;?> 0%, darken(<?php echo $brand_color;?>, 10%) 100%); /* Chrome10+,Safari5.1+ */
	            background: -o-linear-gradient(top, <?php echo $brand_color;?> 0%, darken(<?php echo $brand_color;?>, 10%) 100%); /* Opera 11.10+ */
	            background: -ms-linear-gradient(top, <?php echo $brand_color;?> 0%, darken(<?php echo $brand_color;?>, 10%) 100%); /* IE10+ */
	            background: linear-gradient(to bottom, <?php echo $brand_color;?> 0%, darken(<?php echo $brand_color;?>, 10%) 100%); /* W3C */

	            -webkit-box-shadow: none!important;
			 box-shadow: none !important;

	            border-color:<?php echo $border_color;?>!important;
           }
           body.login .button-primary:hover, body.login .button-primary:active {
            	background: <?php echo $border_color;?>; /* Old browsers */
                background: -moz-linear-gradient(top, <?php echo $border_color;?> 0%, darken(<?php echo $brand_color;?>, 10%) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $border_color;?>), color-stop(100%,darken(<?php echo $brand_color;?>, 10%))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top, <?php echo $border_color;?> 0%,darken(<?php echo $brand_color;?>, 10%) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top, <?php echo $border_color;?> 0%,darken(<?php echo $brand_color;?>, 10%) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top, <?php echo $border_color;?> 0%,darken(<?php echo $brand_color;?>, 10%) 100%); /* IE10+ */
                background: linear-gradient(to bottom, <?php echo $border_color;?> 0%,darken(<?php echo $brand_color;?>, 10%) 100%); /* W3C */
           }

	</style>
<?php

}

add_filter( 'wp_mail_from_name', 'yg_mail_from_name' );
/**
 * Makes WordPress-generated emails appear 'from' your WordPress site name, instead of from 'WordPress'.
 *
 * @since 2.0.0
 */
function yg_mail_from_name() {

	return get_option( 'blogname' );

}

// add_filter( 'wp_mail_from', 'yg_wp_mail_from' );
/**
 * Makes WordPress-generated emails appear 'from' your WordPress admin email address.
 *
 * Disabled by default, in case you don't want to reveal your admin email.
 *
 * @since 2.0.0
 */
function yg_wp_mail_from() {

	return get_option( 'admin_email' );

}

add_action( 'wp_before_admin_bar_render', 'yg_remove_wp_icon_from_admin_bar' );
/**
 * Removes the WP icon from the admin bar
 *
 * See: http://wp-snippets.com/remove-wordpress-logo-admin-bar/
 *
 * @since 2.0.0
 */
function yg_remove_wp_icon_from_admin_bar() {

    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');

}

// add_filter( 'admin_footer_text', 'yg_admin_footer_text' );
/**
 * Modify the admin footer text
 *
 * See: http://wp-snippets.com/change-footer-text-in-wp-admin/
 *
 * @since 2.0.0
 */
function yg_admin_footer_text () {

	echo 'YOUR TEXT HERE.';

}
