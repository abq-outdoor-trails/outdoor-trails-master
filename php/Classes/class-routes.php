<?php

namespace AbqOutdoorTrails\AbqBike;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 *Bike Routes for ABQ Bike Trails
 *
 *@author Chrystal Copeland
 *
 */
class route implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * id for this route; this is the primary key
	 * @var string @routeID
	 */
	private $routeId;

	/**
	 *  route name for this route
	 * @var string $routeName
	 */
	private $routeName;

	/**
	 * file where the individual route will be stored
	 * @var string $routeFile
	 */
	private $routeFile;

	/**
	 * route types to classify different routes featured on site
	 * @var string $routeType
	 */

	private $routeType;

	/**
	 * known speed limits for each route
	 * @var $routeSpeedLimit
	 */

	private $routeSpeedLimit;

	/**
	 * Brief route description
	 * @var string $routeDescription
	 */

	private $routeDescription;

	/**
	 * constructor for this route
	 *
	 * @param $newRouteId id of this route or Null if new route NOT NULL
	 * @param $newRouteName string containing new route name
	 * @param $newRouteFile string containing route file data NOT NULL
	 * @param $newRouteType string containing route type
	 * @param $newRouteSpeedLimit string containing route speed limit
	 * @param $newRouteDescription string containing route description
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 */

	public function __construct($newRouteId, string $newRouteName, string $newRouteFile, string $newRouteType,
										 string $newRouteSpeedLimit, string $newRouteDescription) {
		try {
			$this->setRouteId($newRouteId);
			$this->setRouteDescription($newRouteDescription);
			$this->setRouteFile($newRouteFile);
			$this->setRouteName($newRouteName);
			$this->setRouteSpeedLimit($newRouteSpeedLimit);
			$this->setRouteType($newRouteType);


		} catch(\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for route ID
	 *
	 * @return Uuid value of route ID
	 */
	public function getRouteID(): Uuid {
		return ($this->routeId);
	}

	/**
	 * getter method for route ID
	 */
	public function setRouteId($newRouteID): void {
		try {
			$uuid = self::validateUuid($newRouteID);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception - getMessage(), 0, $exception));
		}
		// convert and store route Id
		$this->routeId = $uuid;
	}

	/**
	 * accessor method for route description
	 *
	 * @Param return string value of route description
	 */
	public function getRouteDescription(): string {
		return ($this->routeDescription);
	}

	/**
	 *getter method for route description
	 * @param string $$newRouteDescription
	 * @throws \InvalidArgumentException if $newRouteDescription is not a string or insecure
	 * @throws \RangeException if $newRouteDescription is > 140 characters TODO ADD CHARACTER RETURN
	 * @throws \TypeError if $newRouteName is not a string
	 */

	public function setRouteName(string $newRouteName) : void {
		//verify route name is secure
		$newRouteName = trim($newRouteName);
		$newRouteName = filter_var($newRouteName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newRouteName) === true) {
			throw(new \InvalidArgumentException("Route name is empty or insecure"));
		}
	}
	 */



	/**
	 * accessor method for route file
	 * @return string value of the route file
	 */
	public function getRouteFile() : string {
		return($this->routeFile);
	}

	/**
	 * getter method for route file
	 *
	 * @Param string $newRouteFile - new value of route file
	 * @throws \InvalidArgumentException if $newRouteFile is not a string
	 * @throws \RangeException of $newRouteFile is > 256 characters
	 * @throws \TypeError if $newRouteFile is not a string
	 */
	public function setRouteFile(string $newRouteId) : void {

		$newRouteFile = trim($newRouteFile);
		$newRouteFile = filter_var($newRouteFile, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// verify the route ID will fit in the database
		if(strl($newRouteFile) > 256) {
			throw(new \RangeException("route file content too large"));
		}
		// store the route file content
		$this->routeFile = $newRouteFile;
	}



	/**
	 * accessor method for route name
	 *
	 * @return string value of route name
	 */
	public function getRouteName(): string {
		return ($this->routeName);
	}

	/**
	 * getter method for route name
	 *
	 * @param string $$newRouteName
	 * @throws \InvalidArgumentException if $newRouteName is not a string or insecure
	 * @throws \RangeException if $newRouteName is > 32 characters TODO ADD CHARACTER RETURN
	 * @throws \TypeError if $newRouteName is not a string
	 */
	public function setRouteName(string $newRouteName) : void {
		//verify route name is secure
		$newRouteName = trim($newRouteName);
		$newRouteName = filter_var($newRouteName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newRouteName) === true) {
			throw(new \InvalidArgumentException("Route name is empty or insecure"));
		}
	}




	/**
	 * accessor method for route speed limit
	 */
	public function getRouteSpeedLimit(): string {
		return ($this->routeSpeedLimit);

	/**
	 * getter method for route speed limit
	 */




	/**
	 * accessor method for route type
	 */
		public function getRouteType(): string {
			return ($this->routeType);

	/**
	 * getter method for route type
	 */

}
