<section class=""
    aria-label="<?= $block->heading ?>">

    <?php if ($block->heading) : ?>
        <h2 class="section-title"><?= $block->heading ?></h2>
    <?php endif; ?>

    <?php foreach ($block->customers as $cust) : ?>
        <div class="block-corporate_customers__logo">
            <span
                style="width: <?= $cust->logo_width_percent ?>%;">
                <?= $cust->thumbnail ?>
            </span>
        </div>
    <?php endforeach; ?>

</section>
