<?php
require __DIR__ . '/includes/bootstrap.php';

http_response_code(404);
$page = [
    'key'         => '404',
    'title'       => 'Page not found',
    'description' => '',
    'noindex'     => true,
];
require SITE_ROOT . '/includes/header.php';
?>

<section class="page-head page-head--solo">
    <div class="wrap">
        <p class="eyebrow">Error 404</p>
        <h1>We could not find that page</h1>
        <p class="lead">The link may be old or mistyped. These will get you back on track.</p>
        <div class="hero__actions">
            <a class="btn btn--primary" href="<?= e(url()) ?>">Go to the home page</a>
            <a class="btn btn--outline" href="<?= e(url('contact')) ?>">Request a quote</a>
        </div>
    </div>
</section>

<?php require SITE_ROOT . '/includes/footer.php'; ?>
