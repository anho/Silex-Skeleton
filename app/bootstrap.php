<?php

chdir(__DIR__);
require_once './../vendor/autoload.php';

$app = new Silex\Application();

$files = glob(__DIR__ . '/config/app.{global,local,dev}.php', GLOB_BRACE);
foreach ($files as $file) {
    require_once $file;
}

return $app;