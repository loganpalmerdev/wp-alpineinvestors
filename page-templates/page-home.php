<?php

/**
 * Template Name: Home Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-home.twig', $context);
