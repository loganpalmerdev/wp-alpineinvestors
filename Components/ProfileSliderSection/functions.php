<?php

namespace Flynt\Components\ProfileSliderSection;

function getACFLayout()
{
    return [
        'name' => 'profileSliderSection',
        'label' => 'Profile Slider',
        'sub_fields' => [
            [
                'label' => 'Sliders',
                'name' => 'sliders',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Slider',
                'sub_fields' => [
                    [
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'preview_size' => 'medium',
                        'instructions' => '',
                        'max_size' => 4,
                        'mime_types' => 'gif,jpg,jpeg,png'
                    ],
                    [
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'label' => 'Name',
                        'name' => 'name',
                        'type' => 'text',
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
                    ]
                ]
            ],
        ]
    ];
}
