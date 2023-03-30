<?php

namespace Flynt\Components\BlockButtonLink;

function getACFLayout()
{
    return [
        'name' => 'blockButtonLink',
        'label' => 'Block: Button Link',
        'sub_fields' => [
            [
                'label' => 'Link',
                'name' => 'link',
                'type' => 'link',
            ],
        ]
    ];
}
