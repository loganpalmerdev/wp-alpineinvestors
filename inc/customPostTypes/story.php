<?php

namespace Flynt\CustomPostTypes;

function registerStoryPostType()
{
    $labels = [
        'name'                  => _x('Stories', 'Story General Name', 'flynt'),
        'singular_name'         => _x('Story', 'Story Singular Name', 'flynt'),
        'menu_name'             => __('Stories', 'flynt'),
        'name_admin_bar'        => __('Story', 'flynt'),
        'archives'              => __('Story Archives', 'flynt'),
        'attributes'            => __('Story Attributes', 'flynt'),
        'parent_item_colon'     => __('Parent Story:', 'flynt'),
        'all_items'             => __('All Stories', 'flynt'),
        'add_new_item'          => __('Add New Story', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Story', 'flynt'),
        'edit_item'             => __('Edit Story', 'flynt'),
        'update_item'           => __('Update Story', 'flynt'),
        'view_item'             => __('View Story', 'flynt'),
        'view_items'            => __('View Stories', 'flynt'),
        'search_items'          => __('Search Story', 'flynt'),
        'not_found'             => __('Not found', 'flynt'),
        'not_found_in_trash'    => __('Not found in Trash', 'flynt'),
        'featured_image'        => __('Featured Image', 'flynt'),
        'set_featured_image'    => __('Set featured image', 'flynt'),
        'remove_featured_image' => __('Remove featured image', 'flynt'),
        'use_featured_image'    => __('Use as featured image', 'flynt'),
        'insert_into_item'      => __('Insert into Story', 'flynt'),
        'uploaded_to_this_item' => __('Uploaded to this Story', 'flynt'),
        'items_list'            => __('Stories list', 'flynt'),
        'items_list_navigation' => __('Stories list navigation', 'flynt'),
        'filter_items_list'     => __('Filter Stories list', 'flynt'),
    ];
    $args = [
        'label'                 => __('Story', 'flynt'),
        'description'           => __('Story Description', 'flynt'),
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
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-book',
    ];
    register_post_type('story', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerStoryPostType');

function set_custom_edit_story_columns($columns)
{
    return [
        'cb' => $columns['cb'],
        'avatar' => 'Avatar',
        'title' => $columns['title'],
        'role' => 'Role',
        'taxonomy-story-sector' => $columns['taxonomy-story-sector'],
        'taxonomy-story-type' => $columns['taxonomy-story-type'],
        'date' => $columns['date'],
    ];
}

add_filter('manage_story_posts_columns', '\\Flynt\\CustomPostTypes\\set_custom_edit_story_columns');

function custom_story_column($column, $post_id)
{
    if ($column == 'avatar') {
        $user_avatar = get_field('avatar', $post_id);
        if (!empty($user_avatar)) {
            echo '<img src="' . $user_avatar->src('thumbnail') . '" alt="' . $user_avatar->alt . '"/>';
        }
    } else if ($column == 'role') {
        echo get_field('role', $post_id);
    }
}

add_action('manage_story_posts_custom_column', '\\Flynt\\CustomPostTypes\\custom_story_column', 10, 2);

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
        'key' => 'group_5fcbeb0d12d10',
        'title' => 'Story Metabox',
        'fields' => array(
            array(
                'key' => 'field_6022b0b0b40c2',
                'label' => 'Template',
                'name' => 'template',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'leadership' => 'Leadership',
                    'portfolio-spotlight' => 'Portfolio Spotlight',
                ),
                'default_value' => 'leadership',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5fcbeb86b4aa1',
                'label' => 'Avatar (Retina Version 2x)',
                'name' => 'avatar',
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
                'key' => 'field_5fcbeb211a51f',
                'label' => 'Role',
                'name' => 'role',
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
                'key' => 'field_6022b0840e7dd',
                'label' => 'Year of Investment',
                'name' => 'year_of_investment',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_6022b0b0b40c2',
                            'operator' => '==',
                            'value' => 'portfolio-spotlight',
                        ),
                    ),
                ),
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
                'key' => 'field_6022b606719d8',
                'label' => 'Portfolio Status',
                'name' => 'portfolio_status',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_6022b0b0b40c2',
                            'operator' => '==',
                            'value' => 'portfolio-spotlight',
                        ),
                    ),
                ),
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
                'key' => 'field_6022b610719d9',
                'label' => 'CEO',
                'name' => 'ceo',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_6022b0b0b40c2',
                            'operator' => '==',
                            'value' => 'portfolio-spotlight',
                        ),
                    ),
                ),
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
                'key' => 'field_6022b617719da',
                'label' => 'Headquarters',
                'name' => 'headquarters',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_6022b0b0b40c2',
                            'operator' => '==',
                            'value' => 'portfolio-spotlight',
                        ),
                    ),
                ),
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
                'key' => 'field_6022b843b83d0',
                'label' => 'Website',
                'name' => 'website',
                'type' => 'link',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_6022b0b0b40c2',
                            'operator' => '==',
                            'value' => 'portfolio-spotlight',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_6022b650719dc',
                'label' => 'Industry',
                'name' => 'industry',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_6022b0b0b40c2',
                            'operator' => '==',
                            'value' => 'portfolio-spotlight',
                        ),
                    ),
                ),
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
                'key' => 'field_5fdc53232d490',
                'label' => 'Content',
                'name' => 'content',
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
                'media_upload' => 1,
                'delay' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'story',
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
