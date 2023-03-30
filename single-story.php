<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Options;

$context = Timber::get_context();
$context['post'] = new Post();
$context['hero_title'] = Options::getGlobal('Single Story Page', 'title');
$context['hero_sub_title'] = Options::getGlobal('Single Story Page', 'sub_title');
$context['hero_content'] = Options::getGlobal('Single Story Page', 'content');
$context['post_footer_fix'] = Options::getGlobal('Single Story Page', 'footer_fix');
$context['stories_page'] = Options::getGlobal('Single Story Page', 'stories_page');

Timber::render('templates/single-story.twig', $context);
