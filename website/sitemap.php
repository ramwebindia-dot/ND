<?php
require __DIR__ . '/includes/bootstrap.php';

header('Content-Type: application/xml; charset=UTF-8');

$base  = rtrim((string) site('url'), '/');
$pages = ['' => 'index.php', 'services' => 'services.php', 'about' => 'about.php', 'contact' => 'contact.php'];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($pages as $path => $file) {
    printf(
        "  <url><loc>%s</loc><lastmod>%s</lastmod></url>\n",
        e($base . url($path)),
        date('Y-m-d', (int) filemtime(SITE_ROOT . '/' . $file))
    );
}
echo "</urlset>\n";
