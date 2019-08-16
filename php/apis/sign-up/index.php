<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";

use AbqOutdoorTrails\AbqBike\User;

/**
 * api for signing up for AbqBike
 *
 * @author wharris21@cnm.edu
 **/

// verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	// grab the MySQL connection

	$secrets = new \Secrets("etc/apache2/capstone-mysql/abqbiketrails.ini");
	$pdo = $secrets->getPdoObject();

	// determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	if($method === "POST") {
		// decode the json and turn it into a php object
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// user name is a required field
		if(empty($requestObject->userName) === true) {
			throw(new \InvalidArgumentException("No user name provided", 405));
		};

		// user email is a required field
		if(empty($requestObject->userEmail) === true) {
			throw(new \InvalidArgumentException("No user email provided", 405));
		}

		// verify that user password is present
		if(empty($requestObject->userHash) === true) {
			throw(new \InvalidArgumentException("Must input valid password", 405));
		}

		if(empty($requestObject->userHashConfirm) === true) {
			throw(new \InvalidArgumentException("Must input valid password", 405));
		}

		// make sure the password and confirm password match
		if($requestObject->userHash !== $requestObject->userHashConfirm) {
			throw(new \InvalidArgumentException("Passwords do not match"));
		}
		$hash = password_hash($requestObject->userHash, PASSWORD_ARGON2I, ["time_cost" => 384]);

		$userActivationToken = bin2hex(random_bytes(16));

		// create the user object
		$user = new User(generateUuidV4(), $userActivationToken, $requestObject->userEmail, "null", $requestObject->userName);

		// insert the user into the database
		$user->insert($pdo);

		// compose the email message to send with the activation token
		$messageSubject = "One step closer to Sticky Head -- Account Activation";

		// building the activation link that can travel to another server and still work.  This is the link that will be clicked to confirm the account.
		// make sure URL is /public_html/api/activation/$activation
		$basePath = dirname($_SERVER["SCRIPT_NAME"], 3);

		// create the path
		$urlglue = $basePath . "api/activation/?activation=" . $userActivationToken;

		// create the redirect link
		$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . $urlglue;
	}
}