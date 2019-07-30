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
			$this->setRouteName($newRouteName);
			$this->setRouteFile($newRouteFile);
			$this->setRouteType($newRouteType);
			$this->setRouteSpeedLimit($newRouteSpeedLimit);
			$this->setRouteDescription($newRouteDescription);
		} catch(\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


}

