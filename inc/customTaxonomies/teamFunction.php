<?php

namespace Flynt\CustomTaxonomies;

function registerTeamFunctionTaxonomy()
{
    $labels = [
        'name'                       => _x('Team Functions', 'Team Function General Name', 'flynt'),
        'singular_name'              => _x('Team Function', 'Team Function Singular Name', 'flynt'),
        'menu_name'                  => __('Team Function', 'flynt'),
        'all_items'                  => __('All Team Functions', 'flynt'),
        'parent_item'                => __('Parent Team Function', 'flynt'),
        'parent_item_colon'          => __('Parent Team Function:', 'flynt'),
        'new_item_name'              => __('New Team Function Name', 'flynt'),
        'add_new_item'               => __('Add New Team Function', 'flynt'),
        'edit_item'                  => __('Edit Team Function', 'flynt'),
        'update_item'                => __('Update Team Function', 'flynt'),
        'view_item'                  => __('View Team Function', 'flynt'),
        'separate_items_with_commas' => __('Separate Team Functions with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Team Functions', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Team Functions', 'flynt'),
        'search_items'               => __('Search Team Functions', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Team Functions', 'flynt'),
        'items_list'                 => __('Team Functions list', 'flynt'),
        'items_list_navigation'      => __('Team Functions list navigation', 'flynt'),
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

    register_taxonomy('team-function', ['team'], $args);
}

add_action('init', 'Flynt\\CustomTaxonomies\\registerTeamFunctionTaxonomy');
