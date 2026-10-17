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

/** An <img> inside a <figure>, or '' when the file has not been added to assets/img. */
function photo(string $name, string $alt, string $class = 'photo'): string
{
    foreach (['jpg', 'jpeg', 'webp', 'png'] as $ext) {
        $rel = "assets/img/$name.$ext";
        $file = SITE_ROOT . '/' . $rel;
        if (is_file($file)) {
            [$w, $h] = getimagesize($file) ?: [0, 0];
            $size = $w && $h ? sprintf(' width="%d" height="%d"', $w, $h) : '';
            return '<figure class="' . e($class) . '"><img src="' . e(asset($rel)) . '" alt="' . e($alt) . '"' . $size . ' loading="lazy"></figure>';
        }
    }
    return '';
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
