<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageTeamsComponents',
        'title' => 'Page Teams Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageTeamsComponents',
                'label' => __('Page Teams Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\BlockHeroText\getACFLayout(),
                    Components\TeamsSection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-teams.php'
                ]
            ]
        ]
    ]);
});
