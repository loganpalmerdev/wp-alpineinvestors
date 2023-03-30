<?php

namespace Flynt\CustomTaxonomies;

function registerPortfolioStatusTaxonomy()
{
    $labels = [
        'name'                       => _x('Portfolio Statuses', 'Portfolio Status General Name', 'flynt'),
        'singular_name'              => _x('Portfolio Status', 'Portfolio Status Singular Name', 'flynt'),
        'menu_name'                  => __('Portfolio Status', 'flynt'),
        'all_items'                  => __('All Portfolio Statuses', 'flynt'),
        'parent_item'                => __('Parent Portfolio Status', 'flynt'),
        'parent_item_colon'          => __('Parent Portfolio Status:', 'flynt'),
        'new_item_name'              => __('New Portfolio Status Name', 'flynt'),
        'add_new_item'               => __('Add New Portfolio Status', 'flynt'),
        'edit_item'                  => __('Edit Portfolio Status', 'flynt'),
        'update_item'                => __('Update Portfolio Status', 'flynt'),
        'view_item'                  => __('View Portfolio Status', 'flynt'),
        'separate_items_with_commas' => __('Separate Portfolio Statuses with commas', 'flynt'),
        'add_or_remove_items'        => __('Add or remove Portfolio Statuses', 'flynt'),
        'choose_from_most_used'      => __('Choose from the most used', 'flynt'),
        'popular_items'              => __('Popular Portfolio Statuses', 'flynt'),
        'search_items'               => __('Search Portfolio Statuses', 'flynt'),
        'not_found'                  => __('Not Found', 'flynt'),
        'no_terms'                   => __('No Portfolio Statuses', 'flynt'),
        'items_list'                 => __('Portfolio Statuses list', 'flynt'),
        'items_list_navigation'      => __('Portfolio Statuses list navigation', 'flynt'),
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

    register_taxonomy('portfolio-status', ['portfolio'], $args);
}

add_action('init', 'Flynt\\CustomTaxonomies\\registerPortfolioStatusTaxonomy');
