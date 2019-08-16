<?php

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/php/lib/uuid.php";
require_once ("/etc/apache2/capstone-mysql.Secrets.php");

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
	$id = filter_input(INPUT_GET, id, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$routeId = filter_input(INPUT_GET, "routeId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$routeDescription = filter_input(INPUT_GET, "routeDescription", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$routeFile = filter_input(INPUT_GET, "routeFile", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$routeName = filter_input(INPUT_GET, "routeName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$routeSpeedLimit = filter_input(INPUT_GET, "routeSpeedLimit", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$routeType = filter_input(INPUT_GET, "routeSpeedLimit", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	//make sure the id is valid for methods that require it

	if(($method === "DELETE" || $method === "PUT") && (empty(id) === true)) {
		throw(new InvalidArgumentException("id cannot be empty or negative, 402"));
	}

	// handle GET request - if id is present, that route is returned, otherwise all routes are returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		// get a specific route or all routes and update reply
		if(empty(id) === false) {
			$reply->data = Route::getRouteByRouteId($pdo, $id);
			// get a specific route by route type and update reply
		} else if(empty($routeType) === false) {
			$reply->data = Route::getRouteByRouteType($pdo, $routeId);
			// get s specific route by route file and update reply
		} else if(empty($routeFile) === false) {
			$reply->data = Route::getRouteByRouteFile($pdo, $routeFile)->toArray;
		}
	}

	// update the $reply->status $reply->message
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}

header("Content-type: spplication/json");
echo json_encode($reply);
