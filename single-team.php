<?php

use Timber\Timber;
use Timber\Post;
use Flynt\Utils\Options;

$context = Timber::get_context();
$context['post'] = new Post();
$context['hero_title'] = Options::getGlobal('Single Team Page', 'title');
$context['hero_sub_title'] = Options::getGlobal('Single Team Page', 'sub_title');
$context['hero_content'] = Options::getGlobal('Single Team Page', 'content');
$context['post_footer_fix'] = Options::getGlobal('Single Team Page', 'footer_fix');
$context['teams_page'] = Options::getGlobal('Single Team Page', 'teams_page');

Timber::render('templates/single-team.twig', $context);
