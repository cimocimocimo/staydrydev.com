<div class="<?= $block->meta->class ?>__row">
    <div class="<?= $block->meta->class ?>__column">
        <?php if ($block->heading) : ?>
            <h2 class="section-title"><?= $block->heading ?></h2>
        <?php endif; ?>
        <?php if ($block->subheading) : ?>
            <h3><?= $block->subheading ?></h3>
        <?php endif; ?>
        <?php if ($block->content) : ?>
            <?= $block->content ?>
        <?php endif; ?>
        <?php if ($block->call_to_action) : ?>
            <div class="<?= $block->meta->class ?>__cta">
                <a class="button" href="<?= $block->call_to_action['url'] ?>">
                    <?php if ($block->call_to_action['title']) : ?>
                        <?= $block->call_to_action['title'] ?>
                    <?php else: ?>
                        <?= $block->call_to_action['url'] ?>
                    <?php endif; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
