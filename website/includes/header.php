<?php
/**
 * Opens the page. Set $page before including:
 *   key          home | services | about | contact | 404
 *   title        page title (omit on the home page)
 *   description  meta description
 *   noindex      true to keep the page out of search results
 */
defined('SITE_ROOT') or exit;

$key         = $page['key'] ?? 'home';
$siteName    = (string) site('name');
$title       = !empty($page['title']) ? $page['title'] . ' | ' . $siteName : $siteName . ' | ' . site('tagline');
$description = $page['description'] ?? '';
$canonical   = rtrim((string) site('url'), '/') . url($key === 'home' ? '' : $key);
$ogImage     = rtrim((string) site('url'), '/') . url('assets/img/og-image.png');

$nav = [
    'home'     => ['Home', ''],
    'services' => ['Services', 'services'],
    'about'    => ['About', 'about'],
    'contact'  => ['Contact', 'contact'],
];
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title) ?></title>
    <?php if ($description !== ''): ?><meta name="description" content="<?= e($description) ?>"><?php endif; ?>

    <?php if (!empty($page['noindex'])): ?><meta name="robots" content="noindex"><?php endif; ?>
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta name="theme-color" content="#0a3d6b">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e($siteName) ?>">
    <meta property="og:title" content="<?= e($title) ?>">
    <meta property="og:description" content="<?= e($description) ?>">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta property="og:image" content="<?= e($ogImage) ?>">

    <link rel="icon" type="image/png" href="<?= e(asset('assets/img/favicon.png')) ?>">
    <link rel="apple-touch-icon" href="<?= e(asset('assets/img/apple-touch-icon.png')) ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600&amp;family=Source+Serif+4:opsz,wght@8..60,500;8..60,600&amp;display=swap">
    <link rel="stylesheet" href="<?= e(asset('assets/css/style.css')) ?>">
    <script>document.documentElement.className = 'js';</script>

    <?php if ($key === 'home'): ?>
    <script type="application/ld+json"><?= json_encode(array_filter([
        '@context'    => 'https://schema.org',
        '@type'       => 'MovingCompany',
        'name'        => $siteName,
        'url'         => rtrim((string) site('url'), '/') . '/',
        'telephone'   => site('phone'),
        'email'       => site('email'),
        'image'       => $ogImage,
        'description' => $description,
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => site('address')['line1'] ?? '',
            'addressLocality' => site('address')['city'] ?? '',
            'addressRegion'   => site('address')['state'] ?? '',
            'postalCode'      => site('address')['pin'] ?? '',
            'addressCountry'  => 'IN',
        ],
    ]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
    <?php endif; ?>
</head>
<body class="page-<?= e($key) ?>">
<a class="skip-link" href="#main">Skip to content</a>

<header class="brandbar">
    <div class="wrap brandbar__inner">
        <a class="brand" href="<?= e(url()) ?>" aria-label="<?= e($siteName) ?> home">
            <?php if (site('logo') !== ''): ?>
                <img src="<?= e(asset((string) site('logo'))) ?>" alt="<?= e($siteName) ?>" width="160" height="79">
            <?php else: ?>
                <span class="brand__name"><?= e($siteName) ?></span>
                <span class="brand__tag"><?= e((string) site('tagline')) ?></span>
            <?php endif; ?>
        </a>

        <ul class="contact-strip">
            <li>
                <span class="contact-strip__label">Call us</span>
                <a href="<?= e(tel_href()) ?>"><?= e((string) site('phone')) ?></a>
            </li>
            <li>
                <span class="contact-strip__label">Email</span>
                <a href="mailto:<?= e((string) site('email')) ?>"><?= e((string) site('email')) ?></a>
            </li>
            <?php if (site('hours') !== ''): ?>
            <li>
                <span class="contact-strip__label">Open</span>
                <span><?= e((string) site('hours')) ?></span>
            </li>
            <?php endif; ?>
        </ul>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
            <span class="nav-toggle__bars" aria-hidden="true"></span>
            <span class="nav-toggle__text">Menu</span>
        </button>
    </div>
</header>

<nav class="navbar" id="primary-nav" aria-label="Primary">
    <div class="wrap navbar__inner">
        <ul class="nav">
            <?php foreach ($nav as $k => [$label, $path]): ?>
                <li><a href="<?= e(url($path)) ?>"<?= $k === $key ? ' aria-current="page"' : '' ?>><?= e($label) ?></a></li>
            <?php endforeach; ?>
        </ul>
        <a class="btn btn--primary btn--small navbar__cta" href="<?= e(url('contact')) ?>">Get a free quote</a>
    </div>
</nav>

<main id="main">
