<?php

namespace AbqOutdoorTrails\AbqBike\Test;

use Ramsey\Uuid\Uuid;
use AbqOutdoorTrails\AbqBike\{ Route };

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 3) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the Route class
 *
 * This is a complete PHPUnit test of the Route class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Route
 * @author canderson73@cnm.edu
 **/
class RouteTest extends AbqBikeTest {

	/**
	 * @var Uuid value of route id; this is the primary key
	 **/
	protected $routeId = null;
	/**
	 * valid route Name
	 * @var string $VALID_ROUTE_NAME
	 */
	protected $VALID_ROUTE_NAME = "This is a test name";

	/**
	 * valid route file
	 * @var string $VALID_ROUTE_FILE
	 */
	protected $VALID_ROUTE_FILE = "/johnsworld/home/routeFile.json";

	/**
	 * valid route type
	 * @var string $VALID_ROUTE_TYPE
	 */
	protected $VALID_ROUTE_TYPE = "Paved Multi-use Trail";

	/**
	 * valid speed limit
	 * @var int $VALID_SPEED_LIMIT
	 */
	protected $VALID_SPEED_LIMIT = 20;

	/**
	 * Valid route description
	 * @var string $VALID_ROUTE_DESCRIPTION
	 */
	protected $VALID_ROUTE_DESCRIPTION = "Descriptions may or may not exist";

	/**
	 * PHP Unit setup method
	 **/
	public final function setUp(): void {
		parent::setUp();
	}

	/**
	 * @throws \Exception for PDO exceptions
	 */
	public function testInsertValidRoute(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("route");

		//create new route and inert into mySQL
		$routeId = generateUuidV4();
		$route = new Route($routeId, $this->VALID_ROUTE_NAME, $this->VALID_ROUTE_FILE, $this->VALID_ROUTE_TYPE, $this->VALID_SPEED_LIMIT, $this->VALID_ROUTE_DESCRIPTION);
		$route->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoRoute = Route::getRouteByRouteId($this->getPDO(), $route->getRouteId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("route"));
		$this->assertEquals($pdoRoute->getRouteId(), $routeId);
		$this->assertEquals($pdoRoute->getRouteName(), $this->VALID_ROUTE_NAME);
		$this->assertEquals($pdoRoute->getRouteFile(), $this->VALID_ROUTE_FILE);
		$this->assertEquals($pdoRoute->getRouteType(), $this->VALID_ROUTE_TYPE);
		$this->assertEquals($pdoRoute->getRouteSpeedLimit(), $this->VALID_SPEED_LIMIT);
		$this->assertEquals($pdoRoute->getRouteDescription(), $this->VALID_ROUTE_DESCRIPTION);
	}


	/**
	 * test getRouteByRouteId grabbing from mySQL
	 * commenting out because this test does the same thing as the insert valid route test
	 **/
//	public function testGetRouteByRouteId(): void {
//		//count the number of rows and save it for later
//		$numRows = $this->getConnection()->getRowCount("route");
//
//		$routeId = generateUuidV4();
//		$route = new Route($routeId, $this->VALID_ROUTE_NAME, $this->VALID_ROUTE_FILE, $this->VALID_ROUTE_TYPE, $this->VALID_SPEED_LIMIT, $this->VALID_ROUTE_DESCRIPTION);
//		$route->insert($this->getPDO());
//
//		//grab data from mySQL and enforce the fields that match our expectations.
//		$pdoRoute = Route::getRouteByRouteId($this->getPDO(), $route->getRouteId());
//		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("route"));
//		$this->assertEquals($pdoRoute->getRouteId(), $routeId);
//		$this->assertEquals($pdoRoute->getRouteName(), $this->VALID_ROUTE_NAME);
//		$this->assertEquals($pdoRoute->getRouteFile(), $this->VALID_ROUTE_FILE);
//		$this->assertEquals($pdoRoute->getRouteType(), $this->VALID_ROUTE_TYPE);
//		$this->assertEquals($pdoRoute->getRouteSpeedLimit(), $this->VALID_SPEED_LIMIT);
//		$this->assertEquals($pdoRoute->getRouteDescription(), $this->VALID_ROUTE_DESCRIPTION);
//	}

	/**
	 * test getRouteByRouteType grabbing from mySQL
	 *
	 **/
	public function testGetRouteByRouteType(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("route");

		$routeId = generateUuidV4();
		$route = new Route($routeId, $this->VALID_ROUTE_NAME, $this->VALID_ROUTE_FILE, $this->VALID_ROUTE_TYPE, $this->VALID_SPEED_LIMIT, $this->VALID_ROUTE_DESCRIPTION);
		$route->insert($this->getPDO());

		// grab the data from MySQL and enforce the fields match expectations
		$results = Route::getRouteByRouteType($this->getPDO(), $this->VALID_ROUTE_TYPE);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("route"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("AbqOutdoorTrails\\AbqBike\\Route", $results);

		// grab result from the array and validate it
		$pdoRoute = $results[0];
		$this->assertEquals($pdoRoute->getRouteId(), $routeId);
		$this->assertEquals($pdoRoute->getRouteName(), $this->VALID_ROUTE_NAME);
		$this->assertEquals($pdoRoute->getRouteFile(), $this->VALID_ROUTE_FILE);
		$this->assertEquals($pdoRoute->getRouteType(), $this->VALID_ROUTE_TYPE);
		$this->assertEquals($pdoRoute->getRouteSpeedLimit(), $this->VALID_SPEED_LIMIT);
		$this->assertEquals($pdoRoute->getRouteDescription(), $this->VALID_ROUTE_DESCRIPTION);
	}


	/**
	 * test getRouteByRouteFile grabbing from mySQL
	 *
	 **/
	public function testGetRouteByRouteFile(): void {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("route");

		$routeId = generateUuidV4();
		$route = new Route($routeId, $this->VALID_ROUTE_NAME, $this->VALID_ROUTE_FILE, $this->VALID_ROUTE_TYPE, $this->VALID_SPEED_LIMIT, $this->VALID_ROUTE_DESCRIPTION);
		$route->insert($this->getPDO());

		//grab data from mySQL and enfore the fields that match our expectations.
		$pdoRoute = Route::getRouteByRouteFile($this->getPDO(), $route->getRouteFile());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("route"));
		$this->assertEquals($pdoRoute->getRouteId(), $routeId);
		$this->assertEquals($pdoRoute->getRouteName(), $this->VALID_ROUTE_NAME);
		$this->assertEquals($pdoRoute->getRouteFile(), $this->VALID_ROUTE_FILE);
		$this->assertEquals($pdoRoute->getRouteType(), $this->VALID_ROUTE_TYPE);
		$this->assertEquals($pdoRoute->getRouteSpeedLimit(), $this->VALID_SPEED_LIMIT);
		$this->assertEquals($pdoRoute->getRouteDescription(), $this->VALID_ROUTE_DESCRIPTION);
	}
}
