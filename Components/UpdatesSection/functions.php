<?php

namespace Flynt\Components\UpdatesSection;

use Timber\Timber;
use Timber\Post;
use Timber\URLHelper;

function getACFLayout()
{
    return [
        'name' => 'updatesSection',
        'label' => 'Updates Section',
        'sub_fields' => [

        ]
    ];
}

add_filter('Flynt/addComponentData?name=UpdatesSection', function ($data) {
    $data['update_category_terms'] = Timber::get_terms([
        'taxonomy' => 'update-category',
        'hide_empty' => false,
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ]);

    $args = [
        'post_type' => 'update',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ];
    
    $updates = Timber::get_posts($args);
    $data['updates'] = [];

    foreach ($updates as $update) {
        $term_update_category_list = get_the_terms($update->ID, 'update-category');

        $class = '';

        if ($term_update_category_list) {
            foreach ($term_update_category_list as $term) {
                $class .= ' uc' . $term->term_id;
            }
        }

        $data['updates'][] = [
            'post' => $update,
            'class' => $class
        ];
    }

    $data['get_single_update_nonce'] = wp_create_nonce('get_single_update_nonce');
    $data['updates_page_url'] = URLHelper::get_current_url();

    if (isset($data['is_single_update']) && $data['is_single_update'] === true) {
        $data['updates_page_url'] = $data['updates_page']['url'];
    }
    
    return $data;
});

add_action('wp_ajax_get_single_update', 'Flynt\Components\UpdatesSection\getSingleUpdateFunc');
add_action('wp_ajax_nopriv_get_single_update', 'Flynt\Components\UpdatesSection\getSingleUpdateFunc');

function getSingleUpdateFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'get_single_update_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    $postId = intval($_REQUEST['postId']);
    
    $update = new Post($postId);

    $result['single_update_html'] = Timber::compile('Partials/single-update-template.twig', ['post' => $update]);

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}
