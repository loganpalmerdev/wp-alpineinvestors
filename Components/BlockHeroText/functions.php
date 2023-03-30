<?php

namespace Flynt\Components\BlockHeroText;

function getACFLayout()
{
    return [
        'name' => 'blockHeroText',
        'label' => 'Block: Hero Text',
        'sub_fields' => [
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
                'label' => 'Navigators',
                'name' => 'navigators',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Navigator',
                'sub_fields' => [
                    [
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => '',
                    ],
                    [
                        'label' => 'Section ID',
                        'name' => 'section_id',
                        'type' => 'text',
                        'default_value' => '',
                    ],
                ]
            ]
        ]
    ];
}
