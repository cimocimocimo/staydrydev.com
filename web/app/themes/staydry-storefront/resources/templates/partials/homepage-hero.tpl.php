<div class="homepage-hero">
    <div class="homepage-hero__headline-desktop">
        <h2><?= $hero['headline'] ?></h2>
    </div>
    <div class="homepage-hero__image">
        <img src="<?php echo $hero['image']['url']; ?>" alt="<?php echo $hero['image']['alt']; ?>" />
    </div>
    <div class="homepage-hero__content">
        <div class="homepage-hero__headline-handheld">
            <h2><?= $hero['headline'] ?></h2>
        </div>
        <h3><?= $hero['sub-heading'] ?></h3>
    </div>
</div>
