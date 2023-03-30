<?php

namespace Flynt\CustomTaxonomies;

function registerPortfolioVerticalTaxonomy()
{
    $labels = [
        'name'                       => _x('Portfolio Verticals', 'Portfolio Vertical General Name', 'flynt'),
        'singular_name'              => _x('Portfolio Vertical', 'Portfolio Vertical Singular Name', 'flynt'),
        'menu_name'                  => __('Portfolio Vertical', 'flynt'),
        'all_items'                  => __('All Portfolio Verticals', 'flynt'),
        'parent_item'                => __('Parent Portfolio Vertical', 'flynt'),
        'parent_item_colon'          => __('Parent Portfolio Vertical:', 'flynt'),
        'new_item_name'              => __('New Portfolio Vertical Name', 'flynt'),
        'add_new_item'               => __('Add New Portfolio Vertical', 'flynt'),
        'edit_item'                  => __('Edit Portfolio Vertical', 'flynt'),
        'update_item'                => __('Update Portfolio Vertical', 'flynt'),
        'view_item'                  => __('View Portfolio Vertical', 'flynt'),
        'separate_items_with_commas' => __('Separate Portfolio Verticals with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Portfolio Verticals', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Portfolio Verticals', 'flynt'),
        'search_items'               => __('Search Portfolio Verticals', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Portfolio Verticals', 'flynt'),
        'items_list'                 => __('Portfolio Verticals list', 'flynt'),
        'items_list_navigation'      => __('Portfolio Verticals list navigation', 'flynt'),
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

    register_taxonomy('portfolio-vertical', ['portfolio'], $args);
}

add_action('init', 'Flynt\\CustomTaxonomies\\registerPortfolioVerticalTaxonomy');
