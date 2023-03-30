<?php

namespace Flynt\CustomTaxonomies;

function registerStorySectorTaxonomy()
{
    $labels = [
        'name'                       => _x('Story Sectors', 'Story Sector General Name', 'flynt'),
        'singular_name'              => _x('Story Sector', 'Story Sector Singular Name', 'flynt'),
        'menu_name'                  => __('Story Sector', 'flynt'),
        'all_items'                  => __('All Story Sectors', 'flynt'),
        'parent_item'                => __('Parent Story Sector', 'flynt'),
        'parent_item_colon'          => __('Parent Story Sector:', 'flynt'),
        'new_item_name'              => __('New Story Sector Name', 'flynt'),
        'add_new_item'               => __('Add New Story Sector', 'flynt'),
        'edit_item'                  => __('Edit Story Sector', 'flynt'),
        'update_item'                => __('Update Story Sector', 'flynt'),
        'view_item'                  => __('View Story Sector', 'flynt'),
        'separate_items_with_commas' => __('Separate Story Sectors with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Story Sectors', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Story Sectors', 'flynt'),
        'search_items'               => __('Search Story Sectors', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Story Sectors', 'flynt'),
        'items_list'                 => __('Story Sectors list', 'flynt'),
        'items_list_navigation'      => __('Story Sectors list navigation', 'flynt'),
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

    register_taxonomy('story-sector', ['story'], $args);
}

add_action('init', 'Flynt\\CustomTaxonomies\\registerStorySectorTaxonomy');
