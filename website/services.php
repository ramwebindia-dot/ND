<?php
require __DIR__ . '/includes/bootstrap.php';

$page = [
    'key'         => 'services',
    'title'       => 'Services',
    'description' => 'Home shifting, office relocation, international moving, packing, storage and road freight by ' . site('name') . '. See what each service includes.',
];
require SITE_ROOT . '/includes/header.php';
?>

<section class="page-head">
    <div class="wrap">
        <p class="eyebrow">Services</p>
        <h1>What we do, and what is included</h1>
        <p class="lead">Every job is quoted in writing. The lists below show what each service normally covers, so you know what to ask for.</p>
    </div>
</section>

<?php foreach ((array) site('services') as $group): ?>
<section class="section section--tight">
    <div class="wrap">
        <h2 class="group-heading"><?= e($group['label']) ?></h2>

        <?php foreach ($group['items'] as $item): ?>
            <article class="service" id="<?= e($item['slug']) ?>">
                <div class="service__main">
                    <h3><?= e($item['title']) ?></h3>
                    <p><?= e($item['description']) ?></p>
                    <a class="link-arrow" href="<?= e(url('contact') . '?service=' . rawurlencode($item['title']) . '#enquiry') ?>">Ask about this service</a>
                </div>
                <div class="service__list">
                    <p class="service__label">Usually includes</p>
                    <ul class="ticks">
                        <?php foreach ($item['includes'] as $line): ?>
                            <li><?= e($line) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<?php endforeach; ?>

<section class="cta-band">
    <div class="wrap cta-band__inner">
        <div>
            <h2>Not sure which service you need?</h2>
            <p>Describe what you are moving and we will suggest the simplest way to do it.</p>
        </div>
        <div class="cta-band__actions">
            <a class="btn btn--primary" href="<?= e(url('contact')) ?>">Request a quote</a>
            <a class="btn btn--ghost-light" href="<?= e(tel_href()) ?>"><?= e((string) site('phone')) ?></a>
        </div>
    </div>
</section>

<?php require SITE_ROOT . '/includes/footer.php'; ?>
