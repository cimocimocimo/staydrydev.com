<?php

    use function Tonik\Theme\App\template;

    get_header();

?>

<h2><?= the_title() ?></h2>

<div class="woocommerce-tabs wc-tabs-wrapper">
	<ul class="tabs wc-tabs" role="tablist">
        <?php foreach ( $faqs as $key => $faq ) : ?>
			<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
				<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $faq['term']->name ); ?></a>
			</li>
		<?php endforeach; ?>
		<!-- <li class="description_tab"
             id="tab-title-description" role="tab"
             aria-controls="tab-description">
			 <a href="#tab-description">Description</a>
		     </li>
		     <li class="reviews_tab"
             id="tab-title-reviews" role="tab"
             aria-controls="tab-reviews">
			 <a href="#tab-reviews">Reviews (0)</a>
		     </li>
		     <li class="faq_tab"
             id="tab-title-faq" role="tab"
             aria-controls="tab-faq">
			 <a href="#tab-faq">FAQs</a>
		     </li> -->
	</ul>
	<?php foreach ( $faqs as $key => $faq ) : ?>
		<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">

            <h3><?= $faq['term']->name ?></h3>

            <?php foreach ($faq['posts'] as $post) : ?>
                <h4><?= $post->post_title?></h4>
                <?= apply_filters('the_content', $post->post_content) ?>

                <?php if ($post->related_products) : ?>
                    <p>
                        <?php foreach ($post->related_products as $prod) : ?>
                            <a href="<?= $prod->permalink ?>"><?= $prod->title ?></a>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>
            <?php endforeach; ?>

		</div>
	<?php endforeach; ?>

</div>

<?php get_footer(); ?>
