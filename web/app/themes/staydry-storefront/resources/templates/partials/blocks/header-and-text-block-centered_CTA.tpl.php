<?php if ($block->heading || $block->subheading) : ?>
    <div class="<?= $block->meta->class ?>__headings">
        <?php if ($block->heading) : ?>
            <h3 class="<?= $block->meta->class ?>__heading"><?= $block->heading ?></h3>
        <?php endif ?>
        <?php if ($block->subheading) : ?>
            <h2 class="<?= $block->meta->class ?>__subheading"><?= $block->subheading ?></h2>
        <?php endif ?>
    </div>
<?php endif ?>
<?php if ($block->content || $block->call_to_action) : ?>
    <div class="<?= $block->meta->class ?>__content">
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
<?php endif; ?>
