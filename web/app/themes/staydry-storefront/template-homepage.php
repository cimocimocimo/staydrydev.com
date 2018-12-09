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

// Get ACF Fields
$hero = get_field('hero');

$content = get_field('page_content');

$blocks = [];

while (have_rows('page_content')) {
    $row = the_row(true); // call first to setup the loop, save the row data
    $layout = get_row_layout();

    // Additional row processing
    switch ($layout) {
    case 'products':
        // do the products shortcode with the passed args

        $args = $row['args'];
        $args['orderby'] = implode(' ', $args['orderby_array']);

        if ($args['category_array']) {
            // get string of slugs separated by commas from array of category taxonomy objects.
            $args['category'] = array_reduce($args['category_array'], function ($carry, $item) {
                // add separator after the first item.
                if (!$carry) {
                    return $item->slug;
                }
                return $carry . ',' . $item->slug;
            });
        }

        // These are mutually exclusive and added using a flag like: attribute=true
        if ($args['special_attributes']) {
            $args[$args['special_attributes']] = true;
        }

        $row['shortcode_content'] = storefront_do_shortcode('products', $args);

        break;
    case 'corporate_customers':

        $customers = format_brief_posts($row['customers'], 'medium_large');

        foreach ($customers as $cust){
            $logo_metadata = wp_get_attachment_metadata(
                get_post_thumbnail_id($cust->ID)
            );

            $matched_dimentions = match_area_of_rectangles(
                37,
                [
                    $logo_metadata['width'],
                    $logo_metadata['height']
                ]
            );
            $cust->logo_width_percent = $matched_dimentions[0];
            $cust->logo_height_percent = $matched_dimentions[1];
        }

        // replace the original corp_customers for the row with the processed ones
        $row['customers'] = $customers;

        break;
    }

    // save the layout in an easy to read key
    // merge the new array with the existing row array
    // cast array object with indexes as keys
    $blocks[] = (object) array_merge(
        [
            'layout' => $layout,
            'class' => 'block-' . $layout,
        ],
        $row
    );
}

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

template('homepage', [
    'hero' => $hero,
    'blocks' => $blocks,
]);
