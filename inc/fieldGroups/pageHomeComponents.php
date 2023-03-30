<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageHomeComponents',
        'title' => 'Page Home Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageHomeComponents',
                'label' => __('Page Home Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\BigThreeImagesLinkSection\getACFLayout(),
                    Components\SingleUpdateSection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-home.php'
                ]
            ]
        ]
    ]);
});
