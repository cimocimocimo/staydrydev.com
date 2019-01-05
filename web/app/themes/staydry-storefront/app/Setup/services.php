<?php

namespace Tonik\Theme\App\Setup;

/*
|-----------------------------------------------------------
| Theme Custom Services
|-----------------------------------------------------------
|
| This file is for registering your third-parity services
| or custom logic within theme container, so they can
| be easily used for a theme template files later.
|
*/

use function Tonik\Theme\App\theme;
use Tonik\Gin\Foundation\Theme;
use WP_Query;

/**
 * Service handler for retrieving posts of specific post type.
 *
 * @return void
 */
function bind_books_service()
{
    /**
     * Binds service for retrieving posts of specific post type.
     *
     * @param \Tonik\Gin\Foundation\Theme $theme  Instance of the service container
     * @param array $parameters  Parameters passed on service resolving
     *
     * @return \WP_Post[]
     */
    theme()->bind('books', function (Theme $theme, $parameters) {
        return new WP_Query([
            'post_type' => 'book',
        ]);
    });
}
// add_action('init', 'Tonik\Theme\App\Setup\bind_books_service');


/**
 * FAQ service handler.
 *
 * @return void
 */
add_action('init', function () {

    /**
     * Retrieves FAQ posts with an optional filter.
     *
     * @param \Tonik\Gin\Foundation\Theme $theme  Instance of the service container
     * @param array $parameters  Parameters passed on service resolving
     *
     * @return \WP_Post[]
     */
    theme()->bind('faqs', function (Theme $theme, $parameters) {

        // get all faqs
        $faqs = get_posts([
            'post_type' => 'faq',
            'posts_per_page' => -1,
        ]);

        // apply filters
        if ($parameters && array_key_exists('filter', $parameters)) {

            // filter by product id
            if ($parameters['filter']['product_id']) {
                // need to pull all the FAQs and then filter by ACF field.
                $faqs = array_filter($faqs, function ($faq) use ($parameters) {
                    // Check this faq for the related product field
                    $related_products = get_field('related_products', $faq->ID);

                    foreach ($related_products as $id) {
                        if ($id  == $parameters['filter']['product_id']) {
                            return $faq;
                        }
                    }
                });
            }

            // filter by faq_category
        }

        // return new WP_Query([
        //     'post_type' => 'faq',
        // ]);

        return $faqs;
    });
});
