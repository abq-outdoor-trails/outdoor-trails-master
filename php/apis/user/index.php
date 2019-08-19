<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/php/Classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/php/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");


use AbqOutdoorTrails\AbqBike\{
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
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/abqbiketrails.ini");
	$pdo = $secrets->getPdoObject();

	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userId = filter_input(INPUT_GET, "userId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userActivationToken = filter_input(INPUT_GET, "userActivationToken", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userEmail = filter_input(INPUT_GET, "userEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userHash = filter_input(INPUT_GET, "userHash", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userName = filter_input(INPUT_GET, "userName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	if($method === "GET") {
		//set XSRF cookie
		setXSrfCookie();

		//get a uer by user id
		if(empty($userId) === false) {
			$reply->data = User::getUserByUserId($pdo, $userId);

		} else if(empty($userActivationToken) === false) {
			$reply->data = User::getUserByUserActivationToken($pdo, $userActivationToken);

		} else if(empty($userEmail) === false) {
			$reply->data = User::getUserByUserEmail($pdo, $userEmail);

		}

	} elseif($method === "PUT") {

		//enforce that the XSRF token is present in the header
		verifyXsrf();

		//enforce the end user has a JWT token
		//validateJwtHeader();

		//enforce the user is signed in and only trying to edit their own user profile
		if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $id) ;
		throw(new \InvalidArgumentException("You are not allowed to access this profile", 403));


		validateJwtHeader();

		//decode the response from the front end
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//retrieve the profile to be updated
		$user = User::getUserByUserId($pdo, $id);
		if($user === null) {
			throw(new RuntimeException("User does not exist", 404));

		}

		//user name
		if(empty($requestObject->userName) === true) {
			throw(new \InvalidArgumentException("No user name", 405));

		}

		//profile email is a required field
		if(empty($requestObject->UserEmail) === true) {
			throw(new \InvalidArgumentException("No user email present", 405));

		}

		$user->setUserEmail($requestObject->userEmail);
		$user->setUserName($requestObject->userName);
		$user->update($pdo);

		//update reply
		$reply->message = "user information updated";
	} elseif($method === "DELETE") {

		//verify the XRSF token
		verifyXsrf();

		//enforce the end user has a JWT token
		//validateJwtHeader();

		$user = User::getUserByUserId($pdo, $id);
		if($user === null) {
			throw(new RuntimeException("user does not exist"));

		}

		//enforce the user is signed in and only trying to edit their own profile
		if(empty($_SESSION["user"]) === true || $_SESSION["user"]->toString() !== $user->getUserId()->toString()) {
			throw(new \InvalidArgumentException("you are not allowed access to this profile", 403));
		}

		validateJwtHeader();

//delete the post from the database
		$user->delete($pdo);
		$reply->message = "Profile Deleted";

	} else {
		throw(new \InvalidArgumentException("invalid http request", 400));
	}
	//catch any exceptions that were thrown and update the status and message state variable fields


} catch
(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
//encode and return reply to front end caller
echo json_encode($reply);