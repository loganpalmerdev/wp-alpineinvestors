<?php

namespace Flynt\CustomTaxonomies;

function registerUpdateCategoryTaxonomy()
{
    $labels = [
        'name'                       => _x('Update Categories', 'Update Category General Name', 'flynt'),
        'singular_name'              => _x('Update Category', 'Update Category Singular Name', 'flynt'),
        'menu_name'                  => __('Update Category', 'flynt'),
        'all_items'                  => __('All Update Categories', 'flynt'),
        'parent_item'                => __('Parent Update Category', 'flynt'),
        'parent_item_colon'          => __('Parent Update Category:', 'flynt'),
        'new_item_name'              => __('New Update Category Name', 'flynt'),
        'add_new_item'               => __('Add New Update Category', 'flynt'),
        'edit_item'                  => __('Edit Update Category', 'flynt'),
        'update_item'                => __('Update Update Category', 'flynt'),
        'view_item'                  => __('View Update Category', 'flynt'),
        'separate_items_with_commas' => __('Separate Update Categories with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Update Categories', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Update Categories', 'flynt'),
        'search_items'               => __('Search Update Categories', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Update Categories', 'flynt'),
        'items_list'                 => __('Update Categories list', 'flynt'),
        'items_list_navigation'      => __('Update Categories list navigation', 'flynt'),
    ];
    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    ];

    register_taxonomy('update-category', ['update'], $args);
}

add_action('init', 'Flynt\\CustomTaxonomies\\registerUpdateCategoryTaxonomy');
