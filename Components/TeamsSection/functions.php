<?php

namespace Flynt\Components\TeamsSection;

use Timber\Timber;
use Timber\Post;
use Timber\URLHelper;

function getACFLayout()
{
    return [
        'name' => 'teamsSection',
        'label' => 'Teams Section',
        'sub_fields' => [
        ]
    ];
}

add_filter('Flynt/addComponentData?name=TeamsSection', function ($data) {
    $data['team_industry_terms'] = Timber::get_terms([
        'taxonomy' => 'team-industry',
        'hide_empty' => false,
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ]);

    $data['team_function_terms'] = Timber::get_terms([
        'taxonomy' => 'team-function',
        'hide_empty' => false,
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ]);

    $args = [
        'post_type' => 'team',
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => 'team_type',
                'value' => 'alpine_team',
                'compare' => 'LIKE',
            ],
        ]
    ];
    
    $alpine_teams = Timber::get_posts($args);
    $data['alpine_teams'] = [];

    foreach ($alpine_teams as $team) {
        $term_team_industry_list = $team->terms('team-industry');
        $term_team_function_list = $team->terms('team-function');

        $class = '';
        foreach ($term_team_industry_list as $term) {
            $class .= ' ti' . $term->term_id;
        }

        foreach ($term_team_function_list as $term) {
            $class .= ' tf' . $term->term_id;
        }

        $data['alpine_teams'][] = [
            'post' => $team,
            'class' => $class
        ];
    }

    $args = [
        'post_type' => 'team',
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => 'team_type',
                'value' => 'portfolio_leaders',
                'compare' => 'LIKE',
            ],
        ]
    ];
    
    $portfolio_leaders = Timber::get_posts($args);
    $data['portfolio_leaders'] = [];

    foreach ($portfolio_leaders as $leader) {
        $data['portfolio_leaders'][] = [
            'post' => $leader,
            'class' => ''
        ];
    }

    $data['get_single_team_nonce'] = wp_create_nonce('get_single_team_nonce');
    $data['teams_page_url'] = URLHelper::get_current_url();

    if (isset($data['is_single_team']) && $data['is_single_team'] === true) {
        $data['teams_page_url'] = $data['teams_page']['url'];
    }

    return $data;
});

add_action('wp_ajax_get_single_team', 'Flynt\Components\TeamsSection\getSingleTeamFunc');
add_action('wp_ajax_nopriv_get_single_team', 'Flynt\Components\TeamsSection\getSingleTeamFunc');

function getSingleTeamFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'get_single_team_nonce')) {
        exit('No naughty business please');
    }

    $result = [];
    $postId = intval($_REQUEST['postId']);
    
    $team = new Post($postId);

    $result['single_team_html'] = Timber::compile('Partials/single-team-template.twig', ['post' => $team]);

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}
