<?php
// Register Custom Post Type
function real_estate_post_type() {

    $labels = array(
        'name'                  => _x( 'RE objects', 'Post Type General Name', TEXT_DOMAIN ),
        'singular_name'         => _x( 'RE object', 'Post Type Singular Name', TEXT_DOMAIN ),
        'menu_name'             => __( 'RE objects', TEXT_DOMAIN ),
        'name_admin_bar'        => __( 'RE objects', TEXT_DOMAIN ),
        'archives'              => __( 'RE object Archives', TEXT_DOMAIN ),
        'attributes'            => __( 'RE object Attributes', TEXT_DOMAIN ),
        'parent_item_colon'     => __( 'RE Item:', TEXT_DOMAIN ),
        'all_items'             => __( 'All RE Items', TEXT_DOMAIN ),
        'add_new_item'          => __( 'Add New RE Item', TEXT_DOMAIN ),
        'add_new'               => __( 'Add New RE', TEXT_DOMAIN ),
        'new_item'              => __( 'New RE Item', TEXT_DOMAIN ),
        'edit_item'             => __( 'Edit RE Item', TEXT_DOMAIN ),
        'update_item'           => __( 'Update RE Item', TEXT_DOMAIN ),
        'view_item'             => __( 'View RE Item', TEXT_DOMAIN ),
        'view_items'            => __( 'View RE Items', TEXT_DOMAIN ),
        'search_items'          => __( 'Search RE Item', TEXT_DOMAIN ),
        'not_found'             => __( 'Not found', TEXT_DOMAIN ),
        'not_found_in_trash'    => __( 'Not found in Trash', TEXT_DOMAIN ),
        'featured_image'        => __( 'Featured Image', TEXT_DOMAIN ),
        'set_featured_image'    => __( 'Set featured image', TEXT_DOMAIN ),
        'remove_featured_image' => __( 'Remove featured image', TEXT_DOMAIN ),
        'use_featured_image'    => __( 'Use as featured image', TEXT_DOMAIN ),
        'insert_into_item'      => __( 'Insert into item', TEXT_DOMAIN ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', TEXT_DOMAIN ),
        'items_list'            => __( 'Items list', TEXT_DOMAIN ),
        'items_list_navigation' => __( 'Items list navigation', TEXT_DOMAIN ),
        'filter_items_list'     => __( 'Filter items list', TEXT_DOMAIN ),
    );
    $args = array(
        'label'                 => __( 'Real estate object', TEXT_DOMAIN ),
        'description'           => __( 'Real estate objects', TEXT_DOMAIN ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-building',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( 'real_estate', $args );

}
add_action( 'init', 'real_estate_post_type', 0 );