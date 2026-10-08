<?php
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/preloader.php';
require_once __DIR__ . '/includes/header.php';
?>
<main id="main-content">
    <?php require_once __DIR__ . '/sections/hero.php'; ?>
    <?php require_once __DIR__ . '/sections/benefits.php'; ?>
    <?php require_once __DIR__ . '/sections/how-it-works.php'; ?>
    <?php require_once __DIR__ . '/sections/microgreens.php'; ?>
    <?php require_once __DIR__ . '/sections/subscriptions.php'; ?>
    <?php require_once __DIR__ . '/sections/recipes.php'; ?>
    <?php require_once __DIR__ . '/sections/cta.php'; ?>
</main>
<button class="scroll-progress-indicator" type="button" aria-label="Back to top">
    <span class="scroll-progress-indicator__arrow" aria-hidden="true">↑</span>
    <span class="scroll-progress-indicator__percentage" aria-hidden="true">0%</span>
</button>
<?php
require_once __DIR__ . '/sections/footer.php';
require_once __DIR__ . '/includes/scripts.php';
