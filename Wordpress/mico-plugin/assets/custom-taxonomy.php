<?php
function mico_employee_taxonomy()
{

    $labels = array(
        'name' => _x('Occupations', 'taxonomy general name'),
        'singular_name' => _x('Occupation', 'taxonomy singular name'),
        'search_items' => __('Search Occupations'),
        'all_items' => __('All Occupations'),
        'parent_item' => __('Parent Occupation'),
        'parent_item_colon' => __('Parent Occupation:'),
        'edit_item' => __('Edit Occupation'),
        'update_item' => __('Update Occupation'),
        'add_new_item' => __('Add New Occupation'),
        'new_item_name' => __('New Type Occupation'),
        'menu_name' => __('Occupations')
    );

    register_taxonomy('occupations', array(
        'employee'
    ), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'occupation'
        )
    ));
}

add_action('init', 'mico_employee_taxonomy');
?>
