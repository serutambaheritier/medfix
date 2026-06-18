<?php
$file = $_SERVER['REQUEST_URI'];
$root = __DIR__;

// Remove query string for file check
$path = parse_url($file, PHP_URL_PATH);

if (file_exists($root . $path) && is_file($root . $path)) {
    return false; // serve as-is
}

// Check if adding .php helps
if (file_exists($root . $path . '.php')) {
    include $root . $path . '.php';
} else {
    return false; // let PHP server handle it (likely 404)
}
?>
