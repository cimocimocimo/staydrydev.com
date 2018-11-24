<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <div class="homepage-hero">
            <h2><?= $headline ?></h2>
            <h3><?= $subheading ?></h3>
            <ul>
                <?php foreach ($feature_bullets as $feature): ?>
                    <li><?= $feature['text'] ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="homepage-hero__image">
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            </div>
        </div>

		<?php
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

        <?php

            while ( have_posts() ) :
            the_post();
            do_action( 'storefront_page_before' );
            get_template_part( 'content', 'page' );

            /**
             * Functions hooked in to storefront_page_after action
             *
             * @hooked storefront_display_comments - 10
             */
            do_action( 'storefront_page_after' );
            endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
<?php get_footer(); ?>
