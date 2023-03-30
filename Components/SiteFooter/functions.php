<?php

namespace Flynt\Components\SiteFooter;

use Timber;
use Flynt\Utils\Asset;
use Flynt\Utils\Options;

add_action('widgets_init', function () {
    $shared_args = array(
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
        'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
    );
    
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => __('Footer #1', 'flynt'),
                'id'          => 'sidebar-1',
                'description' => __('Widgets in this area will be displayed in the second column in the footer.', 'flynt'),
            )
        )
    );

    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => __('Footer #2', 'flynt'),
                'id'          => 'sidebar-2',
                'description' => __('Widgets in this area will be displayed in the second column in the footer.', 'flynt'),
            )
        )
    );
    
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name'        => __('Footer #3', 'flynt'),
                'id'          => 'sidebar-3',
                'description' => __('Widgets in this area will be displayed in the third column in the footer.', 'flynt'),
            )
        )
    );
});

add_filter('Flynt/addComponentData?name=SiteFooter', function ($data) {
    $data['footer_widget_1'] = Timber::get_widgets('sidebar-1');
    $data['footer_widget_2'] = Timber::get_widgets('sidebar-2');
    $data['footer_widget_3'] = Timber::get_widgets('sidebar-3');

    $data['year'] = date('Y');

    $data['address'] = Options::getGlobal('Comapny Information', 'address');
    $data['city'] = Options::getGlobal('Comapny Information', 'city');
    $data['state'] = Options::getGlobal('Comapny Information', 'state');
    $data['zip'] = Options::getGlobal('Comapny Information', 'zip');
    $data['address_google_map_url'] = Options::getGlobal('Comapny Information', 'address_google_map_url');

    $data['email'] = Options::getGlobal('Comapny Information', 'email');
    $data['phone'] = Options::getGlobal('Comapny Information', 'phone');

    $data['logo'] = [
        'src' => Asset::requireUrl('Components/SiteFooter/Assets/footer-logo.svg'),
        'alt' => get_bloginfo('name')
    ];

    return $data;
});
