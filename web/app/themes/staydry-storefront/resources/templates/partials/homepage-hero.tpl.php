<div class="homepage-hero">
    <h2><?= $hero['headline'] ?></h2>
    <h3><?= $hero['sub-heading'] ?></h3>
    <ul>
        <?php foreach ($hero['feature_bullets'] as $feature): ?>
            <li><?= $feature['text'] ?></li>
        <?php endforeach; ?>
    </ul>
    <div class="homepage-hero__image">
        <img src="<?php echo $hero['image']['url']; ?>" alt="<?php echo $hero['image']['alt']; ?>" />
    </div>
</div>
