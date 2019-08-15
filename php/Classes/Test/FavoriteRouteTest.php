<?php

namespace AbqOutdoorTrails\AbqBike;

use AbqOutdoorTrails\AbqBike\Test\AbqBikeTest;
use AbqOutdoorTrails\AbqBike\ { User, Route, FavoriteRoute };

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

//grab the uuid generator
require_once(dirname(__DIR__, 3) . "/lib/uuid.php");

/**
 *Full PHPUnit test for FavoriteRoute class
 *
 * This is a complete PHPUnit test of the FavoriteRoute class.
 * It is complete because *ALL* mySQL/PDO enabled methods are tested for both valid and invalid inputs.
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
	 * Route that was favorited; this is for foreign key relations
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
	protected $VALID_ACTIVATION;

	/**
	 * create dependent objects before running each test
	 *
	 *
	 * @throws \Exception
	 */
	public final function setUp() : void {
		//run the default seUp() method first
		parent::setUp();

		//create a salt and hash for the mocked user
		$password = "abc123";
		$this->VALID_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));

		//create and insert the mocked profile
		$this->user = new User(generateUuidV4(), $this->VALID_ACTIVATION, 'williesworld@cnm.edu', $this->VALID_HASH, "garth420");
		$this->user->insert($this->getPDO());

		//create and insert the mocked route
		$this->route = new Route(generateUuidV4(), 'Madison Bike Blvd', '21', 'bike blvd', 30, 'bike blvd');
		$this->route->insert($this->getPDO());

	}

	/**
	 * test inserting a valid FavoriteRoute and verify the actual mySQL data matches
	 *
	 **/
	public function testInsertValidFavoriteRoute() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoriteRoute");

		//create a new FavoriteRoute and insert into mySQL
		$favoriteRoute = new FavoriteRoute($this->user->getUserId(), $this->route->getRouteId());
		$favoriteRoute->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoFavoriteRoute = FavoriteRoute::getFavoriteRoutesByRouteId($this->getPDO(), $this->route->getRouteId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteRoute"));
		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteUserId(), $this->user->getUserId());
		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteRouteId(), $this->route->getRouteId());


	}

	/**
	 * test creating a FavoriteRoute and then deleting it
	 *
	 **/
	public function testDeleteValidFavoriteRoute() : void {
		//count number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoriteRoute");

		//create a new FavoriteRoute and insert into mySQL
		$favoriteRoute = new FavoriteRoute($this->user->getUserId(), $this->route->getRouteId());
		$favoriteRoute->insert($this->getPDO());

		//delete the route from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteRoute"));
		$favoriteRoute->delete($this->getPDO());

		//grab the data from mySQL and enforce the Route does not exist
		$pdoRoute = FavoriteRoute::getFavoriteRouteById($this->getPDO(), $this->user->getUserId(), $this->route->getRouteId()); //TODO don't understand which method to call from FavoriteRoute here for comparison
		$this->assertNull($pdoRoute);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("favoriteRoute"));

	}

//	/**
//	 * test inserting a route and regrabbing it from mySQL //TODO figure out if we need to add a method that gets FavoriteRoutes by both routeId and userId
//	 *
//	 **/
//	public function testGetValidFavoriteRoutesByUserId() : void {
//		//count the number of rows and save it for later
//		$numRows = $this->getConnection()->getRowCount("favoriteRoute");
//
//		//create a new FavoriteRoute and insert to mySQL
//		$favoriteRoute = new FavoriteRoute($this->route->getRouteId(),$this->user->getUserId());
//		$favoriteRoute->insert($this->getPDO());
//
//		$pdoFavoriteRoute = FavoriteRoute::getFavoriteRoutesByUserId($this->getPDO(), $this->user->getUserId());
//		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteRoute"));
//		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteUserId(), $this->user-getUserId());
//		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteById(), $this->FavoriteRoute->getFavoriteRouteById);
//
//
//	}

	/**
	 * test grabbing a FavoriteRoute by user id
	 *
	 **/
	public function testGetValidFavoriteRouteByUserId() : void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoriteRoute");

		//create a new favorite route and insert into mySQL
		$favoriteRoute = new FavoriteRoute($this->route->getRouteId(), $this->user->getUserId());
		$favoriteRoute->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = FavoriteRoute::getFavoriteRoutesByUserId($this->getPDO(), $this->route->getRouteId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteRoute"));
		$this->assertCount(1, $results);

		// ensure no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("AbqOutdoorTrails\\AbqBike\\FavoriteRoute", $results);

		//grab the result from the array and validate it
		$pdoFavoriteRoute = $results[0];
		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteUserId(), $this->user->getUserId());
		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteRouteId(), $this->route->getRouteId());
	}

	public function testGetValidFavoriteRouteByRouteId() : void {
		// count the number of rows and save for later
		$numRows = $this->getConnection()->getRowCount('favoriteRoute');

		// create a new FavoriteRoute and insert it into MySQL
		$favoriteRoute = new FavoriteRoute($this->route->getRouteId(), $this->user->getUserId());
		$favoriteRoute->insert($this->getPDO());

		// grab data from MySQL and enforce the fields match expectations
		$results = FavoriteRoute::getFavoriteRoutesByRouteId($this->getPDO(), $this->route->getRouteId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount('favoriteRoute'));
		$this->assertCount(1, $results);

		// ensure no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("AbqOutdoorTrails\\AbqBike\\FavoriteRoute", $results);

		// grab the result from the array and validate it
		$pdoFavoriteRoute = $results[0];
		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteRouteId(), $this->route->getRouteId());
		$this->assertEquals($pdoFavoriteRoute->getFavoriteRouteUserId(), $this->user->getUserId());
	}
}