<?php

namespace Flynt\Components\SingleUpdateSection;

function getACFLayout()
{
    return [
        'name' => 'singleUpdateSection',
        'label' => 'Single Update Section',
        'sub_fields' => [
            [
                'label' => 'Update',
                'name' => 'selected_update',
                'type' => 'post_object',
                'post_type' => [
                    0 => 'update',
                ],
                'return_format' => 'object',
                'ui' => 1,
            ],
        ]
    ];
}
