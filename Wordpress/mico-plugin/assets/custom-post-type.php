<?php
function create_post_type()
{
    $labels = array(
        'name' => _x('Employees', 'Post type general name', 'textdomain'),
        'singular_name' => _x('Employee', 'Post type singular name', 'textdomain'),
        'menu_name' => _x('Employees', 'Admin Menu text', 'textdomain'),
        'name_admin_bar' => _x('Employee', 'Add New on Toolbar', 'textdomain'),
        'add_new' => __('Register New', 'textdomain'),
        'add_new_item' => __('Register New Employee', 'textdomain'),
        'new_item' => __('Register Employee', 'textdomain'),
        'edit_item' => __('Edit Employee', 'textdomain'),
        'view_item' => __('View Employee', 'textdomain'),
        'all_items' => __('All Employees', 'textdomain'),
        'search_items' => __('Search Employees', 'textdomain'),
        'parent_item_colon' => __('Parent Employees:', 'textdomain'),
        'not_found' => __('No Employees found.', 'textdomain'),
        'not_found_in_trash' => __('No Employees found in Trash.', 'textdomain'),
        'featured_image' => _x('Employee Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
        'set_featured_image' => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'use_featured_image' => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
        'archives' => _x('Employee archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
        'insert_into_item' => _x('Insert into Employee', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
        'uploaded_to_this_item' => _x('Uploaded to this Employee', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
        'filter_items_list' => _x('Filter Employee list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
        'items_list_navigation' => _x('Employees list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
        'items_list' => _x('Employees list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain')
    );

    $supports = array(
        'title',
        'thumbnail'
    );

    $args = array(
        'label' => __('employees'),
        'description' => __('employees & Occupations'),
        'labels' => $labels,
        'labels' => $labels,
        'supports' => $supports,
        'public' => true,
        'hierarchical' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'has_archive' => true,
        'can_export' => true,
        'exclude_from_search' => false,
        'yarpp_support' => true,
        'taxonomies' => array(
            'occupations'
        ),
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'register_meta_box_cb' => 'add_meta_boxes',
        'show_in_rest' => true,
    );

    register_post_type('employee', $args);
};

add_action('init', 'create_post_type');
?>
