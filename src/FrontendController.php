<?php

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

$FrontendController = $app['controllers_factory'];


/** 
 * Frontend Controller
 */
$app->get('/', function () use ($app) {

	// Call API
    $client = new Client(['base_url' => $app['meetup.host']]);

    $api = $client->get($app['meetup.namecommunity'].'/events', [
        'query' => [
            'token'  => $app['meetup.apitoken'],
            'status' => 'past',
        ]
    ]);

    $events = $api->json();

    $context = array(
    	'events'     => $events,
    );

    return $app['twig']->render('homepage.twig', $context);

})->bind('index');



/** 
 * Events Controller
 */
$app->get('/events', function () use ($app) {

	$events = array();

    $context = array(
    	'events' => $events,
    );

    return $app['twig']->render('events.twig', $context);

})->bind('events');



return $FrontendController;