<?php

use Symfony\Component\HttpFoundation\Response;

// simplify route binding
$render = function($view) use ($app) {
    return function () use ($app, $view) {
        return $app['twig']->render($view);
    };
};

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => './views',
    'twig.options' => array(
        'strict_variables' => false
    )
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => function() use ($app) {
        return array();
    }
));
$app->get('/', $render('index.twig'))->bind('homepage');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404' : '500';

    return new Response($app['twig']->render('errors/'. $page . '.twig', array('code' => $code)), $code);
});
