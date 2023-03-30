<?php

namespace Flynt\Components\BlockText;

function getACFLayout()
{
    return [
        'name' => 'blockText',
        'label' => 'Block: Text',
        'sub_fields' => [
            [
                'label' => 'Text',
                'name' => 'text',
                'type' => 'textarea',
                'rows' => 3,
            ],
        ]
    ];
}
