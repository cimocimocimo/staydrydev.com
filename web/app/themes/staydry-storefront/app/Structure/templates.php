<?php

namespace Tonik\Theme\App\Structure;

/*
|-----------------------------------------------------------
| Theme Templates Actions
|-----------------------------------------------------------
|
| This file purpose is to include your templates rendering
| actions hooks, which allows you to render specific
| partials at specific places of your theme.
|
*/

use function Tonik\Theme\App\template;

/**
 * Renders post thumbnail by its formats.
 *
 * @see resources/templates/index.tpl.php
 */
function render_post_thumbnail()
{
    template(['partials/post/thumbnail', get_post_format()]);
}
add_action('theme/index/post/thumbnail', 'Tonik\Theme\App\Structure\render_post_thumbnail');

/**
 * Renders empty post content where there is no posts.
 *
 * @see resources/templates/index.tpl.php
 */
function render_empty_content()
{
    template(['partials/index/content', 'none']);
}
add_action('theme/index/content/none', 'Tonik\Theme\App\Structure\render_empty_content');

/**
 * Renders post contents by its formats.
 *
 * @see resources/templates/single.tpl.php
 */
function render_post_content()
{
    template(['partials/post/content', get_post_format()]);
}
add_action('theme/single/content', 'Tonik\Theme\App\Structure\render_post_content');

/**
 * Renders sidebar content.
 *
 * @uses resources/templates/partials/sidebar.tpl.php
 * @see resources/templates/index.tpl.php
 * @see resources/templates/single.tpl.php
 */
function render_sidebar()
{
    get_sidebar();
}
add_action('theme/index/sidebar', 'Tonik\Theme\App\Structure\render_sidebar');
add_action('theme/single/sidebar', 'Tonik\Theme\App\Structure\render_sidebar');

/**
 * Renders [button] shortcode after homepage content.
 *
 * @uses resources/templates/shortcodes/button.tpl.php
 * @see resources/templates/partials/header.tpl.php
 */
function render_documentation_button()
{
    echo do_shortcode("[button href='https://github.com/tonik/tonik']Checkout documentation →[/button]");
}
add_action('theme/header/end', 'Tonik\Theme\App\Structure\render_documentation_button');

/**
 * Renders the before_header template above the main header.
 *
 * @uses resources/templates/partials/before_header.tpl.php
 */
add_action('storefront_before_header', function(){
    template('partials/before_header');
});

/**
 * Removes default homepage function hooks
 */
add_action( 'init', function () {
    // to remove action hooks in the parent theme we need to call remove_action during init.
    remove_action('homepage', 'storefront_homepage_content', 10);
    remove_action('homepage', 'storefront_product_categories', 20);
    remove_action('homepage', 'storefront_recent_products', 30);
    remove_action('homepage', 'storefront_popular_products', 50);
    remove_action('homepage', 'storefront_best_selling_products', 70);
});
