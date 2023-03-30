<?php

namespace Flynt\Components\StoriesSection;

use Timber\Timber;
use Timber\Post;
use Timber\URLHelper;

function getACFLayout()
{
    return [
        'name' => 'storiesSection',
        'label' => 'Stories Section',
        'sub_fields' => [
        ]
    ];
}

add_filter('Flynt/addComponentData?name=StoriesSection', function ($data) {
    $data['story_type_terms'] = Timber::get_terms([
        'taxonomy' => 'story-type',
        'hide_empty' => false,
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ]);

    $data['story_sector_terms'] = Timber::get_terms([
        'taxonomy' => 'story-sector',
        'hide_empty' => false,
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ]);

    $posts_per_page = wp_is_mobile() ? 6 : 15;

    $args = [
        'post_type' => 'story',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ];
    
    $stories = Timber::get_posts($args);
    $story_counts = count($stories);
    $page_counts = round($story_counts / $posts_per_page + 0.45);

    $args = [
        'post_type' => 'story',
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish'
    ];
    $stories = Timber::get_posts($args);
    
    $data['stories'] = $stories;
    $data['page_counts'] = $page_counts;
    $data['posts_per_page'] = $posts_per_page;
    $data['page'] = 1;
    $data['nonce'] = wp_create_nonce('get_stories_nonce');
    
    $data['get_single_story_nonce'] = wp_create_nonce('get_single_story_nonce');

    $data['stories_page_url'] = URLHelper::get_current_url();

    if (isset($data['is_single_story']) && $data['is_single_story'] === true) {
        $data['stories_page_url'] = $data['stories_page']['url'];
    }

    return $data;
});

add_action('wp_ajax_get_stories', 'Flynt\Components\StoriesSection\getStoriesFunc');
add_action('wp_ajax_nopriv_get_stories', 'Flynt\Components\StoriesSection\getStoriesFunc');

function getStoriesFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'get_stories_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    $page = intval($_REQUEST['page']);
    $posts_per_page = intval($_REQUEST['postsPerPage']);
    $story_type = intval($_REQUEST['storyType']);
    $story_sector = intval($_REQUEST['storySector']);
    $story_search_key = $_REQUEST['storySearchKey'];

    $search_args = [];

    if (!empty($story_search_key)) {
        $search_args['s'] = $story_search_key;
    } else {
        if ($story_type > -1 && $story_sector > -1) {
            $search_args['tax_query'] = [
                'relation' => 'AND',
                [
                    'taxonomy' => 'story-sector',
                    'field'    => 'term_id',
                    'terms'    => $story_sector,
                ],
                [
                    'taxonomy' => 'story-type',
                    'field'    => 'term_id',
                    'terms'    => $story_type,
                ]
            ];
        } else if ($story_type < 0 && $story_sector > -1) {
            $search_args['tax_query'] = [
                [
                    'taxonomy' => 'story-sector',
                    'field'    => 'term_id',
                    'terms'    => $story_sector,
                ]
            ];
        } else if ($story_type > -1 && $story_sector < 0) {
            $search_args['tax_query'] = [
                [
                    'taxonomy' => 'story-type',
                    'field'    => 'term_id',
                    'terms'    => $story_type,
                ]
            ];
        }
    }

    $args = [
        'post_type' => 'story',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ];
    $args = array_merge($args, $search_args);
    $stories = Timber::get_posts($args);
    $story_counts = count($stories);
    $result['story_counts'] = $story_counts;

    $page_counts = round($story_counts / $posts_per_page + 0.45);
    $result['page_counts'] = $page_counts;

    $result['stories_html'] = '';
    
    $args = [
        'post_type' => 'story',
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'offset' => ($page - 1) * $posts_per_page,
    ];
    $args = array_merge($args, $search_args);
    $stories = Timber::get_posts($args);

    foreach ($stories as $story) {
        $result['stories_html'] .= Timber::compile('Partials/story-card.twig', ['story' => $story]);
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}

add_action('wp_ajax_get_single_story', 'Flynt\Components\StoriesSection\getSingleStoryFunc');
add_action('wp_ajax_nopriv_get_single_story', 'Flynt\Components\StoriesSection\getSingleStoryFunc');

function getSingleStoryFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'get_single_story_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    $postId = intval($_REQUEST['postId']);
    
    $story = new Post($postId);

    $result['single_story_title'] = $story->title;

    $result['single_story_html'] = '';

    if ($story->meta('template') === 'portfolio-spotlight') {
        $result['single_story_html'] = Timber::compile('Partials/single-story-portfolio-spotlight-template.twig', ['post' => $story]);
    } else {
        $result['single_story_html'] = Timber::compile('Partials/single-story-leadership-template.twig', ['post' => $story]);
    }

    $result['single_story_nav_html'] = Timber::compile('Partials/single-story-navigation.twig', ['prev_post_1' => $story->prev, 'prev_post_2' => $story->next]);

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}
