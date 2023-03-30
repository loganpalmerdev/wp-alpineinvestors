<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageUpdatesComponents',
        'title' => 'Page Updates Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageUpdatesComponents',
                'label' => __('Page Updates Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\BlockHeroText\getACFLayout(),
                    Components\UpdatesSection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-updates.php'
                ]
            ]
        ]
    ]);
});
