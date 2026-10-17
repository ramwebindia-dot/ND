<?php
declare(strict_types=1);

if (!defined('SITE_ROOT')) {
    define('SITE_ROOT', dirname(__DIR__));
}

$GLOBALS['site_config'] = require SITE_ROOT . '/config.php';
date_default_timezone_set((string) ($GLOBALS['site_config']['timezone'] ?? 'UTC'));

/** Read a value from config.php. */
function site(string $key, mixed $default = ''): mixed
{
    return $GLOBALS['site_config'][$key] ?? $default;
}

/** Escape for HTML output. */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Site-relative URL. url('') is the home page, url('contact') is /contact. */
function url(string $path = ''): string
{
    return rtrim((string) site('base_path'), '/') . '/' . ltrim($path, '/');
}

/** URL of a file under the site root, with a cache-busting version. */
function asset(string $path): string
{
    $file = SITE_ROOT . '/' . ltrim($path, '/');
    $version = is_file($file) ? '?v=' . filemtime($file) : '';
    return url($path) . $version;
}

function tel_href(): string
{
    return 'tel:' . preg_replace('/[^\d+]/', '', (string) site('phone'));
}

function whatsapp_href(string $text = ''): string
{
    $number = preg_replace('/\D+/', '', (string) (site('whatsapp') ?: site('phone')));
    return 'https://wa.me/' . $number . ($text !== '' ? '?text=' . rawurlencode($text) : '');
}

function address_line(): string
{
    $a = (array) site('address', []);
    $place = trim(implode(', ', array_filter([$a['city'] ?? '', $a['state'] ?? ''])));
    if (!empty($a['pin'])) {
        $place .= ' ' . $a['pin'];
    }
    return trim(implode(', ', array_filter([$a['line1'] ?? '', trim($place)])));
}

/** Path (relative to the site root) of assets/img/<name>.{jpg,jpeg,webp,png}, or '' if none was added. */
function photo_file(string $name): string
{
    foreach (['jpg', 'jpeg', 'webp', 'png'] as $ext) {
        $rel = "assets/img/$name.$ext";
        if (is_file(SITE_ROOT . '/' . $rel)) {
            return $rel;
        }
    }
    return '';
}

/** Public URL of a photo, or '' when the file has not been added to assets/img. */
function photo_url(string $name): string
{
    $rel = photo_file($name);
    return $rel !== '' ? asset($rel) : '';
}

/** An <img> inside a <figure>, or '' when the file has not been added to assets/img. */
function photo(string $name, string $alt, string $class = 'photo'): string
{
    $rel = photo_file($name);
    if ($rel === '') {
        return '';
    }
    [$w, $h] = getimagesize(SITE_ROOT . '/' . $rel) ?: [0, 0];
    $size = $w && $h ? sprintf(' width="%d" height="%d"', $w, $h) : '';
    return '<figure class="' . e($class) . '"><img src="' . e(asset($rel)) . '" alt="' . e($alt) . '"' . $size . ' loading="lazy"></figure>';
}

/** All service titles, for the enquiry form's drop-down. */
function service_options(): array
{
    $titles = [];
    foreach ((array) site('services', []) as $group) {
        foreach ($group['items'] as $item) {
            $titles[] = $item['title'];
        }
    }
    $titles[] = 'Something else';
    return $titles;
}
