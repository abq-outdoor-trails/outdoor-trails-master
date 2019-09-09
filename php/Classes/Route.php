<?php

namespace AbqOutdoorTrails\AbqBike;

require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 *Bike Routes for ABQ Bike Trails
 *
 * @author Chrystal Copeland
 *
 */
class Route implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * constructor for this route
	 *
	 * @param $newRouteId Uuid of this route or Null if new route NOT NULL
	 * @param $newRouteDescription string containing route description
	 * @param $newRouteFile string containing route file data NOT NULL
	 * @param $newRouteName string containing new route name
	 * @param $newRouteSpeedLimit int containing route speed limit
	 * @param $newRouteType string containing route type
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 */

	public function __construct($newRouteId, ?string $newRouteDescription, string $newRouteFile, string $newRouteName, ?int $newRouteSpeedLimit, $newRouteType) {
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
	 * id for this route; this is the primary key
	 * @var string @routeID
	 */
	private $routeId;

	/**
	 * Brief route description
	 * @var string $routeDescription
	 */

	private $routeDescription;

	/**
	 * file where the individual route will be stored
	 * @var string $routeFile
	 */
	private $routeFile;

	/**
	 *  route name for this route
	 * @var string $routeName
	 */
	private $routeName;

	/**
	 * known speed limits for each route
	 * @var $routeSpeedLimit
	 */

	private $routeSpeedLimit;


	/**
	 * route types to classify different routes featured on site
	 * @var string $routeType
	 */

	private $routeType;

	/**
	 * accessor method for route ID
	 *
	 * @return Uuid
	 */
	public function getRouteId(): Uuid {
		return($this->routeId);
	}

	/**
	 * mutator method for route ID
	 * @param $newRouteId route
	 * @throws \TypeError
	 *
	 */
	public function setRouteId($newRouteId): void {
		try {
			$uuid = self::validateUuid($newRouteId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
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
	 *mutator method for route description
	 * @param string $newRouteDescription
	 * @throws \InvalidArgumentException if $newRouteDescription is not a string or insecure
	 * @throws \RangeException if $newRouteDescription is > 140 characters
	 * @throws \TypeError if $newRouteName is not a string
	 */

	public function setRouteDescription(?string $newRouteDescription): void {
		//verify route name is secure
		$newRouteDescription = trim($newRouteDescription);
		$newRouteDescription = filter_var($newRouteDescription, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//		if(empty($newRouteDescription) === true) {
//			throw(new \InvalidArgumentException("Route description is empty or insecure"));
//		}
		// verify the route Description will fit in the database
		if(strlen($newRouteDescription) > 140) {
			throw(new \RangeException("route description too large"));
		}
		$this->routeDescription = $newRouteDescription;
	}


	/**
	 * accessor method for route file
	 * @return string value of the route file
	 */
	public function getRouteFile(): string {
		return ($this->routeFile);
	}

	/**
	 * mutator method for route file
	 *
	 * @param string $newRouteFile - new value of route file
	 * @throws \InvalidArgumentException if $newRouteFile is not a string
	 * @throws \RangeException of $newRouteFile is > 256 characters
	 * @throws \TypeError if $newRouteFile is not a string
	 */
	public function setRouteFile(string $newRouteFile): void {

		$newRouteFile = trim($newRouteFile);
		$newRouteFile = filter_var($newRouteFile, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// verify the route ID will fit in the database
//		if(strlen($newRouteFile) > 10000) {
//			throw(new \RangeException("route file content too large"));
//		}
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
	 * mutator method for route name
	 *
	 * @param string $newRouteName
	 * @throws \InvalidArgumentException if $newRouteName is not a string or insecure
	 * @throws \RangeException if $newRouteName is > 32 characters
	 * @throws \TypeError if $newRouteName is not a string
	 */
	public function setRouteName(string $newRouteName): void {
		//verify route name is secure
		$newRouteName = trim($newRouteName);
		$newRouteName = filter_var($newRouteName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newRouteName) === true) {
			throw(new \InvalidArgumentException("Route name is empty or insecure"));
		}
		//verify route name is less than 32 characters
		if(strlen($newRouteName) > 64) {
			throw(new \RangeException("route name is too large"));
		}
		$this->routeName = $newRouteName;
	}


	/**
	 * accessor method for route speed limit
	 */
	public function getRouteSpeedLimit(): int {
		return ($this->routeSpeedLimit);
	}

	/**
	 * mutator method for route speed limit
	 * @param integer $newRouteSpeedLimit
	 * @throws \RangeException if $newRouteSpeedLimit is > 99
	 * @throws \TypeError if $newRouteSpeedLimit is not a integer
	 */

	public function setRouteSpeedLimit(?int $newRouteSpeedLimit): void {

		//verify speed limit is valid range
		if($newRouteSpeedLimit < 0 || $newRouteSpeedLimit > 99) {
			throw (new \RangeException("speed limit below zero or greater than 99"));
		}
		$this->routeSpeedLimit = $newRouteSpeedLimit;
	}


	/**
	 * accessor method for route type
	 */
	public function getRouteType(): string {
		return ($this->routeType);
	}

	/**
	 * getter method for route type
	 *
	 * @param string $newRouteType
	 * @throws \InvalidArgumentException if $newRouteType is not a string or insecure
	 * @throws \RangeException if $newRouteType is > 32 characters
	 * @throws \TypeError if $newRouteType is not a string
	 */

	public function setRouteType($newRouteType): void {
		//verify route name is secure
		$newRouteType = trim($newRouteType);
		$newRouteType = filter_var($newRouteType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
//		if(empty($newRouteType) === true) {
//			throw(new \InvalidArgumentException("Route type is empty or insecure"));
//		}
		//verify route name is less than 128 characters
		if(strlen($newRouteType) > 128) {
			throw(new \RangeException("route type is too large"));
		}
		$this->routeType = $newRouteType;
	}

	/**
	 * inserts route into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) : void {

		//create query template
		$query = "INSERT INTO route(routeId, routeDescription, routeFile, routeName, routeSpeedLimit, routeType) VALUES (:routeId, :routeDescription, :routeFile, :routeName, :routeSpeedLimit, :routeType)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["routeId" => $this->routeId->getBytes(), "routeDescription" => $this->routeDescription, "routeFile" =>$this->routeFile, "routeName" => $this->routeName, "routeSpeedLimit" => $this->routeSpeedLimit, "routeType" => $this->routeType];
		$statement->execute($parameters);
	}

	/**
	 * gets the getRouteByRouteId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $routeId route id to search for
	 * @return Route|null route found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getRouteByRouteId(\PDO $pdo, $routeId): ?Route {
		// sanitize the routeID before searching
		try {
			$routeId = self::validateUuid($routeId);
		} catch(\InvalidArgumentException | \RangeException| \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template
		$query = "SELECT routeId, routeDescription, routeFile, routeName, routeSpeedLimit, routeType FROM route WHERE routeId = :routeId";
		$statement = $pdo->prepare($query);

		//bind the route id to the place holder in the template
		$parameters = ["routeId" => $routeId->getBytes()];
		$statement->execute($parameters);

		//grab the route from mySQL
		try {
			$route = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$route = new Route($row["routeId"], $row["routeDescription"], $row["routeFile"], $row["routeName"], $row["routeSpeedLimit"], $row["routeType"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($route);
	}

	/**
	 * gets the Route by Route Type
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $routeType content to search for
	 * @return \SplFixedArray SplFixedArray of routes found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 * follow get tweet by tweet content example
	 **/
	public static function getRouteByRouteType(\PDO $pdo, string $routeType) : \SplFixedArray {
		// sanitize the description before searching
		$routeType = trim($routeType);
		$routeType = filter_var($routeType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($routeType) === true) {
			throw(new\PDOException("route content is invalid"));
		}
		//create query template
		$query = "SELECT routeId, routeDescription,  routeFile, routeName,  routeSpeedLimit, routeType FROM route WHERE routeType = :routeType";
		$statement = $pdo->prepare($query);

		// bind the route type to the place holder in the template
//		$routeType = "%$routeType%";
		$parameters = ["routeType" => $routeType];
		$statement->execute($parameters);

		// build an array of route types
		$routes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$route = new Route($row["routeId"], $row["routeDescription"], $row["routeFile"], $row["routeName"], $row["routeSpeedLimit"], $row["routeType"]);
				$routes[$routes->key()] = $route;
				$routes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($routes);
	}

	/**
	 * gets the Route by Route Name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $routeName content to search for
	 * @return \SplFixedArray SplFixedArray of routes found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 * follow get tweet by tweet content example
	 **/
	public static function getRouteByRouteName(\PDO $pdo, string $routeName) : \SplFixedArray {
		// sanitize the description before searching
		$routeName = trim($routeName);
		$routeName = filter_var($routeName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($routeName) === true) {
			throw(new\PDOException("route name is invalid"));
		}
		//create query template
		$query = "SELECT routeId, routeName, routeFile, routeType, routeSpeedLimit, routeDescription FROM route WHERE routeName = :routeName";
		$statement = $pdo->prepare($query);

		// bind the route type to the place holder in the template
		$parameters = ["routeName" => $routeName];
		$statement->execute($parameters);

		// build an array of route types
		$routes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$route = new Route($row["routeId"], $row["routeName"], $row["routeFile"], $row["routeType"], $row["routeSpeedLimit"], $row["routeDescription"]);
				$routes[$routes->key()] = $route;
				$routes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($routes);
	}

	/**
	 * gets the Route File by routeFile
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $routeFile routeFile to search for
	 * @return Tweet|null Tweet found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getRouteByRouteFile(\PDO $pdo, string $routeFile) : ?Route {
		// trim and sanitize string and validate file path
		$routeFile = trim($routeFile);
		$routeFile = filter_var($routeFile, FILTER_VALIDATE_URL);
		if(empty($routeFile) === true) {
			throw(new \PDOException("not a valid URL"));
		}

		//create query template
		$query = "SELECT routeId, routeDescription, routeFile, routeName,  routeSpeedLimit, routeType  FROM route WHERE routeFile = :routeFile";
		$statement = $pdo->prepare($query);

		//bind the route file to the place holder in the template
		$parameters = ["routeFile" => $routeFile];
		$statement->execute($parameters);

		//grab the route from mySQL
		try {
			$route = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$route = new Route($row["routeId"], $row["routeDescription"],  $row["routeFile"], $row["routeName"],  $row["routeSpeedLimit"], $row["routeType"],);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($route);
	}

	/**
	 * Specify data which should be serialized to JSON
	 *
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */

	public
	function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["routeId"] = $this->routeId->toString();
		return ($fields);
	}
}
