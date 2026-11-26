<section class="hero" id="home" aria-labelledby="hero-title">
    <!-- Full-width doorstep delivery background, art-directed per breakpoint -->
    <div class="hero__visual" aria-hidden="true">
        <picture>
            <source
                media="(max-width: 767.98px)"
                srcset="/img/home/hero/hero_mobile.webp"
                width="1024"
                height="1536">
            <source
                media="(max-width: 991.98px)"
                srcset="/img/home/hero/hero_tablet.webp"
                width="1448"
                height="1086">
            <img
                src="/img/home/hero/hero_bg.webp"
                alt=""
                width="1774"
                height="887"
                fetchpriority="high"
                decoding="async">
        </picture>
    </div>

    <!-- Decorative microgreens foreground layer -->
    <img
        class="hero__leaf"
        src="/img/home/hero/leaf.webp"
        alt=""
        aria-hidden="true"
        decoding="async">

    <div class="container hero__container">
        <div class="hero__slide">
            <div class="row align-items-center">
                <div class="col-12 col-lg-7 col-xl-6">
                    <div class="hero__content">
                        <p class="hero__eyebrow">ONE HANDFUL EVERYDAY</p>

                        <h1 class="hero__title" id="hero-title">
                            <span>Fresh Microgreens.</span>
                            <span>Harvested Live at <span class="hero__title-accent">Your Doorstep.</span></span>
                        </h1>

                        <svg class="hero__title-flourish" viewBox="0 0 180 20" fill="none" aria-hidden="true">
                            <path d="M3 12c42-9 84-10 124-4" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                            <path d="M16 17c39-7 74-7 108-2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>

                        <p class="hero__description">
                            Zero storage, zero chemical preservatives. We follow our SOP strictly.
                            We grow your microgreens with intense care and bring living trays
                            directly to your doorstep and snip them live, so you receive fresh
                            microgreens with more active enzymes and peak crunch.
                        </p>

                        <div class="hero__actions">
                            <a class="hero__button hero__button--primary" href="#subscriptions">
                                Subscribe Now<span aria-hidden="true">&#8594;</span>
                            </a>
                            <a class="hero__button hero__button--secondary" href="#microgreens">
                                Explore Microgreens
                            </a>
                        </div>

                        <div
                            class="hero__trust-row"
                            aria-label="Nirmal Greens quality commitments">
                            <div class="hero__trust-item">
                                <p>
                                    Organic Non<br>
                                    GMO seeds are used
                                </p>
                            </div>

                            <div class="hero__trust-item hero__trust-item--fresh">
                                <strong>100%</strong>
                                <p>Fresh &amp; Locally Grown</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
        The tracker is built from HTML, CSS and four transparent tray images.
        This avoids the checkerboard background baked into subscription_tracker.png
        and allows each weekly tray to animate independently.
    -->
    <aside
        class="hero__subscription"
        aria-label="Monthly subscription: four fresh trays across four weeks, with one tray delivered each week">
        <div class="hero__subscription-header">
            <svg
                class="hero__subscription-calendar"
                viewBox="0 0 48 48"
                fill="none"
                aria-hidden="true">
                <rect x="6" y="10" width="36" height="32" rx="5" stroke="currentColor" stroke-width="3" />
                <path d="M15 5v10M33 5v10M7 19h34" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                <path d="M16 27h.01M24 27h.01M32 27h.01M16 34h.01M24 34h.01M32 34h.01" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
            </svg>

            <span class="hero__subscription-divider" aria-hidden="true"></span>

            <span class="hero__subscription-heading">
                <strong>Monthly Subscription</strong>
                <span>4 Fresh Trays, 4 Weeks</span>
            </span>

            <svg
                class="hero__subscription-rays"
                viewBox="0 0 44 38"
                fill="none"
                aria-hidden="true">
                <path d="M8 18 5 5M21 15 28 3M29 26 41 19" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
            </svg>
        </div>

        <div class="hero__subscription-products">
            <span class="hero__subscription-arrow" aria-hidden="true">
                <svg viewBox="0 0 48 104" fill="none">
                    <path
                        d="M5 5C40 23 43 65 13 83"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linecap="round"
                        stroke-dasharray="5 7" />
                    <path
                        d="m13 83 17-2M13 83l5-17"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>

            <span class="hero__subscription-line" aria-hidden="true"></span>

            <ol class="hero__subscription-list">
                <li class="hero__subscription-week">
                    <span class="hero__tray-card">
                        <img
                            src="/img/home/hero/trays/week-1-green-microgreens.webp"
                            alt=""
                            loading="eager"
                            decoding="async">
                    </span>
                    <span class="hero__week-marker" aria-hidden="true"></span>
                    <span class="hero__week-label">Week 1</span>
                </li>

                <li class="hero__subscription-week">
                    <span class="hero__tray-card">
                        <img
                            src="/img/home/hero/trays/week-2-magenta-radish-microgreens.webp"
                            alt=""
                            loading="eager"
                            decoding="async">
                    </span>
                    <span class="hero__week-marker" aria-hidden="true"></span>
                    <span class="hero__week-label">Week 2</span>
                </li>

                <li class="hero__subscription-week">
                    <span class="hero__tray-card">
                        <img
                            src="/img/home/hero/trays/week-3-light-green-microgreens.webp"
                            alt=""
                            loading="eager"
                            decoding="async">
                    </span>
                    <span class="hero__week-marker" aria-hidden="true"></span>
                    <span class="hero__week-label">Week 3</span>
                </li>

                <li class="hero__subscription-week">
                    <span class="hero__tray-card">
                        <img
                            src="/img/home/hero/trays/week-4-round-leaf-microgreens.webp"
                            alt=""
                            loading="eager"
                            decoding="async">
                    </span>
                    <span class="hero__week-marker" aria-hidden="true"></span>
                    <span class="hero__week-label">Week 4</span>
                </li>
            </ol>
        </div>
    </aside>
</section>