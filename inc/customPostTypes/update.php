<?php

namespace Flynt\CustomPostTypes;

function registerUpdatePostType()
{
    $labels = [
        'name'                  => _x('Updates', 'Post Type General Name', 'flynt'),
        'singular_name'         => _x('Update', 'Post Type Singular Name', 'flynt'),
        'menu_name'             => __('Updates', 'flynt'),
        'name_admin_bar'        => __('Update', 'flynt'),
        'archives'              => __('Update Archives', 'flynt'),
        'attributes'            => __('Update Attributes', 'flynt'),
        'parent_item_colon'     => __('Parent Update:', 'flynt'),
        'all_items'             => __('All Updates', 'flynt'),
        'add_new_item'          => __('Add New Update', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Update', 'flynt'),
        'edit_item'             => __('Edit Update', 'flynt'),
        'update_item'           => __('Update Update', 'flynt'),
        'view_item'             => __('View Update', 'flynt'),
        'view_items'            => __('View Updates', 'flynt'),
        'search_items'          => __('Search Update', 'flynt'),
        'not_found'             => __('Not found', 'flynt'),
        'not_found_in_trash'    => __('Not found in Trash', 'flynt'),
        'featured_image'        => __('Featured Image', 'flynt'),
        'set_featured_image'    => __('Set featured image', 'flynt'),
        'remove_featured_image' => __('Remove featured image', 'flynt'),
        'use_featured_image'    => __('Use as featured image', 'flynt'),
        'insert_into_item'      => __('Insert into update', 'flynt'),
        'uploaded_to_this_item' => __('Uploaded to this update', 'flynt'),
        'items_list'            => __('Updates list', 'flynt'),
        'items_list_navigation' => __('Updates list navigation', 'flynt'),
        'filter_items_list'     => __('Filter updates list', 'flynt'),
    ];
    $args = [
        'label'                 => __('Update', 'flynt'),
        'description'           => __('Update Description', 'flynt'),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'thumbnail'],
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
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-analytics',
    ];
    register_post_type('update', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerUpdatePostType');

function set_custom_edit_update_columns($columns)
{
    return [
        'cb' => $columns['cb'],
        'image' => 'Featured Image',
        'title' => $columns['title'],
        'date_caption' => 'Date Caption',
        'taxonomy-update-category' => 'Update Categories',
        'date' => $columns['date'],
    ];
}

add_filter('manage_update_posts_columns', '\\Flynt\\CustomPostTypes\\set_custom_edit_update_columns');

function custom_update_column($column, $post_id)
{
    if ($column == 'image') {
        $image_url = get_the_post_thumbnail_url($post_id, 'full');
        if (!empty($image_url)) {
            echo '<img src="' . $image_url . '" alt="featured image" style="width: 150px;"/>';
        }
    } else if ($column == 'date_caption') {
        echo get_field('date_caption', $post_id);
    }
}

add_action('manage_update_posts_custom_column', '\\Flynt\\CustomPostTypes\\custom_update_column', 10, 2);

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
        'key' => 'group_602d403b934a3',
        'title' => 'Update Metabox',
        'fields' => array(
            array(
                'key' => 'field_602d40413242d',
                'label' => 'Date Caption',
                'name' => 'date_caption',
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
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'update',
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
