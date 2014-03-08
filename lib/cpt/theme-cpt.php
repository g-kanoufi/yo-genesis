<?php
/**
 * Theme Custom Type set up
 *
 * This file set up a custom post type and taxonomies but also custom meta boxes
 * Genesis > Child Theme Settings.
 *
 * @package     yo-genesis
 * @since       1.0.0
 * @link        https://github.com/g-kanoufi/yo-genesis/
 * @author      Guillaume Kanoufi <guillaume@lostwebdesigns.com>
 * @copyright   Copyright (c) 2012, Guillaume Kanoufi
 * @license     http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link        https://github.com/g-kanoufi/yo-genesis
 */


/*
* Set up the CPT
*
*/
add_action('after_setup_theme', 'setup_cpt');

function setup_cpt(){
  if(!class_exists('Super_Custom_Post_Type'))
    return;



  $cpt = new Super_Custom_Post_Type('cutom_name', 'cutom_name', 'cutom_names', array(
        'rewrite' => array( 'slug' => 'cutom_names' ),
        'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'genesis-seo', 'genesis-cpt-archives-settings' ),
      )
  );
  $cpt->set_icon( 'group');
  $cpt->add_meta_box( array(
    'id' => 'custom_meta',
    'fields' => array(
        'first_name' => array(
            'label' => 'Exemple meta box 1',
            'type' => 'text'
        ),
        'last_name' => array(
            'label' => 'Exemple meta box 2',
            'type' => 'text'
        ),
        'featured' => array(
            'label' => 'Make this cutom_cpt appear on home page for example',
            'type' => 'checkbox'
        )
      )
    ));

}
