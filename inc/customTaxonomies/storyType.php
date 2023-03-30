<?php

namespace Flynt\CustomTaxonomies;

function registerStoryTypeTaxonomy()
{
    $labels = [
        'name'                       => _x('Story Types', 'Story Type General Name', 'flynt'),
        'singular_name'              => _x('Story Type', 'Story Type Singular Name', 'flynt'),
        'menu_name'                  => __('Story Type', 'flynt'),
        'all_items'                  => __('All Story Types', 'flynt'),
        'parent_item'                => __('Parent Story Type', 'flynt'),
        'parent_item_colon'          => __('Parent Story Type:', 'flynt'),
        'new_item_name'              => __('New Story Type Name', 'flynt'),
        'add_new_item'               => __('Add New Story Type', 'flynt'),
        'edit_item'                  => __('Edit Story Type', 'flynt'),
        'update_item'                => __('Update Story Type', 'flynt'),
        'view_item'                  => __('View Story Type', 'flynt'),
        'separate_items_with_commas' => __('Separate Story Types with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Story Types', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Story Types', 'flynt'),
        'search_items'               => __('Search Story Types', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Story Types', 'flynt'),
        'items_list'                 => __('Story Types list', 'flynt'),
        'items_list_navigation'      => __('Story Types list navigation', 'flynt'),
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

    register_taxonomy('story-type', ['story'], $args);
}

add_action('init', 'Flynt\\CustomTaxonomies\\registerStoryTypeTaxonomy');
