<?php
require __DIR__ . '/includes/bootstrap.php';
require_once SITE_ROOT . '/includes/enquiry.php';

$page = [
    'key'         => 'home',
    'description' => site('name') . ' offers packers and movers services, home and office shifting, international moving and road freight. Request a written quote.',
];
require SITE_ROOT . '/includes/header.php';

$packingPhoto = photo('packing', 'A packing crew wrapping furniture before loading');
?>

<section class="hero">
    <div class="wrap hero__grid">
        <div class="hero__copy">
            <p class="eyebrow eyebrow--light">Packers &amp; Movers · Freight Logistics</p>
            <h1>Relocation and freight, handled start to finish.</h1>
            <p class="lead">We pack, load, transport and unpack household and office goods, and move commercial freight by road. Tell us the route and we will come back with a written quote.</p>
            <div class="hero__actions">
                <a class="btn btn--primary" href="<?= e(url('contact')) ?>">Get a free quote</a>
                <a class="btn btn--ghost-light" href="<?= e(tel_href()) ?>">Call <?= e((string) site('phone')) ?></a>
            </div>
        </div>

        <div class="quote-card" id="quick-quote">
            <h2>Request a quote</h2>
            <p>Share the basics and we will call you back.</p>
            <?php $variant = 'compact'; $old = []; $errors = []; require SITE_ROOT . '/includes/enquiry-form.php'; ?>
        </div>
    </div>

    <div class="facts">
        <ul class="wrap facts__list">
            <?php foreach ((array) site('commitments') as [$head, $text]): ?>
                <li><strong><?= e($head) ?></strong><span><?= e($text) ?></span></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="section" id="services">
    <div class="wrap">
        <div class="section-head">
            <p class="eyebrow">Services</p>
            <h2>Moving, storage and road freight</h2>
            <p class="lead">From a one-bedroom flat to a full office or a truck-load of cargo. Each service is planned around the route, the load and your date.</p>
        </div>

        <div class="groups">
            <?php foreach ((array) site('services') as $group): ?>
                <div class="group">
                    <h3 class="group__title"><?= e($group['label']) ?></h3>
                    <ul class="rows">
                        <?php foreach ($group['items'] as $item): ?>
                            <li>
                                <a href="<?= e(url('services')) ?>#<?= e($item['slug']) ?>">
                                    <span>
                                        <span class="rows__title"><?= e($item['title']) ?></span>
                                        <span class="rows__text"><?= e($item['summary']) ?></span>
                                    </span>
                                    <span class="rows__go" aria-hidden="true">&rarr;</span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section--tint" id="process">
    <div class="wrap">
        <div class="section-head">
            <p class="eyebrow">How it works</p>
            <h2>From first call to delivery</h2>
        </div>
        <ol class="steps">
            <?php foreach ((array) site('steps') as [$head, $text]): ?>
                <li>
                    <h3><?= e($head) ?></h3>
                    <p><?= e($text) ?></p>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<section class="section">
    <div class="wrap split<?= $packingPhoto ? ' split--photo' : '' ?>">
        <div class="split__intro">
            <p class="eyebrow">Packing</p>
            <h2>Packed for the route, not just the room</h2>
            <p>Cartons and cushioning are chosen for the distance and the type of goods. A shelf of books and a glass-top table do not travel the same way, so they are not packed the same way.</p>
            <a class="link-arrow" href="<?= e(url('services')) ?>#packing-unpacking">About packing and unpacking</a>
            <?= $packingPhoto ?>
        </div>
        <dl class="spec">
            <div><dt>Corrugated cartons</dt><dd>Several sizes, so books are not packed in a wardrobe carton.</dd></div>
            <div><dt>Bubble wrap and foam</dt><dd>For glassware, crockery, frames and electronics.</dd></div>
            <div><dt>Stretch film</dt><dd>Keeps drawers closed and upholstery clean.</dd></div>
            <div><dt>Furniture blankets</dt><dd>With corner guards for edges and polished surfaces.</dd></div>
            <div><dt>Wardrobe boxes</dt><dd>Clothes stay on their hangers from one wardrobe to the next.</dd></div>
            <div><dt>Labels and inventory</dt><dd>Every carton is numbered and listed by room.</dd></div>
        </dl>
    </div>
</section>

<section class="section section--tint" id="coverage">
    <div class="wrap">
        <div class="section-head">
            <p class="eyebrow">Coverage</p>
            <h2>Where we move</h2>
            <p class="lead">Local moves, intercity routes and overseas shipments. Not listed? Ask us; we will tell you what is possible.</p>
        </div>
        <ul class="chips">
            <?php foreach ((array) site('cities') as $city): ?>
                <li><?= e($city) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="section" id="faq">
    <div class="wrap faq-layout">
        <div class="section-head">
            <p class="eyebrow">Questions</p>
            <h2>Before you book</h2>
            <p>The questions we are asked most often. If yours is not here, call us.</p>
        </div>
        <div class="faq">
            <?php foreach ((array) site('faq') as [$q, $a]): ?>
                <details>
                    <summary><?= e($q) ?></summary>
                    <p><?= e($a) ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="wrap cta-band__inner">
        <div>
            <h2>Tell us the route and the date.</h2>
            <p>We will reply with a written quote.</p>
        </div>
        <div class="cta-band__actions">
            <a class="btn btn--primary" href="<?= e(url('contact')) ?>">Request a quote</a>
            <a class="btn btn--ghost-light" href="<?= e(tel_href()) ?>"><?= e((string) site('phone')) ?></a>
        </div>
    </div>
</section>

<?php require SITE_ROOT . '/includes/footer.php'; ?>
