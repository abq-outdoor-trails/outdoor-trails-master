<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php.classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/php/lib/uuid.php";
require_once("etc/apache2/capstone-mysql/Secrets.php");

use User {
	//we only use the user class for testing purposes
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

}