<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/local/local.php';

global $emps;

define('EMPS_URL_VARS', 'pp,key,start,ss,sd,sk,sm,sx,sy');

$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$path_parts = explode('/', trim($path, '/'));
array_shift($path_parts);

$pp = isset($path_parts[0]) ? $path_parts[0] : '';
$key = isset($path_parts[1]) ? $path_parts[1] : '';
$start = isset($path_parts[2]) ? $path_parts[2] : '';
$ss = isset($path_parts[3]) ? $path_parts[3] : '';
$sd = isset($path_parts[4]) ? $path_parts[4] : '';
$sk = isset($path_parts[5]) ? $path_parts[5] : '';
$sm = isset($path_parts[6]) ? $path_parts[6] : '';
$sx = isset($path_parts[7]) ? $path_parts[7] : '';
$sy = isset($path_parts[8]) ? $path_parts[8] : '';

print_r($path_parts);
if ($pp === 'api') {
    $endpoint = isset($path_parts[1]) ? $path_parts[1] : '';
    
    if ($endpoint === 'produtos') {
        require_once __DIR__ . '/api/produtos.php';
        exit;
    }
}

$emps->main();
?>