<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "Classes/autoload.php";
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



















