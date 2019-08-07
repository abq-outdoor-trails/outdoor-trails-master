<?php

namespace namespace AbqOutdoorTrails\AbqBike;

use UssHopper\AbqBike\{
	FavoriteRouteId, FavoriteRouteByUserId
};

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

//grab the uuid generator
require_once(dirname(__DIR__, 2) . "lib/uuid.php");

/**
 *Full PHPUnit test for FavoriteRoute class
 *
 * This is a complete PHPUnit test of the FavoriteRoute class.
 * It is complete because *ALL* mySQL/PDO enabled methods are tested* *for both valid and invalid inputs.
 **/

