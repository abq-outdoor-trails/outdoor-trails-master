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



	public function __construct(Uuid $newFavoriteRouteRouteId, Uuid $newFavoriteRouteUserId) {
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
	public function setFavoriteRouteRouteId(Uuid $newFavoriteRouteRouteId): void {
		$this->favoriteRouteRouteId = $newFavoriteRouteRouteId;
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
	 */
	/**
	 * @param Uuid $newFavoriteRouteUserId
	 *
	 */
	public function setFavoriteRouteUserId(Uuid $newFavoriteRouteUserId): void {
		$this->favoriteRouteUserId = $newFavoriteRouteUserId;
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
	 * @throws \PDOException when mySQL related errors occure
	 * @throws \TypeError if $pdo is not a PDO connection object
	 *
	 */
	public function insert(\PDO $pdo): void {

		//create query template
		$query = "INSERT INTO favoriteRoute(favoriteRouteUserId, favoriteRouteRouteId) VALUES(:favoriteRouteUserId, :favoriteRouteRouteId)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["favoriteRouteUserId" => $this->favoriteRouteUserId->getBytes(), "favoriteRouteRouteId" => $this->favoriteRouteRouteId->getBytes ()];
		$statement->execute($parameters);
	}

	/**
	 * method to return a Route using given user ID
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid $userId user id to be used to retrieve requested Route
	 * @return Route|null Route object to be returned
	 * @throws \PDOException exception to be thrown if there's an issue with PDO connection object
	 **/
	public function getFavoriteRouteByUserId(\PDO $pdo, Uuid $userId) : ?Route {
		// verify that userId is actually a Uuid
		try {
			$userId = self::validateUuid($userId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create MySQL query template
		$query = "SELECT routeId, routeName, routeFile, routeType, routeSpeedLimit, routeDescription FROM route WHERE "
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
