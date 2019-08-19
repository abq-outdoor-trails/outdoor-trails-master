<?php

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/php/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql.Secrets.php");

use AbqOutdoorTrails\AbqBike\{Route};

/**
 * api for the route class
 *
 * @author {} <canderson73@cnm.edu>
 */

//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	// grab the mySQL connection
	$secrets = new \Secrets("etc/apache2/capstone-mysql/abqbiketrails.ini");
	$pdo = $secrets->getPdoObject();

	// determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$favoriteRouteUserId = $id = filter_input(INPUT_GET, "favoriteRouteUserId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$favoriteRouteRouteId = $id= filter_input(INPUT_GET, "favoriteRouteRouteId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true)) {
		throw(new InvalidArgumentException("route id cannot be empty or negative", 402));
	}

	//handle GET request - if id is present, that route is returned, otherwise all routes are returned
	if($method === "GET") {
		// set XSRF cookie
		setXsrfCookie();

		// gets a specific route based on its composite key
		if ($favoriteRouteRouteId !== null && $favoriteRouteUserId !== null) {
			$favoriteRoute= \AbqOutdoorTrails\AbqBike\FavoriteRoute::getFavoriteRouteByFavoriteRouteRouteIdAndFavoriteRouteUserId($pdo, $favoriteRouteRouteId, $favoriteRouteUserId);

			if($favoriteRoute!== null) {
				$reply->data=$favoriteRoute;
			}
			// if none of the search parameters are met throw an exception
		} else if(empty($favoriteRouteUserId) === false) {
			$reply->data = \AbqOutdoorTrails\AbqBike\FavoriteRoute::getFavoriteRouteByUserId($pdo, $favoriteRouteRouteId)->toArray();
			//get all the favorite routes associated with favorite route Id
		} else if(empty($favoriteRouteRouteId) === false) {
			$reply->data = \AbqOutdoorTrails\AbqBike\FavoriteRoute::getFavoriteRoutesByRouteId($pdo, $favoriteRouteRouteId)->toArray();
		} else {
			throw new InvalidArgumentException("incorrect search parameters", 404);
		}

 }
}


