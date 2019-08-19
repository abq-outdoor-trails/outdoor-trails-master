<?php
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";
require_once dirname(__DIR__, 2) . "Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");

use AbqOutdoorTrails\AbqBike\User;

/**
 * API to check profile activation status
 * @author wharris21@cnm.edu
 **/
// check the session, if it is not active start the session
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	// grab the MySQL connection
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/abqbiketrails.ini");
	$pdo = $secrets->getPdoObject();

	// check the HTTP method being used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// sanitize input
	$activation = filter_input(INPUT_GET, "activation", FILTER_SANITIZE_STRING);

	// make sure the activation token is the correct size
	if(strlen($activation) !== 32) {
		throw(new \InvalidArgumentException("Activation has incorrect length", 405));
	}

	// verify that the activation token is a hexidecimal string value
	if(ctype_xdigit($activation) === false) {
		throw(new \InvalidArgumentException("Activation is empty or has invalid contents", 405));
	}

	// handle the GET HTTP request
	if($method === "GET") {
		// set XSRF cookie
		setXsrfCookie();

		// find user associated with the activation token
		$user = User::getUserByUserActivationToken($pdo, $activation);

		// verify the user is not null
		if($user !== NULL) {
			// make sure the activation token matches
			if($activation === $user->getUserActivationToken()) {
				// set activation to null
				$user->setUserActivationToken(NULL);

				// update the user in the database
				$user->update($pdo);

				// set the reply for the end user TODO make sure this is an accurate redirect message -- are we planning to redirect to profile view?  Main view?
				$reply->data = "Thank you for activating your account! You will be auto-redirected to your profile shortly...";
			}
		} else {
			// throw an exception if the activation token does not exist
			throw(new \RuntimeException("Profile with this activation code does not exist", 404));
		}
	} else {
		// throw an exception if the HTTP request is not a GET method
		throw(new \InvalidArgumentException("Invalid HTTP method request", 403));
	}

	// update the reply object's status and message state variables if an exception or type error was thrown
} catch(\Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(\TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

// prepare and send the reply
header("Content type: application/json");
if($reply->data === NULL) {
	unset($reply->data);
}
echo json_encode($reply);