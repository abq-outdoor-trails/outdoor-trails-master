<?php
namespace AbqOutdoorTrails\AbqBike\Test;

use AbqOutdoorTrails\AbqBike\{Comment, User, Route};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

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
	 * test getRouteByRouteId grabbing from mySQL
	 *
	 **/
	public function testGetRouteByRouteId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("route");

		//grab data from mySQL and enfore the fields that match our expectations.
		$result = Route::getRouteByRouteId($this->getPDO(), $route->getRouteId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("route"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstanceOf("AbqOutdoorTrails\\AbqBike\\Test", $results);

		//grab the results from the array and validate it
		$pdoRoute = $result
	}
}