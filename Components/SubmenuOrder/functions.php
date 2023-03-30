<?php

/**
 * Creating wordpress submenu to re-order by drag & drop for custom posts and custom taxonomy
 * custom post type : portfolio, story, team, update
 * custom taxonomy : portfolio-industry, portfolio-status, portfolio-vertical, story-sector, story-type, team-function, team-industry, update-category
 */

namespace Flynt\Components\SubmenuOrder;

use Timber\Timber;
use Flynt\Utils\TimberDynamicResize;
use Flynt\Utils\Asset;

add_action('admin_enqueue_scripts', function ($hook) {
    if (
        in_array(
            $hook,
            [
                'portfolio_page_reorder-portfolio-industry',
                'portfolio_page_reorder-portfolio-status',
                'portfolio_page_reorder-portfolio-vertical',
                'story_page_reorder-story-sector',
                'story_page_reorder-story-type',
                'team_page_reorder-team-function',
                'team_page_reorder-team-industry',
                'update_page_reorder-update-category',
                'story_page_reorder-stories',
                'portfolio_page_reorder-portfolios',
                'team_page_reorder-teams'
            ]
        )
    ) {
        Asset::enqueue([
            'name' => 'Flynt/assets/submenuOrder',
            'path' => 'assets/submenuOrder.js',
            'type' => 'script',
            'inFooter' => true,
        ]);

        $data = [
            'ajaxurl' => admin_url('admin-ajax.php'),
        ];
        wp_localize_script('Flynt/assets/submenuOrder', 'SubmenuOrderData', $data);

        Asset::enqueue([
            'name' => 'Flynt/assets/submenuOrder',
            'path' => 'assets/submenuOrder.css',
            'type' => 'style'
        ]);
    }
});

function submenuOrderPage()
{
    $submenuPage = [
        [
            'parent_slug' => 'edit.php?post_type=portfolio',
            'title' => 'Reorder Portfolio Industry',
            'menu_slug' => 'reorder-portfolio-industry',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPagePortfolioIndustry',
        ],
        [
            'parent_slug' => 'edit.php?post_type=portfolio',
            'title' => 'Reorder Portfolio Status',
            'menu_slug' => 'reorder-portfolio-status',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPagePortfolioStatus',
        ],
        [
            'parent_slug' => 'edit.php?post_type=portfolio',
            'title' => 'Reorder Portfolio Vertical',
            'menu_slug' => 'reorder-portfolio-vertical',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPagePortfolioVertical',
        ],
        [
            'parent_slug' => 'edit.php?post_type=story',
            'title' => 'Reorder Story Sector',
            'menu_slug' => 'reorder-story-sector',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPageStorySector',
        ],
        [
            'parent_slug' => 'edit.php?post_type=story',
            'title' => 'Reorder Story Type',
            'menu_slug' => 'reorder-story-type',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPageStoryType',
        ],
        [
            'parent_slug' => 'edit.php?post_type=team',
            'title' => 'Reorder Team Function',
            'menu_slug' => 'reorder-team-function',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPageTeamFunction',
        ],
        [
            'parent_slug' => 'edit.php?post_type=team',
            'title' => 'Reorder Team Industry',
            'menu_slug' => 'reorder-team-industry',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPageTeamIndustry',
        ],
        [
            'parent_slug' => 'edit.php?post_type=update',
            'title' => 'Reorder Update Category',
            'menu_slug' => 'reorder-update-category',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPageUpdateCategory',
        ],
        [
            'parent_slug' => 'edit.php?post_type=story',
            'title' => 'Reorder Stories',
            'menu_slug' => 'reorder-stories',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPageStories',
        ],
        [
            'parent_slug' => 'edit.php?post_type=portfolio',
            'title' => 'Reorder Portfolios',
            'menu_slug' => 'reorder-portfolios',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPagePortfolios',
        ],
        [
            'parent_slug' => 'edit.php?post_type=team',
            'title' => 'Reorder Teams',
            'menu_slug' => 'reorder-teams',
            'function' => '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPageTeams',
        ]
    ];

    foreach ($submenuPage as $page) {
        add_submenu_page(
            $page['parent_slug'],
            $page['title'],
            $page['title'],
            'manage_options',
            $page['menu_slug'],
            $page['function'],
        );
    }
}
add_action('admin_menu', '\\Flynt\\Components\\SubmenuOrder\\submenuOrderPage');

function submenuOrderPagePortfolioIndustry()
{
    submenuOrderPageHTML('portfolio-industry', 'taxonomy');
}

function submenuOrderPagePortfolioStatus()
{
    submenuOrderPageHTML('portfolio-status', 'taxonomy');
}

function submenuOrderPagePortfolioVertical()
{
    submenuOrderPageHTML('portfolio-vertical', 'taxonomy');
}

function submenuOrderPageStorySector()
{
    submenuOrderPageHTML('story-sector', 'taxonomy');
}

function submenuOrderPageStoryType()
{
    submenuOrderPageHTML('story-type', 'taxonomy');
}

function submenuOrderPageTeamFunction()
{
    submenuOrderPageHTML('team-function', 'taxonomy');
}

function submenuOrderPageTeamIndustry()
{
    submenuOrderPageHTML('team-industry', 'taxonomy');
}

function submenuOrderPageUpdateCategory()
{
    submenuOrderPageHTML('update-category', 'taxonomy');
}

function submenuOrderPageStories()
{
    submenuOrderPageHTML('story', 'post');
}

function submenuOrderPagePortfolios()
{
    submenuOrderPageHTML('portfolio', 'post');
}

function submenuOrderPageTeams()
{
    submenuOrderPageHTML('team', 'post');
}

function submenuOrderPageHTML($slug, $type)
{
    // check user capabilities
    if (! current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <div id="submenu-order-main" data-get-nonce="<?php echo wp_create_nonce("get_submenu_order_nonce"); ?>" data-slug="<?php echo $slug; ?>" data-type="<?php echo $type; ?>" data-set-nonce="<?php echo wp_create_nonce("set_submenu_order_nonce"); ?>"></div>
    </div>
    <?php
}

add_action('wp_ajax_set_submenu_order', '\\Flynt\\Components\\SubmenuOrder\\setSubmenuOrderFunc');
add_action('wp_ajax_nopriv_set_submenu_order', '\\Flynt\\Components\\SubmenuOrder\\setSubmenuOrderFunc');

function setSubmenuOrderFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'set_submenu_order_nonce')) {
        exit('No naughty business please');
    }
    
    $slug = $_REQUEST['slug'];
    $type = $_REQUEST['type'];
    
    // id(post id or term id) list, this list item order is equal to the display order
    $list = json_decode(stripslashes($_REQUEST['list']));
    
    $result = ['done'];
    // $result['slug'] = $slug;
    // $result['type'] = $type;
    // $result['list'] = $list;

    if ($type === 'post') {
        $max_order_number = count($list);

        // by following meta value, the first place post will have the largest ai_display_order value
        foreach ($list as $order => $item) {
            update_post_meta($item, 'ai_display_order', $max_order_number - $order);
        }
    } else if ($type === 'taxonomy') {
        $max_order_number = count($list);

        // by following meta value, the first place term will have the largest ai_display_order value
        foreach ($list as $order => $item) {
            update_term_meta($item, 'ai_display_order', $max_order_number - $order);
        }
    }

    $result = json_encode($result);
    echo $result;

    die();
}

add_action('wp_ajax_get_submenu_order', '\\Flynt\\Components\\SubmenuOrder\\getSubmenuOrderFunc');
add_action('wp_ajax_nopriv_get_submenu_order', '\\Flynt\\Components\\SubmenuOrder\\getSubmenuOrderFunc');

function getSubmenuOrderFunc()
{
    if (!wp_verify_nonce($_REQUEST['nonce'], 'get_submenu_order_nonce')) {
        exit('No naughty business please');
    }

    $slug = $_REQUEST['slug'];
    $type = $_REQUEST['type'];

    $result = [
        'list' => []
    ];

    if ($type === 'taxonomy') {
        $list = Timber::get_terms([
            'taxonomy' => $slug,
            'hide_empty' => false,
            'meta_key' => 'ai_display_order',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
        ]);

        // when the post was created, that post didn't have the 'ai_display_order' meta value
        // by the above reason, that new post can't display by the above query selector
        // for that case, the following is need.
        $list = array_merge(
            $list,
            Timber::get_terms([
                'taxonomy' => $slug,
                'hide_empty' => false,
                'meta_query' => [
                    [
                        'key' => 'ai_display_order',
                        'compare' => 'NOT EXISTS',
                        'value' => ''
                    ]
                ],
                'orderby' => 'date',
                'order' => 'DESC'
            ])
        );

        foreach ($list as $item) {
            $result['list'][] = [
                'id' => $item->term_id,
                'title' => $item->name,
            ];
        }
    } else if ($type === 'post') {
        $list = Timber::get_posts([
            'post_type' => $slug,
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'meta_key' => 'ai_display_order',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
        ]);

        // when the post was created, that post didn't have the 'ai_display_order' meta value
        // by the above reason, that new post can't display by the above query selector
        // for that case, the following is need.
        $list = array_merge(
            $list,
            Timber::get_posts([
                'post_type' => $slug,
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_query' => [
                    [
                        'key' => 'ai_display_order',
                        'compare' => 'NOT EXISTS',
                        'value' => ''
                    ]
                ],
                'orderby' => 'date',
                'order' => 'DESC'
            ])
        );

        foreach ($list as $item) {
            $temp = [
                'id' => $item->ID,
                'title' => $item->post_title,
            ];

            if ($slug === 'portfolio') {
                $timberDynamicResize = new TimberDynamicResize();
                $temp['image'] = $timberDynamicResize->resizeDynamic($item->meta('logo')->src, 150);
            } else if ($slug === 'story') {
                $timberDynamicResize = new TimberDynamicResize();
                $temp['image'] = $timberDynamicResize->resizeDynamic($item->meta('avatar')->src, 150);
            } else if ($slug === 'team') {
                $timberDynamicResize = new TimberDynamicResize();
                $temp['image'] = $timberDynamicResize->resizeDynamic($item->meta('avatar_1')->src, 150);
            }

            $result['list'][] = $temp;
        }
    }

    $result = json_encode($result);
    echo $result;

    die();
}

/**
 * when Portfolio, Story and Team are created, add 'ai_display_order' meta : -1
 */

add_action('save_post', '\\Flynt\\Components\\SubmenuOrder\\savePostAiDisplayOrderFunc', 10, 3);
function savePostAiDisplayOrderFunc($post_id, $post, $update)
{
    // Only want to set if this is a new post!
    if ($update) {
        return;
    }

    $order = get_post_meta($post_id, 'ai_display_order', true);
    if (empty($order)) {
        add_post_meta($post_id, 'ai_display_order', 0);
    }
}

add_action('saved_term', '\\Flynt\\Components\\SubmenuOrder\\saveTaxonomyAiDisplayOrderFunc', 10, 4);
function saveTaxonomyAiDisplayOrderFunc($term_id, $tt_id, $taxonomy, $update)
{
    // Only want to set if this is a new post!
    if ($update) {
        return;
    }

    $order = get_term_meta($term_id, 'ai_display_order', true);
    if (empty($order)) {
        add_term_meta($term_id, 'ai_display_order', 0);
    }
}
