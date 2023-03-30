<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pagePortfoliosComponents',
        'title' => 'Page Portfolios Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pagePortfoliosComponents',
                'label' => __('Page Portfolios Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\BlockHeroText\getACFLayout(),
                    Components\PortfoliosSection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-portfolios.php'
                ]
            ]
        ]
    ]);
});
