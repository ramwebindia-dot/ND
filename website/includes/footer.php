<?php defined('SITE_ROOT') or exit; ?>
</main>

<footer class="site-footer">
    <div class="wrap site-footer__grid">
        <div class="site-footer__about">
            <p class="site-footer__name"><?= e((string) site('name')) ?></p>
            <p><?= e((string) site('tagline')) ?></p>
            <?php if (site('legal_name') !== ''): ?><p class="site-footer__small"><?= e((string) site('legal_name')) ?></p><?php endif; ?>
            <?php if (site('gst') !== ''): ?><p class="site-footer__small">GSTIN <?= e((string) site('gst')) ?></p><?php endif; ?>
        </div>

        <div>
            <h2 class="site-footer__title">Services</h2>
            <ul>
                <?php foreach ((array) site('services') as $group): foreach ($group['items'] as $item): ?>
                    <li><a href="<?= e(url('services')) ?>#<?= e($item['slug']) ?>"><?= e($item['title']) ?></a></li>
                <?php endforeach; endforeach; ?>
            </ul>
        </div>

        <div>
            <h2 class="site-footer__title">Company</h2>
            <ul>
                <li><a href="<?= e(url()) ?>">Home</a></li>
                <li><a href="<?= e(url('services')) ?>">Services</a></li>
                <li><a href="<?= e(url('about')) ?>">About</a></li>
                <li><a href="<?= e(url('contact')) ?>">Request a quote</a></li>
            </ul>
        </div>

        <div>
            <h2 class="site-footer__title">Contact</h2>
            <ul>
                <li><a href="<?= e(tel_href()) ?>"><?= e((string) site('phone')) ?></a></li>
                <li><a href="mailto:<?= e((string) site('email')) ?>"><?= e((string) site('email')) ?></a></li>
                <?php if (address_line() !== ''): ?><li><?= e(address_line()) ?></li><?php endif; ?>
                <?php if (site('hours') !== ''): ?><li><?= e((string) site('hours')) ?></li><?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="wrap site-footer__base">
        <p>&copy; <?= date('Y') ?> <?= e((string) (site('legal_name') ?: site('name'))) ?>. All rights reserved.</p>
    </div>
</footer>

<nav class="mobile-bar" aria-label="Quick contact">
    <a href="<?= e(tel_href()) ?>">Call</a>
    <a href="<?= e(whatsapp_href('Hello, I would like a quote for a move.')) ?>" rel="noopener">WhatsApp</a>
    <a class="mobile-bar__quote" href="<?= e(url('contact')) ?>">Get a quote</a>
</nav>

<script src="<?= e(asset('assets/js/main.js')) ?>" defer></script>
</body>
</html>
