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

    $asistance = 0;
    foreach ($events as $event) {
        $asistance += $event['yes_rsvp_count'];
    }

    $api = $client->get($app['meetup.namecommunity'], [
        'query' => [
            'key'  => $app['meetup.apitoken'],
        ]
    ]);

    $community = $api->json();

    $context = array(
        'events'     => $events,
        'community'  => $community,
        'asistance'  => $asistance,
    );

    return $app['twig']->render('homepage.twig', $context);

})->bind('index');

/** 
 * Community Controller
 */
$app->get('/community', function () use ($app) {

    // Call API
    $client = new Client(['base_url' => $app['meetup.host']]);

    $api = $client->get($app['meetup.namecommunity'], [
        'query' => [
            'key'  => $app['meetup.apitoken'],
        ]
    ]);

    $community = $api->json();

    $context = array(
        'community' => $community,
    );

    return $app['twig']->render('community.twig', $context);

})->bind('community');

/** 
 * Events Controller
 */
$app->get('/events', function () use ($app) {

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
    	'events' => $events,
    );

    return $app['twig']->render('events.twig', $context);

})->bind('events');

/** 
 * Events Controller
 */
$app->get('/events/{id}', function ($id) use ($app) {

    // Call API
    $client = new Client(['base_url' => $app['meetup.host']]);

    $api = $client->get($app['meetup.namecommunity'].'/events/'.$id, [
        'query' => [
            'token'  => $app['meetup.apitoken'],
        ]
    ]);

    $event = $api->json();

    $context = array(
        'event' => $event,
    );

    return $app['twig']->render('event.twig', $context);

})->bind('event');

/** 
 * Jobs Controller
 */
$app->get('/jobs', function () use ($app) {

    $context = array(
        'jobs' => $jobs,
    );

    return $app['twig']->render('jobs.twig', $context);

})->bind('jobs');

/** 
 * Jobs Controller
 */
$app->get('/contact', function () use ($app) {

    return $app['twig']->render('contact.twig');

})->bind('contact');


return $FrontendController;