<?php

namespace namespace AbqOutdoorTrails\AbqBike;

use AbqOutdoorTrails\AbqBike\Test\AbqBikeTest;
use UssHopper\AbqBike\{
	User, Route
};

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

//grab the uuid generator
require_once(dirname(__DIR__, 2) . "lib/uuid.php");

/**
 *Full PHPUnit test for FavoriteRoute class
 *
 * This is a complete PHPUnit test of the FavoriteRoute class.
 * It is complete because *ALL* mySQL/PDO enabled methods are tested* *for both valid and invalid inputs.
 *
 * @see FavoriteRoute
 **/

class FavoriteRouteTest extends AbqBikeTest {
	/**
	 * User that created the favorite route; this is for foreign key relations
	 * @var User $user
	 **/

	protected $user;

	/**
	 * Route that was Favorited; this is for foreign key relations
	 *
	 * @var FavoriteRoute $favoriteRoute
	 *
	 **/
	protected $favoriteRoute;

	/**
	 * valid hash to use
	 * @var $VALID_HASH
	 *
	 **/
	protected $VALID_HASH;

	/**
	 * valid activationToken to create the user object to own the test
	 * @var string $VALID_ACTIVATION
	 *
	 **/
	protected $VALID_ACTIVATION

	/**
	 * create dependent objects before running each test
	 *
	 **/
	public final function setUp() : void {
		//run the default seUp() method first
		parent::setUp():

		//create a salt and hash for the mocked user
		$password = "abc123";
		$this->VALID_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));

		//create and insert the mocked profile
		$this->user = new User(generateUuidV4(), 'willieharris', '@williesworld.cnm.ed', $this->VALID_HASH, $this->VALID_ACTIVATION);
		$this->user->insert($this->getPDO());

		//create the and insert the mocked route
		$this->Route = new Route()
	}






	/**
	 * favorite route by route ID; this is a foreign key
	 * @ var favoriteRouteRouteID
	 */

	protected $VALID_ROUTE;

	/**
	 * favorite route by User ID; this is a foreign key
	 * favoriteRouteUserId
	 */
	protected $VALID_FAVORITE_ROUTE_BY_USERID;
}

