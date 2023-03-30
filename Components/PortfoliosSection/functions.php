<?php

namespace Flynt\Components\PortfoliosSection;

use Timber;

function getACFLayout()
{
    return [
        'name' => 'PortfoliosSection',
        'label' => 'Portfolios Section',
        'sub_fields' => [
            [
                'label' => 'Footer Content',
                'name' => 'footer_content',
                'type' => 'wysiwyg',
                'delay' => 1,
                'media_upload' => 0,
                'wrapper' => [
                    'class' => 'autosize',
                ],
            ],
        ]
    ];
}

add_filter('Flynt/addComponentData?name=PortfoliosSection', function ($data) {
    $data['portfolio_status_terms'] = Timber::get_terms([
        'taxonomy' => 'portfolio-status',
        'hide_empty' => false,
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ]);

    $data['portfolio_industry_terms'] = Timber::get_terms([
        'taxonomy' => 'portfolio-industry',
        'hide_empty' => false,
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ]);

    $data['portfolio_vertical_terms'] = Timber::get_terms([
        'taxonomy' => 'portfolio-vertical',
        'hide_empty' => false,
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    ]);

    $args = [
        'post_type' => 'portfolio',
        'meta_key' => 'ai_display_order',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ];
    
    $portfolios = Timber::get_posts($args);
    $data['portfolios'] = [];

    foreach ($portfolios as $portfolio) {
        $term_portfolio_status_list = $portfolio->terms('portfolio-status');
        $term_portfolio_industry_list = $portfolio->terms('portfolio-industry');
        $term_portfolio_vertical_list = $portfolio->terms('portfolio-vertical');

        $class = '';
        foreach ($term_portfolio_status_list as $term) {
            $class .= ' ps' . $term->term_id;
        }

        foreach ($term_portfolio_industry_list as $term) {
            $class .= ' pi' . $term->term_id;
        }

        foreach ($term_portfolio_vertical_list as $term) {
            $class .= ' pv' . $term->term_id;
        }

        $data['portfolios'][] = [
            'post' => $portfolio,
            'class' => $class
        ];
    }


    return $data;
});
