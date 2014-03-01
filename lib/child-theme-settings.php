<?php
/**
 * Child Theme Settings
 *
 * This file registers all of this child theme's specific Theme Settings, accessible from
 * Genesis > Child Theme Settings.
 *
 * @package     YG_Genesis_Child
 * @since       1.0.0
 * @link        https://github.com/billerickson/YG-Genesis-Child
 * @author      Guillaume Kanoufi <guillaume@lostwebdesigns.com>
 * @copyright   Copyright (c) 2012, Guillaume Kanoufi
 * @license     http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link        https://github.com/g-kanoufi/YG-Genesis-Child
 */

/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Child Theme Settings page.
 *
 * @since 1.0.0
 *
 * @package YG_Genesis_Child
 * @subpackage Child_Theme_Settings
 */
class Child_Theme_Settings extends Genesis_Admin_Boxes {

	/**
	 * Create an admin menu item and settings page.
	 * @since 1.0.0
	 */
	function __construct() {

		// Specify a unique page ID.
		$page_id = 'child';

		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => 'Genesis - Child Theme Settings',
				'menu_title'  => 'Child Theme Settings',
			)
		);

		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array(
		//	'screen_icon'       => 'options-general',
		//	'save_button_text'  => 'Save Settings',
		//	'reset_button_text' => 'Reset Settings',
		//	'save_notice_text'  => 'Settings saved.',
		//	'reset_notice_text' => 'Settings reset.',
		);

		// Give it a unique settings field.
		// You'll access them from genesis_get_option( 'option_name', 'child-settings' );
		$settings_field = 'child-settings';

		// Set the default values
		$default_settings = array(
			'twitter_url' => '',
			'facebook_url' => '',
			'pinterest_url' => '',
			'flickr_url' => '',
			'youtuyg_url' => '',
			'vimeo_url' => '',
			'linkedin_url' => '',
			'organization' => '',
			'email_address' => '',
			'street_address' => '',
			'city' => '',
			'state' => '',
			'zip' => '',
			'phone' => '',
			'mobile' => '',
			'country' => '',
			'gmap_latitude' => '',
			'gmap_longitude' => '',
			'footer-left'   => 'Copyright &copy; ' . date( 'Y' ) . ' All Rights Reserved',
			'footer-right' => 'Site by <a href="http://www.kernelcreativemedia.com">Guillaume Kanoufi</a>',
		);

		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );

		// Initialize the Sanitization Filter
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );

	}

	/**
	 * Set up Sanitization Filters
	 * @since 1.0.0
	 *
	 * See /lib/classes/sanitization.php for all available filters.
	 */
	function sanitization_filters() {

		genesis_add_option_filter( 'no_html', $this->settings_field,
			array(
				'twitter_url',
				'facebook_url',
				'pinterest_url',
				'flickr_url',
				'youtuyg_url',
				'vimeo_url',
				'linkedin_url',
				'organization',
				'email_address',
				'street_address',
				'city',
				'state',
				'zip',
				'phone',
				'mobile',
				'country',
				'gmap_latitude',
				'gmap_longitude',
				'footer-left',
				'footer-right',
			) );
	}

	/**
	 * Set up Help Tab
	 * @since 1.0.0
	 *
	 * Genesis automatically looks for a help() function, and if provided uses it for the help tabs
	 * @link http://wpdevel.wordpress.com/2011/12/06/help-and-screen-api-changes-in-3-3/
	 */
	 function help() {
	 	$screen = get_current_screen();

		$screen->add_help_tab( array(
			'id'      => 'theme-options-help',
			'title'   => 'theme-options Help',
			'content' => '<p>This option page, helps you set up your Social links and business/organisation address and geolocation.</p>',
		) );
	 }

	/**
	 * Register metaboxes on Child Theme Settings page
	 * @since 1.0.0
	 */
	function metaboxes() {

		add_meta_box('child-theme-social-settings', 'Social Links', array( $this, 'child_theme_social_settings_box'), $this->pagehook, 'main', 'high');

		add_meta_box('child-theme-admin-info-settings', 'Business/Organisation Info', array( $this, 'child_theme_admin_info_settings_box'), $this->pagehook, 'main', 'high');

		// add_meta_box('footer_metabox', 'Footer', array( $this, 'footer_metabox' ), $this->pagehook, 'main', 'high');

	}

	/**
	 * Social Metabox
	 * @since 1.0.0
	 */

	function child_theme_social_settings_box() {
		?>

		<p>Twitter URL:<br />
		<input type="text" name="<?php echo $this->get_field_id('twitter_url');?>" value="<?php echo $this->get_field_value('twitter_url'); ?>" size="50" /> </p>

		<p>Facebook URL:<br />
		<input type="text" name="<?php echo $this->get_field_id('facebook_url');?>" value="<?php echo $this->get_field_value('facebook_url'); ?>" size="50" /> </p>

		<p>Pinterest URL:<br />
		<input type="text" name="<?php echo $this->get_field_id('pinterest_url');?>" value="<?php echo $this->get_field_value('pinterest_url'); ?>" size="50" /> </p>

		<p>Flickr URL:<br />
		<input type="text" name="<?php echo $this->get_field_id('flickr_url');?>" value="<?php echo $this->get_field_value('flickr_url'); ?>" size="50" /> </p>

		<p>Youtube URL:<br />
		<input type="text" name="<?php echo $this->get_field_id('youtuyg_url');?>" value="<?php echo $this->get_field_value('youtuyg_url'); ?>" size="50" /> </p>

		<p>Vimeo URL:<br />
		<input type="text" name="<?php echo $this->get_field_id('vimeo_url');?>" value="<?php echo $this->get_field_value('vimeo_url'); ?>" size="50" /> </p>

		<p>Linkedin URL:<br />
		<input type="text" name="<?php echo $this->get_field_id('linkedin_url');?>" value="<?php echo $this->get_field_value('linkedin_url'); ?>" size="50" /> </p>

		<?php
	}

	/**
	 * Localization Metabox
	 * @since 1.0.0
	 */

	function child_theme_admin_info_settings_box() {
		$country_list = array("Afghanistan","Albania","Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Central African Republic","Chad","Chile","China","Colombi","Comoros","Congo (Brazzaville)","Congo","Costa Rica","Cote d'Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor (Timor Timur)","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia, The","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea, North","Korea, South","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepa","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe");
		?>

		<p>Organization:<br />
		<input type="text" name="<?php echo $this->get_field_id('organization');?>" value="<?php echo $this->get_field_value('organization'); ?>" size="50" /> </p>

		<p>Email Address:<br />
		<input type="text" name="<?php echo $this->get_field_id('email_address');?>" value="<?php echo $this->get_field_value('email_address'); ?>" size="50" /> </p>

		<p>Street Address:<br />
		<input type="text" name="<?php echo $this->get_field_id('street_address');?>" value="<?php echo $this->get_field_value('street_address'); ?>" size="50" /> </p>

		<p>City:<br />
		<input type="text" name="<?php echo $this->get_field_id('city');?>" value="<?php echo $this->get_field_value('city'); ?>" size="50" /> </p>

		<p>State: <em>Abbreviated Please!</em><br />
		<input type="text" name="<?php echo $this->get_field_id('state');?>" value="<?php echo $this->get_field_value('state'); ?>" size="50" /> </p>

		<p>Zip Code:<br />
		<input type="text" name="<?php echo $this->get_field_id('zip');?>" value="<?php echo $this->get_field_value('zip'); ?>" size="50" /> </p>

		<p>Country: <br />
		<select name="<?php echo $this->get_field_id('country');?>">
	                            <option value="<?php echo $this->get_field_value('country'); ?>" selected><?php echo $this->get_field_value('country'); ?></option>
	                            <option value="United States">United States</option>
	                            <option value="France">France</option>
	                            <option value="United Kingdom">United Kingdom</option>
	                            <option value="Brazil">Brazil</option>
	                            <option value="Indonesia">Indonesia</option>
	                            <option value="New Zealand">New Zealand</option>
	                            <option value="Nicaragua">Nicaragua</option>
	                            <option value=" ">--</option>
	                            <?php foreach($country_list as $country):?>
	                            	<option value="<?php echo $country;?>"><?php echo $country;?></option>
	                            <?php endforeach;?>
	                        </select>

		<p>Phone Number:<br />
		<input type="text" name="<?php echo $this->get_field_id('phone');?>" value="<?php echo $this->get_field_value('phone'); ?>" size="50" /> </p>

		<p>Mobile Phone Number:<br />
		<input type="text" name="<?php echo $this->get_field_id('mobile');?>" value="<?php echo $this->get_field_value('mobile'); ?>" size="50" /> </p>

		<p>Google map latitude:<br />
		<input type="text" name="<?php echo $this->get_field_id('gmap_latitude');?>" value="<?php echo $this->get_field_value('gmap_latitude'); ?>" size="50" /> </p>
		<p>Google map longitude:<br />
		<input type="text" name="<?php echo $this->get_field_id('gmap_longitude');?>" value="<?php echo $this->get_field_value('gmap_longitude'); ?>" size="50" /> </p>

		<?php
	}


}

/**
 * Add the Theme Settings Page
 * @since 1.0.0
 */
function yg_add_child_theme_settings() {
	global $_child_theme_settings;
	$_child_theme_settings = new Child_Theme_Settings;
}
add_action( 'genesis_admin_menu', 'yg_add_child_theme_settings' );
