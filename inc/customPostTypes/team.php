<?php

namespace Flynt\CustomPostTypes;

function registerTeamPostType()
{
    $labels = [
        'name'                  => _x('Teams', 'Team General Name', 'flynt'),
        'singular_name'         => _x('Team', 'Team Singular Name', 'flynt'),
        'menu_name'             => __('Teams', 'flynt'),
        'name_admin_bar'        => __('Team', 'flynt'),
        'archives'              => __('Team Archives', 'flynt'),
        'attributes'            => __('Team Attributes', 'flynt'),
        'parent_item_colon'     => __('Parent Team:', 'flynt'),
        'all_items'             => __('All Teams', 'flynt'),
        'add_new_item'          => __('Add New Team', 'flynt'),
        'add_new'               => __('Add New', 'flynt'),
        'new_item'              => __('New Team', 'flynt'),
        'edit_item'             => __('Edit Team', 'flynt'),
        'update_item'           => __('Update Team', 'flynt'),
        'view_item'             => __('View Team', 'flynt'),
        'view_items'            => __('View Teams', 'flynt'),
        'search_items'          => __('Search Team', 'flynt'),
        'not_found'             => __('Not found', 'flynt'),
        'not_found_in_trash'    => __('Not found in Trash', 'flynt'),
        'featured_image'        => __('Featured Image', 'flynt'),
        'set_featured_image'    => __('Set featured image', 'flynt'),
        'remove_featured_image' => __('Remove featured image', 'flynt'),
        'use_featured_image'    => __('Use as featured image', 'flynt'),
        'insert_into_item'      => __('Insert into Team', 'flynt'),
        'uploaded_to_this_item' => __('Uploaded to this Team', 'flynt'),
        'items_list'            => __('Teams list', 'flynt'),
        'items_list_navigation' => __('Teams list navigation', 'flynt'),
        'filter_items_list'     => __('Filter Teams list', 'flynt'),
    ];
    $args = [
        'label'                 => __('Team', 'flynt'),
        'description'           => __('Team Description', 'flynt'),
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
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-groups',
    ];
    register_post_type('team', $args);
}

add_action('init', '\\Flynt\\CustomPostTypes\\registerTeamPostType');

function set_custom_edit_team_columns($columns)
{
    return [
        'cb' => $columns['cb'],
        'avatar' => 'Avatar',
        'title' => $columns['title'],
        'team_type' => 'Team Type',
        'taxonomy-team-function' => $columns['taxonomy-team-function'],
        'taxonomy-team-industry' => $columns['taxonomy-team-industry'],
        'date' => $columns['date'],
    ];
}

add_filter('manage_team_posts_columns', '\\Flynt\\CustomPostTypes\\set_custom_edit_team_columns');

function custom_team_column($column, $post_id)
{
    if ($column == 'avatar') {
        $avatar = get_field('avatar_1', $post_id);
        if (!empty($avatar)) {
            echo '<img src="' . $avatar->src('full') . '" alt="' . $avatar->alt . '" style="width: 150px;"/>';
        }
    } else if ($column == 'team_type') {
        $field = get_field_object('team_type');
        $value = get_field('team_type', $post_id);
        
        echo $field['choices'][ $value ];
    }
}

add_action('manage_team_posts_custom_column', '\\Flynt\\CustomPostTypes\\custom_team_column', 10, 2);

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
        'key' => 'group_6033cf92ba95d',
        'title' => 'Team Metabox',
        'fields' => array(
            array(
                'key' => 'field_6041022c8b981',
                'label' => 'Team Type',
                'name' => 'team_type',
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
                    'alpine_team' => 'Alpine Team',
                    'portfolio_leaders' => 'Portfolio leaders',
                ),
                'default_value' => 'alpine_team',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_6033cfa7348a3',
                'label' => 'Avatar 1',
                'name' => 'avatar_1',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
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
                'key' => 'field_6033cfb8348a4',
                'label' => 'Avatar 2',
                'name' => 'avatar_2',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
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
                'key' => 'field_6033cfc1347a5',
                'label' => 'Display Name',
                'name' => 'display_name',
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
                'key' => 'field_6033cfc1348a5',
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
                'key' => 'field_6033cfca348a6',
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
                'key' => 'field_6033cfdf348a7',
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
            array(
                'key' => 'field_6033cffb348a8',
                'label' => 'First Job',
                'name' => 'first_job',
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
                'key' => 'field_6033d003348a9',
                'label' => 'Favorite activity',
                'name' => 'favorite_activity',
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
                'key' => 'field_6033d009348aa',
                'label' => 'Proudest Moment',
                'name' => 'proudest_moment',
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
                'key' => 'field_6033d00d348ab',
                'label' => 'Most Admired "Giant" of Business',
                'name' => 'most_admired_giant_of_business',
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
                'key' => 'field_6033d024348ac',
                'label' => 'Favorite Quote',
                'name' => 'favorite_quote',
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
                'key' => 'field_6033d024348ad',
                'label' => 'Legal Copy',
                'name' => 'legal_copy',
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
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'team',
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
