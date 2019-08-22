<?php

namespace AbqOutdoorTrails\AbqBike;

/**
 * Documenting our class identifiers compared to our data class identifiers
 *
 * $routeId = "OBJECTID"
 * $routeName = "ParentPathName"
 * $routeFile = ..... we will create
 * $routeType = "PathType"
 * $routeSpeedLimit = "PostedSpeedLimit_MPH"
 * routeDescription = "Direction"
 *
**/

require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once(dirname(__DIR__, 2) . "/php/lib/uuid.php");

class DataDownloader {
	public static function pullRoutes() {
		$newRoutes = null;
		$urlBase = "https://res.cloudinary.com/abqbike/raw/upload/v1566336860/BikePaths_jev8gc.json";
		$secrets = new \Secrets("/etc/apache2/capstone-mysql/abqbiketrails.ini");
		$pdo = $secrets->getPdoObject();
		// TODO not including any other class creation, don't think we need to for a Route


		$routes = self::readDataJson($urlBase);

			for ($i = 0; $i <= 3043; $i++) {
				// iterate through array and return all paths
//				var_dump($routes[$i]->geometry->paths);
				// iterate through array and return all object ids
//				var_dump($routes[$i]->attributes->OBJECTID);
				if($routes[$i]->attributes->PathType === "Paved Multiple Use Trail") {
					$routeId = generateUuidV4();
					$description = $routes[$i]->attributes->Comments;
					$routeFile = print_r($routes[$i], true);
					$routeName = $routes[$i]->attributes->ParentPathName;
					$routeSpeedLimit = $routes[$i]->attributes->PostedSpeedLimit_MPH;
					$routeType = $routes[$i]->attributes->PathType;

					var_dump($routeFile);
				}
//				foreach($routes as $route) {
//				}

			}


//			$objectId->routeId;

//			foreach($newRoute as $objectId) {
//				$routeId = generateUuidV4();
//			}
//				$routeDescription = $value->Direction;
//
//			//grab route info from json
//			$objectId = "";
//			foreach($newRoute as $pathType) {
//				$routeId = generateUuidV4();
//
//
//			}

	}

	public static function readDataJson($url) {
		$context = stream_context_create(["http" => ["ignore_errors" => true, "method" => "GET"]]);
		try {
			// file-get-contents returns file in string context
			if(($jsonData = file_get_contents($url, null, $context)) === false) {
				throw(new \RuntimeException("url doesn't produce results"));
			}
			// decode the Json file
			$jsonConverted = json_decode($jsonData);

//			var_dump($jsonConverted);


			$newRoutes = \SplFixedArray::fromArray($jsonConverted->features);
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($newRoutes);
	}
}

echo DataDownloader::pullRoutes();