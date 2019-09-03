<?php
require_once (dirname(__DIR__, 3) . "/lib/xsrf.php");
/**
 * API for grabbing an XSRF
 *
 * GET requests are supported.
 *
 * @author Rochelle Lewis <rlewis37@cnm.edu>
 **/
if(session_status() !== PHP_SESSION_ACTIVE) {session_start();}
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
	if($method === "GET") {
		setXsrfCookie();
		$reply->message = "XSRF set!";
	} else {
		throw (new \InvalidArgumentException("Invalid HTTP request!", 405));
	}
} catch(Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {unset($reply->data);}
echo json_encode($reply);