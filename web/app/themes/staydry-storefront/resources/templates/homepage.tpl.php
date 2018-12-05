<?php

    use function Tonik\Theme\App\template;

    get_header();

?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php

            if ($hero) {
                template('partials/homepage-hero', ['hero' => $hero,]);
            }

			/**
			 * Functions hooked in to homepage action
			 *
			 * @hooked storefront_homepage_content      - 10
			 * @hooked storefront_product_categories    - 20
			 * @hooked storefront_recent_products       - 30
			 * @hooked storefront_featured_products     - 40
			 * @hooked storefront_popular_products      - 50
			 * @hooked storefront_on_sale_products      - 60
			 * @hooked storefront_best_selling_products - 70
			 */
			do_action( 'homepage' );
		?>

    </main><!-- #main -->
<?php get_footer(); ?>
