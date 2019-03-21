<div class="<?= $block->meta->class ?>__row">
    <div class="<?= $block->meta->class ?>__column
        <?= $block->meta->class ?>__heading">
        <h3 class="section-title"><?= $block->heading ?></h3>
    </div>
    <div class="<?= $block->meta->class ?>__column
        <?= $block->meta->class ?>__content">
        <?= $block->content ?>
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
