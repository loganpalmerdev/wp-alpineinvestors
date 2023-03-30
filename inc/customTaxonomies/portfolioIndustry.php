<?php

namespace Flynt\CustomTaxonomies;

function registerPortfolioIndustryTaxonomy()
{
    $labels = [
        'name'                       => _x('Portfolio Industries', 'Portfolio Industry General Name', 'flynt'),
        'singular_name'              => _x('Portfolio Industry', 'Portfolio Industry Singular Name', 'flynt'),
        'menu_name'                  => __('Portfolio Industry', 'flynt'),
        'all_items'                  => __('All Portfolio Industries', 'flynt'),
        'parent_item'                => __('Parent Portfolio Industry', 'flynt'),
        'parent_item_colon'          => __('Parent Portfolio Industry:', 'flynt'),
        'new_item_name'              => __('New Portfolio Industry Name', 'flynt'),
        'add_new_item'               => __('Add New Portfolio Industry', 'flynt'),
        'edit_item'                  => __('Edit Portfolio Industry', 'flynt'),
        'update_item'                => __('Update Portfolio Industry', 'flynt'),
        'view_item'                  => __('View Portfolio Industry', 'flynt'),
        'separate_items_with_commas' => __('Separate Portfolio Industries with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Portfolio Industries', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Portfolio Industries', 'flynt'),
        'search_items'               => __('Search Portfolio Industries', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Portfolio Industries', 'flynt'),
        'items_list'                 => __('Portfolio Industries list', 'flynt'),
        'items_list_navigation'      => __('Portfolio Industries list navigation', 'flynt'),
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

    register_taxonomy('portfolio-industry', ['portfolio'], $args);
}

add_action('init', 'Flynt\\CustomTaxonomies\\registerPortfolioIndustryTaxonomy');
