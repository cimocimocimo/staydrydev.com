<div class="block-headings">
    <?php if ($block->heading) : ?>
        <h2 class="section-title"><?= $block->heading ?></h2>
    <?php endif; ?>

    <?php if ($block->subheading) : ?>
        <h3 class="section-subheading"><?= $block->subheading ?></h3>
    <?php endif; ?>

    <?php if ($block->content) : ?>
        <?= apply_filters('the_content', $block->content) ?>
    <?php endif; ?>
</div>

<?= $block->shortcode_content ?>
