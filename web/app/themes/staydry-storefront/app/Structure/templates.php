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

/**
 * Custom args for homepage featured products block
 */
add_filter( 'storefront_featured_products_args', function () {
    return array(
        'limit'      => 4,
        'columns'    => 4,
        'orderby'    => 'date',
        'order'      => 'desc',
        'visibility' => 'featured',
        'title'      => __( 'StayDry Products', 'storefront' ),
    );
});

/**
 * Show replacement components on the homepage.
 */
add_action( 'homepage', function () {
    $args = apply_filters(
        'staydry_replacement_components_args', array(
            'limit'   => 4,
            'columns' => 4,
            'orderby' => 'date',
            'order'   => 'desc',
            'category' => 'replacement',
            'title'   => __( 'Replacement Components', 'storefront' ),
        )
    );

    $shortcode_content = storefront_do_shortcode(
        'products', apply_filters(
            'staydry_replacement_components_shortcode_args', array(
                'per_page' => intval( $args['limit'] ),
                'columns'  => intval( $args['columns'] ),
                'orderby'  => esc_attr( $args['orderby'] ),
                'order'    => esc_attr( $args['order'] ),
                'category'  => esc_attr( $args['category'] ),
            )
        )
    );

    /**
     * Only display the section if the shortcode returns products
     */
    if ( false !== strpos( $shortcode_content, 'product' ) ) {
        echo '<section class="storefront-product-section staydry-replacement-components" aria-label="' . esc_attr__( $args['title'], 'storefront' ) . '">';

        do_action( 'storefront_homepage_before_replacement_components' );

        echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

        do_action( 'storefront_homepage_after_replacement_components_title' );

        echo $shortcode_content; // WPCS: XSS ok.

        do_action( 'storefront_homepage_after_replacement_components' );

        echo '</section>';
    }
}, 70);

/**
 * Commercial products homepage block.
 */
add_action( 'homepage', function () {
    template('partials/commercial-homepage');
}, 80);

/**
 * Customer logos homepage block.
 */
add_action( 'homepage', function () {
    $customers = get_field('corporate_customers');

    foreach ($customers['customers'] as $i => $customer) {
        $customers['customers'][$i] = [
            'name' => $customer->post_title,
            'img' => get_the_post_thumbnail( $customer->ID, 'medium')
        ];
    }

    template('partials/corporate-customers-homepage', $customers);

}, 90);
