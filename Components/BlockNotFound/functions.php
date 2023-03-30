<?php

namespace Flynt\Components\BlockNotFound;

use Flynt\Utils\Options;

add_filter('Flynt/addComponentData?name=BlockNotFound', function ($data) {
    $data['content'] = Options::getGlobal('404 Page', 'content');

    return $data;
});
