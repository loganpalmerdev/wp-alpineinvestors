<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Options;

$context = Timber::get_context();
$context['post'] = new Post();
$context['hero_title'] = Options::getGlobal('Single Update Page', 'title');
$context['hero_sub_title'] = Options::getGlobal('Single Update Page', 'sub_title');
$context['hero_content'] = Options::getGlobal('Single Update Page', 'content');
$context['post_footer_fix'] = Options::getGlobal('Single Update Page', 'footer_fix');
$context['updates_page'] = Options::getGlobal('Single Update Page', 'updates_page');

Timber::render('templates/single-update.twig', $context);
