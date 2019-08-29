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
 * routeDescription = "Comments"
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

		$routes = self::readDataJson($urlBase);
		$newArray = [];

		foreach($routes as $key => $route) {
			if($route->attributes->PathType === "Paved Multiple Use Trail") {
				$routeFile = $route->geometry->paths[0];


//				$newArray = ["routeName" => ["route" => []]];

//				if($newArray[$route->attributes->ParentPathName]) {
//					$newArray[$route->attributes->ParentPathName] = $newArray[$route->attributes->ParentPathName]  + $route->geometry->paths;
//				} else {
//					$newArray = [$route->attributes->ParentPathName => $route->geometry->paths];
//				}
//				[$route-attributes->ParentPathType][$route-geometry->paths]
//				$newArray = [$route->attributes->ParentPathName => $newArray[$route->attributes->ParentPathName ? $newArray[$route->attributes->ParentPathName] + $route->geometry->paths : $route->geometry->paths];
//				array_push($newArray, [$route->attributes->ParentPathName, $route->geometry->paths]);

			}
		}
var_dump($newArray);
//		foreach($routes as $route) {
//			if($route->attributes->PathType === "Paved Multiple Use Trail") {
//
//				$routeId = generateUuidV4();
//				$description = $route->attributes->Comments;
//				$routeFile = json_encode($route->geometry->paths);
//				$routeName = $route->attributes->ParentPathName;
//				$routeSpeedLimit = $route->attributes->PostedSpeedLimit_MPH;
//				$routeType = $route->attributes->PathType;
//
//				// insert Route into database
//				$newRoute = new Route($routeId, $description, $routeFile, $routeName, $routeSpeedLimit, $routeType);
//				$newRoute->insert($pdo);
//			}
//		}
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