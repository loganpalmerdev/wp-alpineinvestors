<?php

namespace Flynt\Components\BlockTextLink;

function getACFLayout()
{
    return [
        'name' => 'blockTextLink',
        'label' => 'Block: Text Link',
        'sub_fields' => [
            [
                'label' => 'Text',
                'name' => 'text',
                'type' => 'textarea',
                'rows' => 3,
            ],
            [
                'label' => 'Link Sub Title',
                'name' => 'link_sub_title',
                'type' => 'text',
            ],
            [
                'label' => 'Link',
                'name' => 'link',
                'type' => 'link',
            ],
        ]
    ];
}
