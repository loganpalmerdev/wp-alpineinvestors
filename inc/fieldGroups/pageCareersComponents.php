<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageCareersComponents',
        'title' => 'Page Careers Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageCareersComponents',
                'label' => __('Page Careers Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\BlockHeroText\getACFLayout(),
                    Components\SliderSection\getACFLayout(),
                    Components\BlockQuote\getACFLayout(),
                    Components\BlockText\getACFLayout(),
                    Components\BlockTextLink\getACFLayout(),
                    Components\BlockVideoText\getACFLayout(),
                    Components\ProfileSliderSection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-templates/page-careers.php'
                ]
            ]
        ]
    ]);
});
