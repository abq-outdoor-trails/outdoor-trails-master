<?php

namespace AbqOutdoorTrails\AbqBike;

use Edu\Cnm\DataDesign\{User};

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php";

//grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid/php");

/**
 * Full PHP Unit test for User class
 *
 * This is a complete PHPUnit test of the User class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both valid and invalid inputs.
 *
 * @see User
 * @author JDunn <jdunn33@cnm.edu>
 *
 **/
class UserTest extends DataDesignTest {
	/**
	 * User that created this profile; this is for the foreign key relations
	 * @var User user
	 *
	 **/
	protected $user = null;

	/**
	 * valid user id to create the user object to own the test
	 *
	 * @var $VALID_USER_ID
	 *
	 **/
	protected $VALID_USER_ID;

	/**
	 * valid user name to create user object to test?
	 *
	 * @var $VALID_USER_NAME
	 *
	 **/
	protected $VALID_USER_NAME;

	/**
	 * valid user email to create the object to test
	 *
	 * @var $VALID_USER_EMAIL
	 *
	 **/
	protected $VALID_EMAIL;

	/**
	 * valid user hash to create the object to test
	 *
	 * @var $VALID_USER_HASH
	 *
	 **/
	protected $VALID_HASH;

	/**
	 * valid user activation token to create the object for test
	 *
	 * @var $VALID_USER_ACTIVATION_TOKEN
	 *
	 **/
	protected $VALID_ACTIVATION;

	/**
	 * run the default setup operation to create salt and hash
	 *
	 **/
	public final function setUp() : void {
		parent::setUp();

		//
		$password = "abc123";
		$this->VALID_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));
	}

	/**
	 *
	 *
	 **/
}

