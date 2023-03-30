<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function () {
    ACFComposer::registerFieldGroup([
        'name' => 'pageComponents',
        'title' => 'Page Components',
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageComponents',
                'label' => __('Page Components', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\BlockHeroText\getACFLayout(),
                    Components\ContactInfoSection\getACFLayout(),
                    Components\BlockContent\getACFLayout(),
                    Components\BigThreeImagesLinkSection\getACFLayout(),
                    Components\BlockButtonLink\getACFLayout(),
                    Components\BlockQuote\getACFLayout(),
                    Components\BlockText\getACFLayout(),
                    Components\BlockTextLink\getACFLayout(),
                    Components\BlockTwoColumnsList\getACFLayout(),
                    Components\BlockTwoColumnsText\getACFLayout(),
                    Components\BlockVideoText\getACFLayout(),
                    Components\ProfileSliderSection\getACFLayout(),
                    Components\SingleUpdateSection\getACFLayout(),
                    Components\SliderSection\getACFLayout(),
                    Components\ThreeInfoSection\getACFLayout(),
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page'
                ],
                [
                    'param' => 'page_type',
                    'operator' => '!=',
                    'value' => 'posts_page'
                ],
                [
                    'param' => 'page_template',
                    'operator' => '!=',
                    'value' => 'page-templates/page-stories.php'
                ],
                [
                    'param' => 'page_template',
                    'operator' => '!=',
                    'value' => 'page-templates/page-home.php'
                ],
                [
                    'param' => 'page_template',
                    'operator' => '!=',
                    'value' => 'page-templates/page-about.php'
                ],
                [
                    'param' => 'page_template',
                    'operator' => '!=',
                    'value' => 'page-templates/page-careers.php'
                ],
                [
                    'param' => 'page_template',
                    'operator' => '!=',
                    'value' => 'page-templates/page-portfolios.php'
                ],
                [
                    'param' => 'page_template',
                    'operator' => '!=',
                    'value' => 'page-templates/page-teams.php'
                ],
                [
                    'param' => 'page_template',
                    'operator' => '!=',
                    'value' => 'page-templates/page-updates.php'
                ]
            ]
        ]
    ]);
});

if (function_exists('acf_add_local_field_group')) :
    acf_add_local_field_group(array(
        'key' => 'group_5fcc82e5d81fd',
        'title' => 'Page Metabox',
        'fields' => array(
            array(
                'key' => 'field_602d0119c0e4c',
                'label' => 'Header Menu Open',
                'name' => 'header_menu_open',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_5fcc82f1af154',
                'label' => 'Footer Fix',
                'name' => 'footer_fix',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
endif;
