<?php

// Define vars
$app['meetup.apitoken']      = '***';
$app['meetup.host']          = 'http://api.meetup.com';
$app['meetup.namecommunity'] = 'PHP-Sevilla';

$app['twitter.consumer_key']              = '***';
$app['twitter.consumer_secret']           = '***';
$app['twitter.oauth_access_token']        = '***';
$app['twitter.oauth_access_token_secret'] = '***';

/* Information about community */
$app['community.namecommunity'] = '***';
$app['community.email']         = '***';

$app['twig.path'] = array(__DIR__.'/../templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');
