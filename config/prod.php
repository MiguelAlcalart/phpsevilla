<?php

// Define vars
$app['meetup.apitoken']      = '***********';
$app['meetup.namecommunity'] = 'PHP-Sevilla';
$app['meetup.host']          = 'http://api.meetup.com',

$app['twig.path'] = array(__DIR__.'/../templates/phpsevilla');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');
