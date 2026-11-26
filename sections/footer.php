<footer class="site-footer" id="site-footer" aria-label="Nirmal Greens footer">
    <div class="container-fluid site-footer__container">
        <div class="site-footer__main">
            <div class="site-footer__brand-column">
                <a class="site-footer__brand" href="/">
                    <img class="site-footer__logo" src="/img/nirmal-greens-logo.png" alt="Nirmal Greens" width="240" height="81" decoding="async">
                </a>
                <p class="site-footer__description">Fresh microgreens for your everyday meals.</p>
            </div>

            <nav class="site-footer__column" aria-labelledby="footer-quick-links">
                <h2 class="site-footer__heading" id="footer-quick-links">Quick Links</h2>
                <ul class="site-footer__links">
                    <li><a href="/">Home</a></li>
                    <li><a href="#microgreens">Microgreens</a></li>
                    <li><a href="#subscriptions">Subscriptions</a></li>
                    <li><a href="#recipes">Recipes</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </nav>

            <nav class="site-footer__column" aria-labelledby="footer-support-links">
                <h2 class="site-footer__heading" id="footer-support-links">Customer Support</h2>
                <ul class="site-footer__links">
                    <li><a href="/faq">FAQs</a></li>
                    <li><a href="/subscription-help">Subscription Help</a></li>
                    <li><a href="/shipping-delivery">Delivery Information</a></li>
                    <li><a href="/returns-refunds">Returns &amp; Refunds</a></li>
                    <li><a href="/payment-options">Payment Options</a></li>
                    <li><a href="/track-order">Track Order</a></li>
                </ul>
            </nav>

            <div class="site-footer__column site-footer__contact">
                <h2 class="site-footer__heading">Get in Touch</h2>
                <ul class="site-footer__contact-list">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                            <path d="M7.2 3.8 9.5 7.5 7.9 9.2c1 2.1 2.8 3.9 4.9 4.9l1.7-1.6 3.7 2.3-.7 3.3c-.1.6-.7 1-1.3.9C9.1 17.7 6.3 14.9 5 7.8c-.1-.6.3-1.2.9-1.3l1.3-2.7Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>+91 00000 00000</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                            <rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.7"/>
                            <path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>hello@example.com</span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                            <path d="M19 10c0 5-7 11-7 11S5 15 5 10a7 7 0 1 1 14 0Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                            <circle cx="12" cy="10" r="2.2" stroke="currentColor" stroke-width="1.7"/>
                        </svg>
                        <span>Bengaluru, Karnataka</span>
                    </li>
                </ul>
            </div>

            <div class="site-footer__column site-footer__newsletter">
                <h2 class="site-footer__heading">Stay in the Loop</h2>
                <p class="site-footer__newsletter-copy">
                    Get microgreens tips, recipes and updates from Nirmal Greens.
                </p>
                <form class="site-footer__form" action="#" method="get">
                    <label class="visually-hidden" for="footer-email">Email address</label>
                    <input class="site-footer__email" id="footer-email" name="email" type="email" autocomplete="email" placeholder="Your email address" required>
                    <button class="site-footer__subscribe" type="submit" aria-label="Subscribe to the newsletter">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                            <path d="M4 12h15m-6-6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="site-footer__bottom">
            <p class="site-footer__copyright">&copy; <?= date('Y') ?> Nirmal Greens. All rights reserved.</p>
            <nav class="site-footer__policies" aria-label="Legal policies">
                <a href="/privacy-policy">Privacy Policy</a>
                <a href="/terms-conditions">Terms &amp; Conditions</a>
                <a href="/cookie-policy">Cookie Policy</a>
            </nav>
        </div>
    </div>
</footer>