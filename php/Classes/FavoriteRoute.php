<?php

namespace AbqOutdoorTrails\AbqBike;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 *Bike Route for ABQ Bike Trails
 *
 * @author Chrystal Copeland
 *
 */
class FavoriteRoute implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * favorite route by route ID; this is a foreign key
	 * @ var favoriteRouteRouteID
	 */

	private $favoriteRouteRouteId;

	/**
	 * favorite route by User ID; this is a foreign key
	 * favoriteRouteUserId
	 */
	private $favoriteRouteUserId;


	/**
	 * FavoriteRoute constructor.
	 * @param Uuid $newFavoriteRouteRouteId
	 * @param Uuid $newFavoriteRouteUserId
	 */



	public function __construct($newFavoriteRouteRouteId, $newFavoriteRouteUserId) {
		try {
			$this->setFavoriteRouteRouteId($newFavoriteRouteRouteId);
			$this->setFavoriteRouteUserId($newFavoriteRouteUserId);
		} catch(\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * accessor method for favoriteRouteRouteId
	 * setFavoriteRouteRouteId
	 **/
	public function getFavoriteRouteRouteId(): Uuid {
		return ($this->favoriteRouteRouteId);
	}

	/**
	 * @param Uuid $newFavoriteRouteRouteId
	 *
	 */
	public function setFavoriteRouteRouteId($newFavoriteRouteRouteId): void {
//		$this->favoriteRouteRouteId = $newFavoriteRouteRouteId;
		try {
			$uuid = self::validateUuid($newFavoriteRouteRouteId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->favoriteRouteRouteId = $uuid;
	}


	/**
	 * accessor method for favoriteRouteUserId
	 *
	 */
	public function getFavoriteRouteUserId(): Uuid {
		return ($this->favoriteRouteUserId);
	}

	/**
	 * mutator method for favoriteRouteUserId
	 *
	 * @param Uuid $newFavoriteRouteUserId
	 *
	 **/
	public function setFavoriteRouteUserId($newFavoriteRouteUserId): void {
//		$this->favoriteRouteUserId = $newFavoriteRouteUserId;
		try {
			$uuid = self::validateUuid($newFavoriteRouteUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->favoriteRouteUserId = $uuid;
	}
	
	/**
	 * Inserts favorite route into mySql
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 *
	 */
	public function insert(\PDO $pdo): void {

		//create query template
		$query = "INSERT INTO favoriteRoute(favoriteRouteRouteId, favoriteRouteUserId) VALUES(:favoriteRouteRouteId, :favoriteRouteUserId)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["favoriteRouteRouteId" => $this->favoriteRouteRouteId->getBytes(), "favoriteRouteUserId" => $this->favoriteRouteUserId->getBytes()];
		$statement->execute($parameters);
	}

	public function delete(\PDO $pdo) : void {
		// create query template
		$query = "DELETE FROM favoriteRoute WHERE favoriteRouteRouteId = :favoriteRouteRouteId AND favoriteRouteUserId = :favoriteRouteUserId";
		$statement = $pdo->prepare($query);

		// bind the member variables to template placeholders
		$parameters = ["favoriteRouteRouteId" => $this->favoriteRouteRouteId->getBytes(), "favoriteRouteUserId" => $this->favoriteRouteUserId->getBytes()];
		$statement->execute($parameters);
	}
	// TODO write delete method

	/**
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid $favoriteRouteRouteId route id associated with this favorite route
	 * @param Uuid $favoriteRouteUserId user id associated with this favorite route
	 * @return FavoriteRoute|null favorite route that was returned
	 **/
	public static function getFavoriteRouteByFavoriteRouteRouteIdAndFavoriteRouteUserId(\PDO $pdo, Uuid $favoriteRouteRouteId, Uuid $favoriteRouteUserId) {
		// validate both uuids
		try {
			$favoriteRouteRouteId = self::validateUuid($favoriteRouteRouteId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		try {
			$favoriteRouteUserId = self::validateUuid($favoriteRouteUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create a query template
		$query = "SELECT favoriteRouteRouteId, favoriteRouteUserId FROM favoriteRoute WHERE favoriteRouteRouteId = :favoriteRouteRouteId AND favoriteRouteUserId = :favoriteRouteUserId";
		$statement = $pdo->prepare($query);

		// bind the ids to the template placeholders
		$parameters = ["favoriteRouteRouteId" => $favoriteRouteRouteId->getBytes(), "favoriteRouteUserId" => $favoriteRouteUserId->getBytes()];
		$statement->execute($parameters);

		// grab the favorite route from MySQL
		try {
			$favoriteRoute = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row) {
				$favoriteRoute = new FavoriteRoute($row["favoriteRouteRouteId"], $row["favoriteRouteUserId"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($favoriteRoute);
	}

	/**
	 * method to return a user's favorite Route by the route's ID
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid $favoriteRouteRouteId ID of the route to be accessed
	 * @return FavoriteRoute|null return the FavoriteRoute if found, null if not
	 * @throws \PDOException exception to be thrown if there's an issue with PDO connection object
	 */
	public static function getFavoriteRoutesByRouteId(\PDO $pdo, Uuid $favoriteRouteRouteId) : ?\SplFixedArray {
		// verify that route id is actually a Uuid
		try {
			$favoriteRouteRouteId = self::validateUuid($favoriteRouteRouteId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create MySQL query template
		$query = "SELECT favoriteRouteRouteId, favoriteRouteUserId FROM favoriteRoute WHERE favoriteRouteRouteId = :favoriteRouteRouteId";
		$statement = $pdo->prepare($query);
		// bind the route id to the placeholder in the query template
		$parameters = ["favoriteRouteRouteId" => $favoriteRouteRouteId->getBytes()];
		$statement->execute($parameters);
		// build an array of favorite routes
		$favoriteRoutes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while($row=$statement->fetch()) {
			try {
				$favoriteRoute = new FavoriteRoute($row["favoriteRouteRouteId"], $row["favoriteRouteUserId"]);
				$favoriteRoutes[$favoriteRoutes->key()] = $favoriteRoute;
				$favoriteRoutes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($favoriteRoutes);
	}

	/**
	 * method to return a Route using given user ID
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid $favoriteRouteUserId user id to be used to retrieve requested favorite routes
	 * @return \SplFixedArray|null array of favorite routes to be returned
	 * @throws \PDOException exception to be thrown if there's an issue with PDO connection object
	 **/
	public static function getFavoriteRoutesByUserId(\PDO $pdo, Uuid $favoriteRouteUserId) : ?\SplFixedArray {
		// verify that userId is actually a Uuid
		try {
			$favoriteRouteUserId = self::validateUuid($favoriteRouteUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create MySQL query template
		$query = "SELECT favoriteRouteRouteId, favoriteRouteUserId FROM favoriteRoute WHERE favoriteRouteUserId = :favoriteRouteUserId";
		$statement = $pdo->prepare($query);
		// bind the user id to the placeholder in the query template
		$parameters = ["favoriteRouteUserId" => $favoriteRouteUserId->getBytes()];
		$statement->execute($parameters);
		// build an array of favorite routes
		$favoriteRoutes = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while($row=$statement->fetch()) {
			try {
				$favoriteRoute = new FavoriteRoute($row["favoriteRouteRouteId"], $row["favoriteRouteUserId"]);
				$favoriteRoutes[$favoriteRoutes->key()] = $favoriteRoute;
				$favoriteRoutes->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($favoriteRoutes);
	}

	/**
	 * Specify data which should be serialized to JSON
	 *
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */

	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["favoriteRouteRouteId"] = $this->favoriteRouteRouteId->toString();
		$fields["favoriteRouteUserId"] = $this->favoriteRouteUserId->toString();
		return ($fields);
	}

}
