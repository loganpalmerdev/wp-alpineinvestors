<?php

namespace Flynt\Components\BlockVideoText;

use Flynt\Utils\Oembed;

add_filter('Flynt/addComponentData?name=BlockVideoText', function ($data) {
    $data['video'] = Oembed::setSrcAsDataAttribute(
        $data['oembed'],
        [
            'autoplay' => 'true'
        ]
    );

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'blockVideoText',
        'label' => 'Block: Video Text',
        'sub_fields' => [
            [
                'label' => 'Video Overlay Image',
                'name' => 'video_overlay_image',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png'
            ],
            [
                'label' => 'Video',
                'name' => 'oembed',
                'type' => 'oembed',
            ],
            [
                'label' => 'Text',
                'name' => 'text',
                'type' => 'textarea',
                'rows' => 3,
            ],
        ]
    ];
}
