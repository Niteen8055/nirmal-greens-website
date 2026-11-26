<?php
$plans = [
    [
        'id'        => 'basics',
        'name'      => 'Nirmal Basics',
        'tagline'   => 'Ideal for individuals',
        'price'     => 1499,
        'image'     => '/img/home/subscriptions/nirmal-basics-microgreens.webp',
        'image_alt' => 'Nirmal Basics microgreens in a white bowl',
        'features'  => [
            'Freshly harvested',
            'Convenient delivery',
            'Trusted quality',
        ],
        'popular'   => false,
    ],
    [
        'id'        => 'health',
        'name'      => 'Nirmal Health',
        'tagline'   => 'Balanced nutrition for the family',
        'price'     => 2499,
        'image'     => '/img/home/subscriptions/nirmal-health-microgreens.webp',
        'image_alt' => 'Nirmal Health mixed microgreens in a white bowl',
        'features'  => [
            'Freshly harvested',
            'On-time home delivery',
            'Trusted quality',
        ],
        'popular'   => true,
    ],
    [
        'id'        => 'personalized',
        'name'      => 'Nirmal Personalized',
        'tagline'   => 'Tailored greens for your goals',
        'price'     => 3499,
        'image'     => '/img/home/subscriptions/nirmal-personalized-microgreens.webp',
        'image_alt' => 'Nirmal Personalized microgreens in a white bowl',
        'features'  => [
            'Freshly harvested',
            'Convenient delivery',
            'Trusted quality',
        ],
        'popular'   => false,
    ],
];
?>

<section class="subscriptions" id="subscriptions" aria-labelledby="subscriptions-title">
    <div class="container">
        <div class="row align-items-center g-4 g-xl-5">

            <!-- Left intro -->
            <div class="col-12 col-xl-4" data-reveal>
                <div class="subscriptions__intro">
                    <span class="subscriptions__badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2" />
                            <path d="M3 10h18M8 2v4M16 2v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        MONTHLY SUBSCRIPTION
                    </span>

                    <h2 class="subscriptions__title" id="subscriptions-title">
                        Fresh Nutrition,<br>Delivered<br>
                        <span class="subscriptions__title-last-line">
                            Regularly.
                            <svg class="subscriptions__title-leaf" viewBox="0 0 64 40" fill="none" aria-hidden="true">
                                <path d="M4 35C14 11 36 2 60 4 57 25 40 39 4 35Z" fill="currentColor" />
                                <path d="M6 34C22 29 39 18 57 6" stroke="#4B8C20" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                    </h2>

                    <p class="subscriptions__lead">
                        A convenient monthly subscription for a steady supply of fresh, nutrient-rich microgreens at your doorstep.
                    </p>

                    <ul class="subscriptions__benefits list-unstyled">
                        <li>
                            <span class="subscriptions__check" aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            Farm-fresh, pesticide-free microgreens
                        </li>
                        <li>
                            <span class="subscriptions__check" aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            Clean, hygienic and safe to consume
                        </li>
                        <li>
                            <span class="subscriptions__check" aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            Convenient &amp; reliable home delivery
                        </li>
                        <li>
                            <span class="subscriptions__check" aria-hidden="true">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            Trusted quality, every month
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Plan cards -->
            <div class="col-12 col-xl-8" data-reveal>
                <div class="row g-3 g-lg-4 justify-content-center">
                    <?php foreach ($plans as $index => $plan): ?>
                        <div class="col-12 col-sm-6 col-lg-4 d-flex">
                            <article class="subscriptions__card<?= $plan['popular'] ? ' subscriptions__card--popular' : '' ?>" data-plan="<?= htmlspecialchars($plan['id']) ?>">
                                <?php if ($plan['popular']): ?>
                                    <div class="subscriptions__popular-badge">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path d="M12 2l2.4 7.4H22l-6 4.6 2.3 7L12 17.3 5.7 21l2.3-7-6-4.6h7.6z" />
                                        </svg>
                                        Most Popular
                                    </div>
                                <?php endif; ?>

                                <div class="subscriptions__image">
                                    <img
                                        src="<?= htmlspecialchars($plan['image']) ?>"
                                        alt="<?= htmlspecialchars($plan['image_alt']) ?>"
                                        width="160"
                                        height="160"
                                        loading="lazy"
                                        decoding="async">
                                </div>

                                <div class="subscriptions__body">
                                    <h3 class="subscriptions__name"><?= htmlspecialchars($plan['name']) ?></h3>
                                    <p class="subscriptions__tagline"><?= htmlspecialchars($plan['tagline']) ?></p>

                                    <div class="subscriptions__price">
                                        <span class="subscriptions__currency">₹</span><?= number_format($plan['price']) ?>
                                        <span class="subscriptions__period">/month</span>
                                    </div>

                                    <ul class="subscriptions__features list-unstyled">
                                        <?php foreach ($plan['features'] as $feature): ?>
                                            <li>
                                                <span class="subscriptions__feature-check" aria-hidden="true">
                                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                                <?= htmlspecialchars($feature) ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>

                                    <a
                                        href="#subscriptions"
                                        class="subscriptions__cta<?= $plan['popular'] ? ' subscriptions__cta--primary' : '' ?>"
                                        aria-label="Choose <?= htmlspecialchars($plan['name']) ?> subscription">
                                        Choose Plan<?= $plan['popular'] ? ' <span aria-hidden="true">→</span>' : '' ?>
                                    </a>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Trust strip -->
        <div class="subscriptions__trust" data-reveal>
            <div class="subscriptions__trust-item">
                <span class="subscriptions__trust-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2C8 6 4 9 4 13a8 8 0 0016 0c0-4-4-7-8-11z" stroke="currentColor" stroke-width="1.7" />
                        <path d="M12 13v5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                    </svg>
                </span>
                <span>Fresh &amp; Nutrient-Rich</span>
            </div>
            <div class="subscriptions__trust-item">
                <span class="subscriptions__trust-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <rect x="1" y="6" width="15" height="11" rx="1.5" stroke="currentColor" stroke-width="1.7" />
                        <path d="M16 10h3l3 3v4h-6V10z" stroke="currentColor" stroke-width="1.7" />
                        <circle cx="5.5" cy="18.5" r="1.5" fill="currentColor" />
                        <circle cx="18.5" cy="18.5" r="1.5" fill="currentColor" />
                    </svg>
                </span>
                <span>Doorstep Delivery</span>
            </div>
            <div class="subscriptions__trust-item">
                <span class="subscriptions__trust-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.7" />
                        <path d="M3 10h18M8 2v4M16 2v4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                    </svg>
                </span>
                <span>Flexible Monthly Plan</span>
            </div>
            <div class="subscriptions__trust-item">
                <span class="subscriptions__trust-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M12 21s-7-4.5-7-10a7 7 0 0114 0c0 5.5-7 10-7 10z" stroke="currentColor" stroke-width="1.7" />
                    </svg>
                </span>
                <span>Grow a Healthier You</span>
            </div>
        </div>
    </div>
</section>