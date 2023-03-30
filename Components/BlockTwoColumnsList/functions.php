<?php

namespace Flynt\Components\BlockTwoColumnsList;

function getACFLayout()
{
    return [
        'name' => 'blockTwoColumnsList',
        'label' => 'Block: Two Columns List',
        'sub_fields' => [
            [
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'List',
                'name' => 'list',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Content',
                'sub_fields' => [
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
            ]
        ]
    ];
}
