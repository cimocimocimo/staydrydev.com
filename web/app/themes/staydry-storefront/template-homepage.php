<?php

namespace Tonik\Theme\Home;

/**
 * Template Name: Homepage
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

use function Tonik\Theme\App\template;

// Get ACF Fields
$fields = get_fields();

// var_dump($fields);

template('homepage', [
    'hero' => get_field('hero'),
]);
