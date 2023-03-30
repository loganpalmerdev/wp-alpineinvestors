<?php

namespace Flynt\CustomPostTypes;

function registerPortfolioPostType()
{
    $labels = [
        'name'                  => _x('Portfolios', 'Portfolio General Name', 'flynt'),
        'singular_name'         => _x('Portfolio', 'Portfolio Singular Name', 'flynt'),
        'menu_name'             => __('Portfolios', 'flynt'),
        'name_admin_bar'        => __('Portfolio', 'flynt'),
        'archives'              => __('Portfolio Archives', 'flynt'),
        'attributes'            => __('Portfolio Attributes', 'flynt'),
        'parent_item_colon'     => __('Parent Portfolio:', 'flynt'),
        'all_items'             => __('All Portfolios', 'flynt'),
        'add_new_item'          => __('Add New Portfolio', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Portfolio', 'flynt'),
        'edit_item'             => __('Edit Portfolio', 'flynt'),
        'update_item'           => __('Update Portfolio', 'flynt'),
        'view_item'             => __('View Portfolio', 'flynt'),
        'view_items'            => __('View Portfolios', 'flynt'),
        'search_items'          => __('Search Portfolio', 'flynt'),
        'not_found'             => __('Not found', 'flynt'),
        'not_found_in_trash'    => __('Not found in Trash', 'flynt'),
        'featured_image'        => __('Featured Image', 'flynt'),
        'set_featured_image'    => __('Set featured image', 'flynt'),
        'remove_featured_image' => __('Remove featured image', 'flynt'),
        'use_featured_image'    => __('Use as featured image', 'flynt'),
        'insert_into_item'      => __('Insert into Portfolio', 'flynt'),
        'uploaded_to_this_item' => __('Uploaded to this Portfolio', 'flynt'),
        'items_list'            => __('Portfolios list', 'flynt'),
        'items_list_navigation' => __('Portfolios list navigation', 'flynt'),
        'filter_items_list'     => __('Filter Portfolios list', 'flynt'),
    ];
    $args = [
        'label'                 => __('Portfolio', 'flynt'),
        'description'           => __('Portfolio Description', 'flynt'),
        'labels'                => $labels,
        'supports'              => ['title'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => false,
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-portfolio',
    ];
    register_post_type('portfolio', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerPortfolioPostType');

function set_custom_edit_portfolio_columns($columns)
{
    return [
        'cb' => $columns['cb'],
        'logo' => 'Logo',
        'title' => $columns['title'],
        'service_type' => 'Service Type',
        'company_has_services' => 'Company which has these services',
        'taxonomy-portfolio-industry' => $columns['taxonomy-portfolio-industry'],
        'taxonomy-portfolio-status' => $columns['taxonomy-portfolio-status'],
        'taxonomy-portfolio-vertical' => $columns['taxonomy-portfolio-vertical'],
        'date' => $columns['date'],
    ];
}

add_filter('manage_portfolio_posts_columns', '\\Flynt\\CustomPostTypes\\set_custom_edit_portfolio_columns');

function custom_portfolio_column($column, $post_id)
{
    if ($column == 'logo') {
        $logo = get_field('logo', $post_id);
        if (!empty($logo)) {
            echo '<img src="' . $logo->src('full') . '" alt="' . $logo->alt . '" style="width: 150px;"/>';
        }
    } else if ($column == 'service_type') {
        echo get_field('service_type', $post_id);
    } else if ($column == 'company_has_services') {
        echo get_field('company_has_services', $post_id);
    }
}

add_action('manage_portfolio_posts_custom_column', '\\Flynt\\CustomPostTypes\\custom_portfolio_column', 10, 2);

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
        'key' => 'group_603245f003f41',
        'title' => 'Portfolio Metabox',
        'fields' => array(
            array(
                'key' => 'field_603245f708da9',
                'label' => 'Logo',
                'name' => 'logo',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_60332b1f2fa35',
                'label' => 'Service Type',
                'name' => 'service_type',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_60332b1f2fa36',
                'label' => 'Company which has these services',
                'name' => 'company_has_services',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_6032461008dab',
                'label' => 'Description',
                'name' => 'description',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'default',
                'media_upload' => 0,
                'delay' => 1,
            ),
            array(
                'key' => 'field_6032461008dbb',
                'label' => 'Link',
                'name' => 'link',
                'type' => 'link',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'portfolio',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
endif;
