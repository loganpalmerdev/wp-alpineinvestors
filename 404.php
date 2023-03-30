<?php

use Timber\Timber;

$context = Timber::get_context();
$context['remove_content_padding'] = true;

Timber::render('templates/404.twig', $context);
