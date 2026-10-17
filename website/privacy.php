<?php
require __DIR__ . '/includes/bootstrap.php';

$page = [
    'key'         => 'privacy',
    'title'       => 'Privacy policy',
    'description' => 'How ' . site('name') . ' handles the information you send through this website.',
];
require SITE_ROOT . '/includes/header.php';
?>

<section class="page-head">
    <div class="wrap">
        <p class="eyebrow">Legal</p>
        <h1>Privacy policy</h1>
        <p class="lead">How <?= e((string) site('name')) ?> handles the information you send through this website.</p>
    </div>
</section>

<section class="section section--tight">
    <div class="wrap">
        <div class="legal">
            <h2>What we collect</h2>
            <p>Only what you type into our enquiry form: your name, phone number, and, if you choose to give them, your email address, the service you need, where you are moving from and to, a preferred date and any message.</p>

            <h2>How we use it</h2>
            <p>To reply to your enquiry, prepare a quote and arrange the service you ask for. We do not use it for advertising and we do not sell it.</p>

            <h2>Where it goes</h2>
            <p>Your enquiry is emailed to us and a copy is kept on our web server. We share it with others only when that is needed to carry out your move, or when the law requires it.</p>

            <h2>Cookies and tracking</h2>
            <p>This website does not set cookies and does not use analytics or advertising trackers. Fonts, images and scripts are served from this site.</p>

            <h2>Server logs</h2>
            <p>Our hosting provider may keep standard server logs, such as IP address, pages requested and time of visit, for security and troubleshooting.</p>

            <h2>Your choices</h2>
            <p>You can ask us for a copy of the details you sent, ask us to correct them, or ask us to delete them. Write to <a href="mailto:<?= e((string) site('email')) ?>"><?= e((string) site('email')) ?></a>.</p>

            <h2>Contact</h2>
            <p>
                <?= e((string) (site('legal_name') ?: site('name'))) ?><br>
                <?php if (address_line() !== ''): ?><?= e(address_line()) ?><br><?php endif; ?>
                <a href="<?= e(tel_href()) ?>"><?= e((string) site('phone')) ?></a>
            </p>

            <p class="legal__date">Last updated <?= e(date('j F Y', (int) filemtime(__FILE__))) ?>.</p>
        </div>
    </div>
</section>

<?php require SITE_ROOT . '/includes/footer.php'; ?>
