<?php

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");

use AbqOutdoorTrails\AbqBike\{Route, User, FavoriteRoute};

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
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/abqbiketrails.ini");
	$pdo = $secrets->getPdoObject();

	// determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$favoriteRouteRouteId = $id = filter_input(INPUT_GET, "favoriteRouteRouteId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$favoriteRouteUserId = $id = filter_input(INPUT_GET, "favoriteRouteUserId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);


	//handle GET request - if id is present, that route is returned, otherwise all routes are returned
	if($method === "GET") {
		// set XSRF cookie
		setXsrfCookie();

		// gets a specific route based on its composite key
		if($favoriteRouteRouteId !== null && $favoriteRouteUserId !== null) {
			$favoriteRoute = FavoriteRoute::getFavoriteRouteByFavoriteRouteRouteIdAndFavoriteRouteUserId($pdo, $favoriteRouteRouteId, $favoriteRouteUserId);

			$reply->data = $favoriteRoute;

			// if none of the search parameters are met throw an exception
		} else if(empty($favoriteRouteUserId) === false) {
			$reply->data = FavoriteRoute::getFavoriteRoutesByUserId($pdo, $favoriteRouteUserId)->toArray();
			//get all the favorite routes associated with favorite route Id
		} else if(empty($favoriteRouteRouteId) === false) {
			$reply->data = FavoriteRoute::getFavoriteRoutesByRouteId($pdo, $favoriteRouteRouteId)->toArray();
		} else {
			throw new InvalidArgumentException("incorrect search parameters", 404);
		}
	} else if($method === "POST" || $method === "DELETE") {
		// verify xsrf token
		verifyXsrf();

		//enforce the end user has a jwt token
		validateJwtHeader();

		if(empty($_SESSION["user"]) === true) {
			throw(new \InvalidArgumentException("You must be logged in to post comments", 401));
		}

		//decode the response from the front end
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		if(empty($_SESSION["user"]->getUserId()) === true) {
			throw (new\InvalidArgumentException("no user linked to the favorite route"));
		}
		if(empty($requestObject->favoriteRouteRouteId) === true) {
			throw (new \InvalidArgumentException("no route linked to the favorite route"));
		}

		if($method === "POST") {

			// check if the favorite already exists
			$favoriteCheck = FavoriteRoute::getFavoriteRouteByFavoriteRouteRouteIdAndFavoriteRouteUserId($pdo, $requestObject->favoriteRouteRouteId, $_SESSION["user"]->getUserId());
			if(!empty($favoriteCheck) || $favoriteCheck !== null) {
				throw (new InvalidArgumentException("You've already favorited this route", 403));
			}

			$favoriteRoute = new FavoriteRoute($requestObject->favoriteRouteRouteId, $_SESSION["user"]->getUserId());
			$favoriteRoute->insert($pdo);
			$reply->message = "favorite route successful";

		} else if($method === "DELETE") {
			// grab the favorite route by its composite key
			$favoriteRoute = FavoriteRoute::getFavoriteRouteByFavoriteRouteRouteIdAndFavoriteRouteUserId($pdo, $requestObject->favoriteRouteRouteId, $requestObject->favoriteRouteUserId);
			if($favoriteRoute === null) {
				throw(new RuntimeException("Favorite Route does not exist"));
			}

			//enforce the user is signed in and only trying to delete their own favorite route
			if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $favoriteRoute->getFavoriteRouteUserId()->toString()) {
				throw(new \InvalidArgumentException("You are not allowed to delete this Favorite Route", 403));
			}

			//perform the actual delete
			$favoriteRoute->delete($pdo);

			//update the message
			$reply->message = "Favorite route successfully deleted";
		}
	} else {
		// if any other HTTP request is sent throw an exception
		throw new \InvalidArgumentException("invalid http request", 405);
	}
	//catch any exceptions that is thrown and update the reply status and message
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
// encode and return reply to front end caller
echo json_encode($reply);



