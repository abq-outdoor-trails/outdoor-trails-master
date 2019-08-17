<?php

require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/abqbiketrails-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "lib/jwt.php";
require_once("/etc/apache2/abqbiketrails-mysql/Secrets.php");

use AbqOutdoorTrails\User;

/**
 * api for handling sign-in
 *
 * author jdunn33@cnm.edu
**/
//prepare and empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try{

	//start session
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	//grab mySQL statement
	$secrets = new \Secrets("/etc/apache2/abqbiketrails-mySQL/abqbiketrails.ini");
	$pdo = $secrets->getPdoObject();

	//determine which HTTP method is being used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];


	//If method is post handle the sign in logic
	if($method === "POST") {

		//make sure the XSRF Token is valid
		verifyXsrf();

		//process the request content and decode the json object into a php object
		$requestContent = file_get_contents("php://input");
		$requestOject = json_decode("$requestContent");

		//check to make sure the password and email field is not empty
		if(empty($requestOject->userEmail) === true) {
			throw(new \InvalidArgumentException("email address not provided.", 401));
		}else {
			$userEmail = filter_var($requestOject->userEmail, FILTER_SANITIZE_EMAIL);
		}

		if(empty($requestOject->))
	}
}