<?php

namespace Flynt\Components\SiteHeader;

use Timber\Menu;
use Flynt\Utils\Asset;
use Flynt\Utils\Options;

add_action('init', function () {
    register_nav_menus([
        'header_left_menu' => __('Header Left Menu', 'flynt'),
        'header_right_menu' => __('Header Right Menu', 'flynt'),
        'header_bottom_menu' => __('Header Bottom Menu', 'flynt')
    ]);
});

add_filter('Flynt/addComponentData?name=SiteHeader', function ($data) {
    $data['address'] = Options::getGlobal('Comapny Information', 'address');
    $data['city'] = Options::getGlobal('Comapny Information', 'city');
    $data['state'] = Options::getGlobal('Comapny Information', 'state');
    $data['zip'] = Options::getGlobal('Comapny Information', 'zip');
    $data['address_google_map_url'] = Options::getGlobal('Comapny Information', 'address_google_map_url');

    $data['year'] = date('Y');
    
    $data['left_menu'] = new Menu('header_left_menu');
    $data['right_menu'] = new Menu('header_right_menu');
    $data['bottom_menu'] = new Menu('header_bottom_menu');
    $data['logo'] = [
        'src' => Asset::requireUrl('Components/SiteHeader/Assets/logo.svg'),
        'alt' => get_bloginfo('name')
    ];

    return $data;
});
