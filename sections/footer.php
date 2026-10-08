<footer class="site-footer" id="site-footer" aria-label="Nirmal Greens footer">
    <div class="container site-footer__container">
        <div class="row g-4 g-xl-5 site-footer__main">
            <div class="col-12 col-md-6 col-lg-4 site-footer__brand-column">
                <a class="site-footer__brand" href="/">
                    <img class="site-footer__logo" src="/img/nirmal-greens-logo.png" alt="Nirmal Greens" width="150" decoding="async">
                </a>
                <p class="site-footer__description">Fresh microgreens for your everyday meals.</p>
            </div>

            <nav class="col-6 col-md-3 col-lg-2 site-footer__column" aria-labelledby="footer-quick-links">
                <h2 class="site-footer__heading" id="footer-quick-links">Quick Links</h2>
                <ul class="site-footer__links">
                    <li><a href="/">Home</a></li>
                    <li><a href="#microgreens">Microgreens</a></li>
                    <li><a href="#subscriptions">Subscriptions</a></li>
                    <li><a href="#recipes">Recipes</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>

            <nav class="col-6 col-md-3 col-lg-3 site-footer__column" aria-labelledby="footer-support-links">
                <h2 class="site-footer__heading" id="footer-support-links">Help &amp; Support</h2>
                <ul class="site-footer__links">
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#shipping">Shipping &amp; Delivery</a></li>
                    <li><a href="#returns">Returns &amp; Refunds</a></li>
                    <li><a href="#subscription-help">Subscription Help</a></li>
                    <li><a href="#track-order">Track Order</a></li>
                </ul>
            </nav>

            <div class="col-12 col-lg-3 site-footer__column site-footer__newsletter">
                <h2 class="site-footer__heading">Stay in the Loop</h2>
                <form class="site-footer__form" action="#" method="get">
                    <label class="visually-hidden" for="footer-email">Email address</label>
                    <input class="site-footer__email" id="footer-email" name="email" type="email" autocomplete="email" placeholder="Your email address" required>
                    <button class="site-footer__subscribe" type="submit">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="site-footer__bottom">
            <p class="site-footer__copyright">&copy; <?= date('Y') ?> Nirmal Greens. All rights reserved.</p>
            <nav class="site-footer__policies" aria-label="Legal policies">
                <a href="#privacy">Privacy Policy</a>
                <a href="#terms">Terms &amp; Conditions</a>
                <a href="#cookies">Cookie Policy</a>
            </nav>
        </div>
    </div>
</footer>