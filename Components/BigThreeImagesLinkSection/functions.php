<?php

namespace Flynt\Components\BigThreeImagesLinkSection;

function getACFLayout()
{
    return [
        'name' => 'bigThreeImagesLinkSection',
        'label' => 'Big Three Images Link Section',
        'sub_fields' => [
            [
                'label' => 'Image 1',
                'name' => 'image_1',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png'
            ],
            [
                'label' => 'Title 1',
                'name' => 'title_1',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Content 1',
                'name' => 'content_1',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'label' => 'Link 1',
                'name' => 'link_1',
                'type' => 'link',
            ],
            [
                'label' => 'Image 2',
                'name' => 'image_2',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png'
            ],
            [
                'label' => 'Title 2',
                'name' => 'title_2',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Content 2',
                'name' => 'content_2',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'label' => 'Link 2',
                'name' => 'link_2',
                'type' => 'link',
            ],
            [
                'label' => 'Image 3',
                'name' => 'image_3',
                'type' => 'image',
                'preview_size' => 'medium',
                'instructions' => '',
                'max_size' => 4,
                'mime_types' => 'gif,jpg,jpeg,png'
            ],
            [
                'label' => 'Title 3',
                'name' => 'title_3',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Content 3',
                'name' => 'content_3',
                'type' => 'textarea',
                'rows' => 4,
            ],
            [
                'label' => 'Link 3',
                'name' => 'link_3',
                'type' => 'link',
            ],
        ]
    ];
}
