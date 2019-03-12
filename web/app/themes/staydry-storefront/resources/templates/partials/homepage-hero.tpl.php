<?php

    use function Tonik\Theme\App\asset_path;

?>
<div class="homepage-hero">
    <div class="homepage-hero__headline-desktop">
        <h2><?= $headline ?></h2>
    </div>
    <div class="homepage-hero__problem">
        <div class="homepage-hero__problem-heading">
            <h3>The<br>Problems</h3>
        </div>
        <div class="homepage-hero__problem-image">
            <img src="<?= $problem_image['sizes']['large'] ?>" alt="Problem image" />
        </div>
        <div class="homepage-hero__problem-features">
            <?php foreach ($problem_features as $feature): ?>
                <div class="solution-feature solution-feature--icon-<?= $feature['icon_position'] ?>"
                    style="
                    left: <?= $feature['horizontal_position'] ?>%;
                    top: <?= $feature['vertical_position'] ?>%;">
                    <span class="outline"><?= $feature['text'] ?></span>
                    <span class="text"><?= $feature['text'] ?></span>
                    <img src="<?= asset_path('images/red-x.svg') ?>"
                        alt="Red X Icon">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="homepage-hero__solution">
        <div class="homepage-hero__solution-heading">
            <h3>Our<br>Solution</h3>
        </div>
        <div class="homepage-hero__solution-image">
            <img src="<?= $solution_image['sizes']['large'] ?>" alt="Solution image" />
        </div>
        <div class="homepage-hero__solution-features">
            <?php foreach ($solution_features as $feature): ?>
                <div class="solution-feature solution-feature--icon-<?= $feature['icon_position'] ?>"
                    style="
                    left: <?= $feature['horizontal_position'] ?>%;
                    top: <?= $feature['vertical_position'] ?>%;">
                    <span class="outline"><?= $feature['text'] ?></span>
                    <span class="text"><?= $feature['text'] ?></span>
                    <img src="<?= asset_path('images/green-check.svg') ?>"
                        alt="Green Check Icon">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="homepage-hero__headline-handheld">
        <h2><?= $headline ?></h2>
    </div>
    <div class="homepage-hero__subheading">
        <h3><?= $subheading ?></h3>
    </div>
</div>
</div>
