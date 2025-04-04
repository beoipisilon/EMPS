<?php
if (preg_match('/\.(?:php)$/', $_SERVER["REQUEST_URI"])) {
    return false;
} else {
    require __DIR__ . '/api/produtos.php';
    return true;
} 