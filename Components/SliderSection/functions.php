<?php

namespace Flynt\Components\SliderSection;

function getACFLayout()
{
    return [
        'name' => 'sliderSection',
        'label' => 'Slider',
        'sub_fields' => [
            [
                'label' => 'Sectoin ID',
                'name' => 'section_id',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'default_value' => '',
            ],
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
