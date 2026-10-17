<?php
require __DIR__ . '/includes/bootstrap.php';

header('Content-Type: text/plain; charset=UTF-8');

echo "User-agent: *\n";
echo "Disallow: /includes/\n";
echo "Disallow: /storage/\n";
echo "\n";
echo 'Sitemap: ' . rtrim((string) site('url'), '/') . url('sitemap.xml') . "\n";
