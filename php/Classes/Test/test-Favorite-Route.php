<?php

namespace namespace AbqOutdoorTrails\AbqBike;

use AbqOutdoorTrails\AbqBike\Test\AbqBikeTest;
use UssHopper\AbqBike\{
	User, Route, FavoriteRoute
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
	 * @var Route $route
	 *
	 **/
	protected $route;

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
		$this->route = new Route(generateUuidV4(), 'Madison Bike Blvd', '21', 'bike blvd', 'Speed limit 25mph', 'bike blvd shared user road with lowered speed limit');
		$this->route->insert($this->getPDO());

	}

	/**
	 * test inserting a valid FavoriteRoute and verify the actual mySQL data matches
	 *
	 **/
	public function testInsertValidFavoriteRoute() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoriteRoute");

		//create a new FavoriteRouteByRouteId and insert into mySQL
		$favoriteRoute = new FavoriteRoute($this->user->getUserId(), $this->route->getRouteId());
		$favoriteRoute->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoFavoriteRoute = FavoriteRoute::getFavoriteRouteByRouteId($this->getPDO(), $this->user->getUserId(), $this->route->getRouteId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteRoute"));
		$this->assertEquals($pdoFavoriteRoute->getUserId(), $this->user->getUserId());
		$this->assertEquals($pdoFavoriteRoute->getRouteId(), $this->route->getRouteId());


	}

	/**
	 * test creating a FavoriteRouteByUserId and then deleting it
	 *
	 **/
	public function testDeleteValidFavoriteRouteIdAndUserId() : void {
		//count number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("FavoriteRoute");

		//create a new FavoriteRouteById and insert into mySQL
		$route = new FavoriteRoute($this->user->getUserId(), $this->route->getRouteId(), $this->VALID_ROUTE);
		$route->insert($this->getPDO());

		//delete the route from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("FavoriteRoute"));
		$favoriteRoute->delete($this->getPDO());

		//grab the data from mySQL and enforce the Route does not exist
		$podRoute = FavoriteRoute::getFavoriteRouteById($this->getPDO(), $this->user->getUserId(), $this->route->getRouteId());
		$this->assertNull($pdoRoute);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("FavoriteRoute"));

	}

	/**
	 * test inserting a route and regrabbing it from mySQL
	 *
	 **/
	public function testGetValidFavoriteRouteByIdAndUserId() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("FavoriteRoute");

		//create a new FavoriteRoute and insert to mySQL
		$route = new FavoriteRoute($this->getPDO(), $this->favoriteRoute-$this->getfavoriteRouteByIdAndUserId(), $this->VALID_ROUTE());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteRoute"));
		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteById(), $this->user-getUserId());
		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteById(), $this->FavoriteRoute->getFavoriteRouteById);


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

