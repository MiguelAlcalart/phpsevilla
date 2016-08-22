<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\SerializerServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new SerializerServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SwiftmailerServiceProvider());
$app->register(new Silex\Provider\HttpFragmentServiceProvider());
$app->register(new FormServiceProvider());

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'=> array(
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'dbname',
        'user'     => 'user',
        'password' => 'password',
        'charset'  => 'utf8'
    ),
    'db.dbal.class_path'   => __DIR__.'/vendor',
    'db.common.class_path' => __DIR__.'/vendor',
));

$app['swiftmailer.options'] = array(
    'host'       => 'servermail.com',
    'port'       => '465',
    'username'   => 'user@servermail.com',
    'password'   => '*******',
    'encryption' => 'ssl',
    'auth_mode'  => null
);

$app->mount('/', include 'FrontendController.php');

$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());

    $translator->addResource('yaml', __DIR__.'/../translations/en.yml', 'en');
    $translator->addResource('yaml', __DIR__.'/../translations/es.yml', 'es');

    return $translator;
}));

return $app;
