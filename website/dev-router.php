<?php
/**
 * Local preview only. Mirrors the rules in .htaccess for PHP's built-in server:
 *
 *   php -S localhost:8000 dev-router.php
 */
$path = rawurldecode((string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if (preg_match('#^/(includes|storage)(/|$)#', $path) || preg_match('#^/(config|dev-router)\.php$#', $path)) {
    http_response_code(403);
    require __DIR__ . '/404.php';
    return true;
}

$routes = ['/sitemap.xml' => 'sitemap.php', '/robots.txt' => 'robots.php'];
if (isset($routes[$path])) {
    require __DIR__ . '/' . $routes[$path];
    return true;
}

if ($path !== '/' && is_file(__DIR__ . $path)) {
    return false; // let the built-in server serve it
}

$name = trim($path, '/') === '' ? 'index' : trim($path, '/');
if (preg_match('/^[a-z0-9-]+$/', $name) && is_file(__DIR__ . "/$name.php")) {
    require __DIR__ . "/$name.php";
    return true;
}

require __DIR__ . '/404.php';
return true;
