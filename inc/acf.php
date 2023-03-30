<?php

namespace Flynt\Acf;

use Flynt\Utils\Options;

add_filter('pre_http_request', function ($preempt, $args, $url) {
    if (strpos($url, 'https://www.youtube.com/oembed') !== false || strpos($url, 'https://vimeo.com/api/oembed') !== false) {
        $response = wp_cache_get($url, 'oembedCache');
        if (!empty($response)) {
            return $response;
        }
    }
    return false;
}, 10, 3);

add_filter('http_response', function ($response, $args, $url) {
    if (strpos($url, 'https://www.youtube.com/oembed') !== false || strpos($url, 'https://vimeo.com/api/oembed') !== false) {
        wp_cache_set($url, $response, 'oembedCache');
    }
    return $response;
}, 10, 3);

add_filter('acf/fields/google_map/api', function ($api) {
    $apiKey = Options::getGlobal('Acf', 'googleMapsApiKey');
    if ($apiKey) {
        $api['key'] = $apiKey;
    }
    return $api;
});

Options::addGlobal('Acf', [
    [
        'name' => 'googleMapsApiKey',
        'label' => __('Google Maps Api Key', 'flynt'),
        'type' => 'text',
        'maxlength' => 100,
        'prepend' => '',
        'append' => '',
        'placeholder' => ''
    ]
]);

Options::addGlobal('Website Settings', [
    [
        'label' => 'Website Scripts',
        'name' => 'website_scripts',
        'type' => 'group',
        'layout' => 'row',
        'sub_fields' => [
            [
                'label' => 'Run tracking scripts?',
                'name' => 'run_tracking_scripts',
                'type' => 'true_false',
                'ui' => true,
                'ui_on_text' => 'Yes',
                'ui_off_text' => 'No',
            ],
            [
                'label' => 'Before head closing tag',
                'name' => 'before_head_closing_tag',
                'type' => 'textarea',
                'default_value' => '',
            ],
            [
                'label' => 'After body opening tag',
                'name' => 'after_body_opening_tag',
                'type' => 'textarea',
                'default_value' => '',
            ],
            [
                'label' => 'Before body closing tag',
                'name' => 'begore_body_closing_tag',
                'type' => 'textarea',
                'default_value' => '',
            ],
        ]
    ],
]);

Options::addGlobal('Comapny Information', [
    [
        'name' => 'address',
        'label' => __('Address', 'flynt'),
        'type' => 'text',
    ],
    [
        'name' => 'city',
        'label' => __('City', 'flynt'),
        'type' => 'text',
        'wrapper' => [
            'width' => '33.33333'
        ]
    ],
    [
        'name' => 'state',
        'label' => __('State', 'flynt'),
        'type' => 'text',
        'wrapper' => [
            'width' => '33.33333'
        ]
    ],
    [
        'name' => 'zip',
        'label' => __('Zip', 'flynt'),
        'type' => 'text',
        'wrapper' => [
            'width' => '33.33333'
        ]
    ],
    [
        'name' => 'address_google_map_url',
        'label' => __('Address Google Map Url', 'flynt'),
        'type' => 'text',
    ],
    [
        'name' => 'email',
        'label' => __('Email', 'flynt'),
        'type' => 'text',
    ],
    [
        'name' => 'phone',
        'label' => __('Phone', 'flynt'),
        'type' => 'text',
    ],
]);

Options::addGlobal('Single Story Page', [
    [
        'label' => 'Footer Fix',
        'name' => 'footer_fix',
        'type' => 'true_false',
        'default_value' => 0,
    ],
    [
        'label' => 'Title',
        'name' => 'title',
        'type' => 'text',
        'default_value' => '',
    ],
    [
        'label' => 'Sub Title',
        'name' => 'sub_title',
        'type' => 'text',
        'default_value' => '',
    ],
    [
        'label' => 'Content',
        'name' => 'content',
        'type' => 'wysiwyg',
        'delay' => 1,
        'media_upload' => 0,
        'wrapper' => [
            'class' => 'autosize',
        ],
    ],
    [
        'label' => 'Stories Page',
        'name' => 'stories_page',
        'type' => 'link',
    ]
]);

Options::addGlobal('Single Team Page', [
    [
        'label' => 'Footer Fix',
        'name' => 'footer_fix',
        'type' => 'true_false',
        'default_value' => 0,
    ],
    [
        'label' => 'Title',
        'name' => 'title',
        'type' => 'text',
        'default_value' => '',
    ],
    [
        'label' => 'Sub Title',
        'name' => 'sub_title',
        'type' => 'text',
        'default_value' => '',
    ],
    [
        'label' => 'Content',
        'name' => 'content',
        'type' => 'wysiwyg',
        'delay' => 1,
        'media_upload' => 0,
        'wrapper' => [
            'class' => 'autosize',
        ],
    ],
    [
        'label' => 'Teams Page',
        'name' => 'teams_page',
        'type' => 'link',
    ]
]);

Options::addGlobal('Single Update Page', [
    [
        'label' => 'Footer Fix',
        'name' => 'footer_fix',
        'type' => 'true_false',
        'default_value' => 0,
    ],
    [
        'label' => 'Title',
        'name' => 'title',
        'type' => 'text',
        'default_value' => '',
    ],
    [
        'label' => 'Sub Title',
        'name' => 'sub_title',
        'type' => 'text',
        'default_value' => '',
    ],
    [
        'label' => 'Content',
        'name' => 'content',
        'type' => 'wysiwyg',
        'delay' => 1,
        'media_upload' => 0,
        'wrapper' => [
            'class' => 'autosize',
        ],
    ],
    [
        'label' => 'Updates Page',
        'name' => 'updates_page',
        'type' => 'link',
    ]
]);

Options::addGlobal('404 Page', [
    [
        'label' => 'Content',
        'name' => 'content',
        'type' => 'wysiwyg',
        'media_upload' => 0,
        'default_value' => '<h1>404</h1><h2>PAGE DOESN’T EXIST</h2><p>It looks like the page you’re looking for doesn’t exist.</p><p>Please use the navigation or go to <a href="/">Home Page</a>.</p>',
        'delay' => 1,
    ]
]);
