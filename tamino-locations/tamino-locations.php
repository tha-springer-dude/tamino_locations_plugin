<?php
/**
 * Plugin Name: Tamino Locations
 * Description: Backend management for Locations (Orte) - independent from WooCommerce
 */

if ( ! defined('ABSPATH') ) exit;

/**
 * Register Locations CPT
 */
function tamino_register_locations_cpt() {

    register_post_type('tamino_travel_orte', array(

        'labels' => array(
            'name'          => 'Orte',
            'singular_name' => 'Ort',
            'menu_name'     => 'Orte',
            'add_new'       => 'Neuen Ort hinzufügen',
            'add_new_item'  => 'Neuen Ort hinzufügen',
            'edit_item'     => 'Ort bearbeiten',
            'new_item'      => 'Neuer Ort',
            'view_item'     => 'Ort ansehen',
            'search_items'  => 'Orte durchsuchen',
            'not_found'     => 'Keine Orte gefunden',
        ),

        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true, // ✅ no Woo dependency anymore
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-location',

        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields'
        ),

        'has_archive' => false,

        'rewrite' => array(
            'slug' => 'tamino_travel_orte',
            'with_front' => true
        ),

        'show_in_rest' => true,
    ));
}

add_action('init', 'tamino_register_locations_cpt');


/**
 * Admin column: Thumbnail
 */
function tamino_locations_columns($columns) {

    $columns['thumbnail'] = 'Bild';

    return $columns;
}

add_filter('manage_tamino_travel_orte_posts_columns', 'tamino_locations_columns');


function tamino_locations_column_content($column, $post_id) {

    if ($column === 'thumbnail') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }
}

add_action('manage_tamino_travel_orte_posts_custom_column', 'tamino_locations_column_content', 10, 2);