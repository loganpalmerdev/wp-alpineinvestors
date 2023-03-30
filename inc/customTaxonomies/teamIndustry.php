<?php

namespace Flynt\CustomTaxonomies;

function registerTeamIndustryTaxonomy()
{
    $labels = [
        'name'                       => _x('Team Industries', 'Team Industry General Name', 'flynt'),
        'singular_name'              => _x('Team Industry', 'Team Industry Singular Name', 'flynt'),
        'menu_name'                  => __('Team Industry', 'flynt'),
        'all_items'                  => __('All Team Industries', 'flynt'),
        'parent_item'                => __('Parent Team Industry', 'flynt'),
        'parent_item_colon'          => __('Parent Team Industry:', 'flynt'),
        'new_item_name'              => __('New Team Industry Name', 'flynt'),
        'add_new_item'               => __('Add New Team Industry', 'flynt'),
        'edit_item'                  => __('Edit Team Industry', 'flynt'),
        'update_item'                => __('Update Team Industry', 'flynt'),
        'view_item'                  => __('View Team Industry', 'flynt'),
        'separate_items_with_commas' => __('Separate Team Industries with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Team Industries', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Team Industries', 'flynt'),
        'search_items'               => __('Search Team Industries', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Team Industries', 'flynt'),
        'items_list'                 => __('Team Industries list', 'flynt'),
        'items_list_navigation'      => __('Team Industries list navigation', 'flynt'),
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

    register_taxonomy('team-industry', ['team'], $args);
}

add_action('init', 'Flynt\\CustomTaxonomies\\registerTeamIndustryTaxonomy');
