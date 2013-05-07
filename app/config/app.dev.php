<?php

if (!$app['debug']) {
    return;
}

$app->register($p = new Silex\Provider\WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => './cache/profiler'
));
$app->mount('/dev/profiler', $p);

$app->get('/dev/render/{tpl}', function($tpl) use ($app) {
    return $app['twig']->render($tpl . '.twig');
});
