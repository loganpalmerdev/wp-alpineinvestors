<?php

namespace Flynt\Components\BlockContent;

function getACFLayout()
{
    return [
        'name' => 'blockContent',
        'label' => 'Block: Content',
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
            ],
        ]
    ];
}
