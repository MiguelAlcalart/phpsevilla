<?php

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

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

    $settings = array(
        'consumer_key'              => $app['twitter.consumer_key'],
        'consumer_secret'           => $app['twitter.consumer_secret'],
        'oauth_access_token'        => $app['twitter.oauth_access_token'],
        'oauth_access_token_secret' => $app['twitter.oauth_access_token_secret'],
    );

    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?exclude_replies=1&user_id=2362995296&include_rts=0';
    $requestMethod = 'GET';

    $twitter = new TwitterAPIExchange($settings);
    $api = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

    $tuits = json_decode($api);

    $context = array(
        'events'     => $events,
        'community'  => $community,
        'asistance'  => $asistance,
        'tuits'      => $tuits,
    );

    return $app['twig']->render('homepage.twig', $context);

})->bind('index');

/** 
 * Community Controller
 */
$app->get('/community/{page}', function ($page) use ($app) {

    // Call API
    $client = new Client(['base_url' => $app['meetup.host']]);

    $api = $client->get($app['meetup.namecommunity'], [
        'query' => [
            'key'  => $app['meetup.apitoken'],
        ]
    ]);

    $community = $api->json();

    $api = $client->get($app['meetup.namecommunity'].'/members', [
        'query' => [
            'key'  => $app['meetup.apitoken'],
            'page' => 200,
            'offset' => $page
        ]
    ]);

    $members = $api->json();

    shuffle($members);

    $context = array(
        'community' => $community,
        'members'   => $members,
    );

    return $app['twig']->render('community.twig', $context);

})->bind('community')->value('page', 0);;

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

    $events = array_reverse($api->json());

    $context = array(
    	'events' => $events,
    );

    return $app['twig']->render('events.twig', $context);

})->bind('events');

/** 
 * Event Controller
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
        //'jobs' => $jobs,
    );

    return $app['twig']->render('jobs.twig', $context);

})->bind('jobs');

/** 
 * Contact Controller
 */
$app->get('/contact', function () use ($app) {

    return $app['twig']->render('contact.twig');

})->bind('contact');


return $FrontendController;