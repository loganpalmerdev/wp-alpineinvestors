<?php

/**
 * Template Name: Careers Page
 */

use Timber\Timber;
use Timber\Post;

$context = Timber::get_context();
$context['post'] = new Post();

Timber::render('templates/page-careers.twig', $context);
