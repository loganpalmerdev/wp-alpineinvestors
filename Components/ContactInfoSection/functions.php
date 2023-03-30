<?php

namespace Flynt\Components\ContactInfoSection;

use Flynt\Utils\Options;

add_filter('Flynt/addComponentData?name=ContactInfoSection', function ($data) {
    $data['googleMapsApiKey'] = Options::getGlobal('Acf', 'googleMapsApiKey');

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'contactInfoSection',
        'label' => 'Contact Info Section',
        'sub_fields' => [
            [
                'label' => 'Contact Emails',
                'name' => 'contact_emails',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Contact Email',
                'sub_fields' => [
                    [
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'text',
                        'default_value' => '',
                    ],
                    [
                        'label' => 'Email',
                        'name' => 'email',
                        'type' => 'text',
                        'default_value' => '',
                    ],
                ]
            ],
            [
                'label' => 'Address',
                'name' => 'address',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Google Map Link',
                'name' => 'google_map_link',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Phone',
                'name' => 'phone',
                'type' => 'text',
                'default_value' => '',
            ],
            [
                'label' => 'Google Location',
                'name' => 'google_location',
                'type' => 'google_map'
            ]
        ]
    ];
}
