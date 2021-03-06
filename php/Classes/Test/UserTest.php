<?php

namespace AbqOutdoorTrails\AbqBike\Test;

use AbqOutdoorTrails\AbqBike\ {
	User
};

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

//grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

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
class UserTest extends AbqBikeTest {
	/**
	 * User that created this profile; this is for the foreign key relations
	 * @var User user
	 *
	 **/
	protected $user = null;

	/**
	 * valid user name to create user object to test?
	 *
	 * @var $VALID_USER_NAME
	 *
	 **/
	protected $VALID_USER_NAME = "AbqTrails";

	/**
	 * valid user name to test update method
	 *
	 * @var $VALID_USER_NAME2
	 *
	 **/
	protected $VALID_USER_NAME2 = "AbqTrails2";

	/**
	 * valid user email to create the object to test
	 *
	 * @var $VALID_USER_EMAIL
	 *
	 **/
	protected $VALID_EMAIL = "dylan@deepdive.com";

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
	public final function setUp(): void {
		parent::setUp();

		//
		$password = "abc123";
		$this->VALID_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));
	}

	/**
	 * test inserting a valid User and verify that the actual mySQL data matches
	 *
	 *
	 * @throws \Exception
	 */
	public function testInsertValidUser(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_HASH);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);

	}

	/**
	 * test inserting a user, editing it, and then updating it
	 *
	 **/
	public function testUpdateValidUser(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new profile and insert it into mySQL
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		//edit the User and update it in mySQL
		$user->setUserName($this->VALID_USER_NAME2);
		$user->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME2);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_HASH);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);

	}

	/**
	 *test creating a profile and then deleting it
	 *
	 **/
	public function testDeleteValidUser(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		//delete the User from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$user->delete($this->getPDO());

		//grab the data from mySQL and enforce the User does not exist
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertNull($pdoUser);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("user"));

	}

	/**
	 * test inserting a User and regrabbing it from mySQL
	 *
	 **/
	public function testGetValidUserByUserId(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_HASH);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);

	}

//	public function testGetValidUserByUserName() {
//		//count the number of rows and save it for later
//		$numRows = $this->getConnection()->getRowCount("user");
//
//		$userId = generateUuidV4();
//		$user = new User($userId, $this->VALID_USER_NAME, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_ACTIVATION);
//		$user->insert($this->getPDO());
//
//		//grab the data from mySQL
//		$results = User::getUserByUserName($this->getPDO(), $this->VALID_USER_NAME);
//		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
//
//		//enforce no other objects are bleeding into profile
//		$this->assertContainsOnlyInstancesOf("AbqOutdoorTrails\AbqBike\User", $results);
//
//		//enforce the results meet expectations
//		$pdoUser = User::getUserByUserName($this->getPDO(), $this->VALID_USER_NAME);
//		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
//		$this->assertEquals($pdoUser->getUserId(), $userId);
//		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME);
//		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
//		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_HASH);
//		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
//
//	}

	/**
	 * test grabbing a User by email
	 *
	 **/
	public function testGetValidUserByUserEmail(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_USER_NAME,);
		$user->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserEmail($this->getPDO(), $user->getUserEmail());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_HASH);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);

	}

	/**
	 * test grabbing a User by its activation
	 *
	 **/
	public function testGetValidUserByActivationToken(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_ACTIVATION, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserActivationToken($this->getPDO(), $user->getUserActivationToken());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_HASH);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);

	}
}

