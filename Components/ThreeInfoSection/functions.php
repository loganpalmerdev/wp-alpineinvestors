<?php

namespace Flynt\Components\ThreeInfoSection;

function getACFLayout()
{
    return [
        'name' => 'threeInfoSection',
        'label' => 'Three Info Section',
        'sub_fields' => [
            [
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Sub Title 1',
                'name' => 'sub_title_1',
                'type' => 'text',
                'default_value' => '',
                'wrapper' =>  [
                    'width' => '50',
                ],
            ],
            [
                'label' => 'Sub Value 1',
                'name' => 'sub_value_1',
                'type' => 'text',
                'default_value' => '',
                'wrapper' =>  [
                    'width' => '50',
                ],
            ],
            [
                'label' => 'Sub Title 2',
                'name' => 'sub_title_2',
                'type' => 'text',
                'default_value' => '',
                'wrapper' =>  [
                    'width' => '50',
                ],
            ],
            [
                'label' => 'Sub Value 2',
                'name' => 'sub_value_2',
                'type' => 'text',
                'default_value' => '',
                'wrapper' =>  [
                    'width' => '50',
                ],
            ],
            [
                'label' => 'Sub Title 3',
                'name' => 'sub_title_3',
                'type' => 'text',
                'default_value' => '',
                'wrapper' =>  [
                    'width' => '50',
                ],
            ],
            [
                'label' => 'Sub Value 3',
                'name' => 'sub_value_3',
                'type' => 'text',
                'default_value' => '',
                'wrapper' =>  [
                    'width' => '50',
                ],
            ],
            [
                'label' => 'Image 1',
                'name' => 'image_1',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png',
                'wrapper' =>  [
                    'width' => '50',
                ],
            ],
            [
                'label' => 'Image 2',
                'name' => 'image_2',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png',
                'wrapper' =>  [
                    'width' => '50',
                ],
            ]
        ]
    ];
}
