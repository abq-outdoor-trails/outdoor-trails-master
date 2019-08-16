<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php.classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/php/lib/uuid.php";
require_once("etc/apache2/capstone-mysql/Secrets.php");

use namespace: AbqOutdoorTrails\AbqBike {
					User
};

/**
 *api for the user class
 *
 * @author {} <jdunn33@cnm.edu>
 *
 *
 **/
//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$secrets = new \Secrets("/etc/apache2/captstone-mysql/abqbiketrails.ini");
	$pdo = $secrets->getPdoObject();

	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id" FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			$userId = filter_input(INPUT_GET, "userId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			$userActivationToken = filter_input(INPUT_GET, "userActivationToken", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			$userEmail = filter_input(INPUT_GET, "userEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			$userHash = filter_input(INPUT_GET, "userHash", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			$userName = filter_input(INPUT_GET, "userName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

			//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true)) {
		throw(new InvalidArgumentException(("id cannot be empty or negative", 405));
	} else if($method === "PUT" || $method === "POST") {
		//enforce the user has an XSRF token
		verifyXSrf();

		//Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.
		$requestContest = file_get_contents("php://input");

		//This Line Then decodes the JSON package and stores that result in $requestObject

		$requestObject = json_decode($requestContest);

		//make sure the user is available (require field)
		if(empty($requestObject->))
	}
}