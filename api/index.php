<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$storagePath = sys_get_temp_dir().DIRECTORY_SEPARATOR.'daily-fit-storage';

foreach (['framework/cache', 'framework/sessions', 'framework/views', 'logs'] as $directory) {
    $path = $storagePath.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $directory);

    if (! is_dir($path)) {
        mkdir($path, 0775, true);
    }
}

require dirname(__DIR__).'/vendor/autoload.php';

/** @var Application $app */
$app = require_once dirname(__DIR__).'/bootstrap/app.php';
$app->useStoragePath($storagePath);

$app->handleRequest(Request::capture());
