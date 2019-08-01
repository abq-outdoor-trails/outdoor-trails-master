<?php

namespace AbqOutdoorTrails\AbqBike;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 *Bike Routes for ABQ Bike Trails
 *
 * @author Chrystal Copeland
 *
 */
class FavoriteRoutes implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * favorite routes by route ID; this is a foreign key
	 * @ var favoriteRoutesRouteID
	 */

	private $favoriteRoutesRouteId;

	/**
	 * favorite routes by User ID; this is a foreign key
	 * favoriteRoutesUserId
	 */
	private $favoriteRoutesUserId;


	/**
	 * FavoriteRoutes constructor.
	 * @param string $newFavoriteRoutesRouteId
	 * @param string $newFavoriteRoutesUserId
	 */



	public function __construct(string $newFavoriteRoutesRouteId, string $newFavoriteRoutesUserId) {
		try {
			$this->setFavoriteRoutesRouteId($newFavoriteRoutesRouteId);
			$this->setFavoriteRoutesUserId($newFavoriteRoutesUserId);
		} catch(\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * accessor method for favoriteRoutesRouteId
	 * setFavoriteRoutesRouteId
	 **/
	public function getFavoriteRoutesRouteId(): Uuid {
		return ($this->favoriteRoutesRouteId);
	}

	/**
	 * mutator method for favoriteRoutesRouteId
	 * @param
	 * @throws
	 *
	 * favoriteRoutesRouteID
	 */
	public function setFavoriteRoutesRouteId(Uuid $newFavoriteRoutesRouteId): void {
		$this->favoriteRoutesRouteId = $newFavoriteRoutesRouteId;
		try {
			$uuid = self::validateUuid($newFavoriteRoutesRouteId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->favoriteRoutesRouteId = $uuid;
	}


	/**
	 * accessor method for favoriteRoutesUserId
	 *
	 */
	public function getFavoriteRoutesUserId(): Uuid {
		return ($this->favoriteRoutesUserId);
	}

	/**
	 * mutator method for favoriteRoutesUserId
	 *
	 */
	/**
	 * @param
	 * @throws
	 */
	public function setFavoriteRoutesUserId(Uuid $newFavoriteRoutesUserId): void {
		$this->favoriteRoutesUserId = $newFavoriteRoutesUserId;
		try {
			$uuid = self::validateUuid($newFavoriteRoutesUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->favoriteRoutesUserId = $uuid;
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
		$query = "INSERT INTO favoriteRoutes(favoriteRoutesUserId, favoriteRoutesRouteId) VALUES(:favoriteRoutesUserId, :favoriteRoutesRouteId)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["favoriteRoutesUserId" => $this->favoriteRoutesUserId->getBytes(), "favoriteRoutesRouteId" => $this->favoriteRoutesRouteId->getBytes ()];
		$statement->execute($parameters);
	}


	/**
	 * Specify data which should be serialized to JSON
	 * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */

	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["routeId"] = $this->tweetId->toString();
		return ($fields);
	}

}
