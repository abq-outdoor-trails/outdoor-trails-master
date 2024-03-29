<?php

require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");

use AbqOutdoorTrails\AbqBike\User;

/**
 * api for handling sign-In
 *
 * author jdunn33@cnm.edu
 **/
//prepare and empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {

	//start session
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	//grab mySQL statement
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/abqbiketrails.ini");
	$pdo = $secrets->getPdoObject();

	//determine which HTTP method is being used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];


	//If method is post handle the sign in logic
	if($method === "POST") {

		//make sure the XSRF Token is valid
		verifyXsrf();

		//process the request content and decode the json object into a php object
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//check to make sure the password and email field is not empty
		if(empty($requestObject->userEmail) === true) {
			throw(new \InvalidArgumentException("email address not provided.", 401));
		} else {
			$userEmail = filter_var($requestObject->userEmail, FILTER_SANITIZE_EMAIL);
		}

		if(empty($requestObject->userHash) === true) {
			throw(new \InvalidArgumentException("must enter a password.", 401));
		} else {
			$userHash = $requestObject->userHash;
		}

		//grab the profile from the database by the email provided
		$user = User::getUserByUserEmail($pdo, $userEmail);
		if(empty($user) === true) {
			throw(new InvalidArgumentException("Email or password is incorrect.", 401));
		}

//		$user->setUserActivationToken(null);
//		$user->update($pdo);

		//verify hash is correct
		if(password_verify($requestObject->userHash, $user->getUserHash()) === false) {
			throw(new \InvalidArgumentException("Password or email is incorrect.", 401));
		}

		//grab the profile from the database and put it into a session
		$user = User::getUserByUserId($pdo, $user->getUserId());

		$_SESSION["user"] = $user;

		//create the Auth payload
		$authObject = (object)[
			"userId" => $user->getUserId(),
			"userName" => $user->getUserName()
		];

		//create and set the JWT token
		setJwtAndAuthHeader("auth", $authObject);

		$reply->message = "sign in was successful.";
	} else {
		throw(new \InvalidArgumentException("Invalid HTTP method request", 418));

	}
	//if an exception is thrown update the user

} catch(Exception | TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
echo json_encode($reply);