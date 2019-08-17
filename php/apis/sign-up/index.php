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
		$messageSubject = "One step closer to Abq Bike -- Account Activation";

		// building the activation link that can travel to another server and still work.  This is the link that will be clicked to confirm the account.
		// make sure URL is /public_html/api/activation/$activation
		$basePath = dirname($_SERVER["SCRIPT_NAME"], 3);

		// create the path
		$urlglue = $basePath . "api/activation/?activation=" . $userActivationToken;

		// create the redirect link
		$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . $urlglue;

		// compose message to send with email
		$message = <<< EOF
		<h2>Welcome to AbqBike!</h2>
		<p>In order to start finding great bike routes in your area, you must confirm your account.</p>
		<p><a href="$confirmLink">$confirmLink</a></p>
		EOF;

		// create swift email
		$swiftMessage = new Swift_Message();

		// attach the sender to the message
		// this takes the form of an associative array where the email is the key to a real name
		$swiftMessage->setFrom(["wharris21@cnm.ed" => "wharris"]);


		/**
		 * attach recipients to the message
		 * this is an array that can include or omit the recipient's name
		 * use recipient's real name where possible;
		 * this reduces probability the email is marked as spam
		 **/
		// define who the recipient is
		$recipients = [$requestObject->userEmail];
		// set the recipient to the swift message
		$swiftMessage->setTo($recipients);

		// attach the subject line to the email message
		$swiftMessage->setSubject($messageSubject);

		/**
		 * attach the message to the email
		 * set two versions of the message -- a HTML formatted version and a filter_var() version, in plain text
		 * this displays the entire $confirmLink to pain text
		 * this allows users who are not viewing HTML content to still access the link
		 **/
		// attach the HTML version of the message
		$swiftMessage->setBody($message, "text/html");

		// attach the plain text version of the message
		$swiftMessage->addPart(html_entity_decode($message), "text/plain");

		/**
		 * send the email via SMTP; here it is configured to relay everything upstream via CNM servers
		 * this may or may not be available to all web hosts; todo consult host documentation for details
		 * SwiftMailer supports many different transport methods; SMTP was chosen because it's the most compatible and has the best error handling
		 * @see http://swiftmailer.org/docs/sending.html Sending Messages - Documentation - SwitftMailer
		 **/
		// setup SMTP
		$smtp = new Swift_SmtpTransport("localhost", 25);
		$mailer = new Swift_Mailer($smtp);

		// send the message
		$numSent = $mailer->send($swiftMessage, $failedRecipients);

		/**
		 * the send method returns the number of recipients that accepted the email
		 * if the number attempted is not the number accepted, this is an exception
		 **/
		if($numSent !== count($recipients)) {
			// the $failedRecipients parameter passed in the send() method now contains an array of the emails that failed
			throw(new \RuntimeException("Unable to send email", 400));
		}

		// update reply
		$reply->message = "Thank you for creating a profile with AbqBike!";
	} else {
		throw(new \InvalidArgumentException("Invalid HTTP request"));
	}
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
	$reply->trace = $exception->getTraceAsString();
}

header("Content-type: application/json");
echo json_encode($reply);