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

            foreach ($blocks as $block) {
                // load template partial for this layout
                template('partials/block-' . $block->layout, ['block' => $block,]);
            }

		?>
    </main><!-- #main -->
</div>
<?php get_footer(); ?>
