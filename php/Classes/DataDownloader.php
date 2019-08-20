<?php

namespace AbqOutdoorTrails\AbqBike;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once(dirname(__DIR__,2 ) . "/php/lib/uuid.php");

class DataDownloader {
	public static function pullRoutes() {
		$newRoutes = null;
		$url = "https://res.cloudinary.com/abqbike/raw/upload/v1566336860/BikePaths_jev8gc.json";
		$secrets = new \Secrets("/etc/apache2/capstone-mysql/abqbiketrails.ini");
		$pdo = $secrets->getPdoObject();
		//$password = TODO figure out how we are going to deal with a password here (do we need a password even?)
		//$hash TODO see above
		// TODO not including any other class creation, don't think we need to for a Route

		for($i = 0; $i <= 0; $i++) {
			//TODO figure out the loopy
		}
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
			// format
			$jsonFeatures = $jsonConverted->Result;
			$newRoutes = \SplFixedArray::fromArray($jsonFeatures);
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($newRoutes);
	}
}