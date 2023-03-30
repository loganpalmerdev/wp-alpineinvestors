<?php

namespace Flynt\Components\BlockQuote;

function getACFLayout()
{
    return [
        'name' => 'blockQuote',
        'label' => 'Block: Quote',
        'sub_fields' => [
            [
                'label' => 'Author',
                'name' => 'author',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Content',
                'name' => 'content',
                'type' => 'textarea',
                'rows' => 4,
            ],
        ]
    ];
}
