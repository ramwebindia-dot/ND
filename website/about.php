<?php
require __DIR__ . '/includes/bootstrap.php';

$page = [
    'key'         => 'about',
    'title'       => 'About us',
    'description' => 'About ' . site('name') . ': packers and movers and road freight logistics for households, offices and businesses.',
];
require SITE_ROOT . '/includes/header.php';

$teamPhoto = photo('team', 'The ' . site('name') . ' team');

$details = array_filter([
    'Services'    => 'Packers & movers, logistics',
    'Established' => (string) site('established'),
    'GSTIN'       => (string) site('gst'),
    'Office'      => address_line(),
    'Hours'       => (string) site('hours'),
]);

$principles = [
    ['One point of contact', 'A coordinator stays with your job from the quote to the delivery, so you are not repeating yourself to a new person each time.'],
    ['The quote says what is included', 'Packing, labour, vehicle and any extras are listed. If something changes, you hear about it before the day, not on it.'],
    ['Packed for the route', 'Materials are chosen for the distance and the type of goods, and cartons are numbered and listed so that nothing is lost track of.'],
    ['A clear schedule', 'We confirm the date, the time window and the crew in advance, and tell you early if anything shifts.'],
];
?>

<section class="page-head">
    <div class="wrap">
        <p class="eyebrow">About</p>
        <h1>About <?= e((string) site('name')) ?></h1>
    </div>
</section>

<section class="section section--tight">
    <div class="wrap split<?= $teamPhoto ? ' split--photo' : '' ?>">
        <div class="prose">
            <?php foreach ((array) site('about') as $para): ?>
                <p><?= e($para) ?></p>
            <?php endforeach; ?>
            <?= $teamPhoto ?>
        </div>
        <dl class="facts-table">
            <?php foreach ($details as $label => $value): ?>
                <div><dt><?= e($label) ?></dt><dd><?= e($value) ?></dd></div>
            <?php endforeach; ?>
        </dl>
    </div>
</section>

<section class="section section--tint">
    <div class="wrap">
        <div class="section-head">
            <p class="eyebrow">How we work</p>
            <h2>What you can expect</h2>
        </div>
        <ul class="principles">
            <?php foreach ($principles as [$head, $text]): ?>
                <li>
                    <h3><?= e($head) ?></h3>
                    <p><?= e($text) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="cta-band">
    <div class="wrap cta-band__inner">
        <div>
            <h2>Planning a move?</h2>
            <p>Send us the details and we will reply with a written quote.</p>
        </div>
        <div class="cta-band__actions">
            <a class="btn btn--primary" href="<?= e(url('contact')) ?>">Request a quote</a>
            <a class="btn btn--ghost-light" href="<?= e(tel_href()) ?>"><?= e((string) site('phone')) ?></a>
        </div>
    </div>
</section>

<?php require SITE_ROOT . '/includes/footer.php'; ?>
