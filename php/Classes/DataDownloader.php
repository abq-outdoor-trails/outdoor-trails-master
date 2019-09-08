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
		$urlBase = "../../images/biketrails_wgs84.json";
		$secrets = new \Secrets("/etc/apache2/capstone-mysql/abqbiketrails.ini");
		$pdo = $secrets->getPdoObject();

		$routes = self::readDataJson($urlBase);
		$newArray = [];
//		[ParentPathName => [description => something, routeFile => [
//			[x, y],
//			[x, y],
//			[x, y]
//		] ]];
		for($i = 0; $i < sizeof($routes); $i++) {
			if($routes[$i]->attributes->PathType === "Paved Multiple Use Trail - A paved trail closed to automotive traffic.") {
				if(array_key_exists(trim($routes[$i]->attributes->ParentPath), $newArray)) {
					array_push($newArray[trim($routes[$i]->attributes->ParentPath)]["routeFile"], $routes[$i]->geometry->paths);
				} else {
					$newArray = $newArray + [trim($routes[$i]->attributes->ParentPath) => ["description" => $routes[$i]->attributes->Comments, "routeSpeedLimit" => $routes[$i]->attributes->PostedSpee, "routeFile" => [
							$routes[$i]->geometry->paths
						]]];
				}
//				$routeId = generateUuidV4();
//				$description = $routes[$i]->attributes->Comments;
//				$routeFile = json_encode($newArray[$routes[$i]->attributes->ParentPath]["routeFile"]);
//				$routeName = $routes[$i]->attributes->ParentPath;
//				$routeSpeedLimit = null;
//				$routeType = '';
//				$newRoute = new Route($routeId, $description, $routeFile, $routeName, $routeSpeedLimit, $routeType);
//				var_dump($newRoute);
			}
		}
//		var_dump($newArray);
		foreach($newArray as $key => $entry) {
		    $routeId = generateUuidV4();
		    $description = $entry["description"];
		    $routeFile = json_encode($entry["routeFile"]);
		    $routeName = $key;
		    $routeSpeedLimit = $entry["routeSpeedLimit"];
		    $routeType = null;
		    $newRoute = new Route($routeId, $description, $routeFile, $routeName, $routeSpeedLimit, $routeType);
		    $newRoute->insert($pdo);
        }
//
////				$newArray = ["routeName" => ["route" => []]];
//
////				if($newArray[$route->attributes->ParentPathName]) {
////					$newArray[$route->attributes->ParentPathName] = $newArray[$route->attributes->ParentPathName]  + $route->geometry->paths;
////				} else {
////					$newArray = [$route->attributes->ParentPathName => $route->geometry->paths];
////				}
////				[$route-attributes->ParentPathType][$route-geometry->paths]
////				$newArray = [$route->attributes->ParentPathName => $newArray[$route->attributes->ParentPathName ? $newArray[$route->attributes->ParentPathName] + $route->geometry->paths : $route->geometry->paths];
////				array_push($newArray, [$route->attributes->ParentPathName, $route->geometry->paths]);
//
//			}
//		}
		// ORIGINAL DATA DOWNLOADER
//		foreach($routes as $route) {
//			if($route->attributes->PathType === "Paved Multiple Use Trail - A paved trail closed to automotive traffic.") {
//
//				$routeId = generateUuidV4();
//				$description = $route->attributes->Comments;
//				$routeFile = json_encode($route->geometry->paths);
//				$routeName = $route->attributes->ParentPath;
//				$routeSpeedLimit = $route->attributes->PostedSpee;
//				$routeType = $route->attributes->PathType;
////
////				$newArray = ["routeId" => $routeId, "description" => $description, "routeFile" => $routeFile, "routeName" => $routeName, "routeSpeedLimit" => $routeSpeedLimit, "routeType" => $routeType];
////				file_put_contents("../../images/bikepathsEdited.json", $newArray, FILE_APPEND);
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