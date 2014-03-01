<?php

/****************************************
Misc Theme Functions
*****************************************/

// Unregister the superfish scripts
add_action( 'wp_enqueue_scripts', 'yg_unregister_superfish' );

function yg_unregister_superfish() {
	wp_deregister_script( 'superfish' );
	wp_deregister_script( 'superfish-args' );
}

// Filter Yoast SEO Metabox Priority
add_filter( 'wpseo_metabox_prio', 'yg_filter_yoast_seo_metabox' );

function yg_filter_yoast_seo_metabox() {
	return 'low';
}

//Gravity form disable autoscrolling of the form
add_filter("gform_confirmation_anchor", create_function("","return false;"));
