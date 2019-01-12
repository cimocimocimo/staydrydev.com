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

use function Tonik\Theme\App\{template, format_brief_posts, match_area_of_rectangles};
use function Tonik\Theme\App\Structure\get_page_content_blocks;

// Get ACF Fields
$hero = get_field('hero');
$blocks = get_page_content_blocks();

template('homepage', [
    'hero' => $hero,
    'blocks' => $blocks,
]);
