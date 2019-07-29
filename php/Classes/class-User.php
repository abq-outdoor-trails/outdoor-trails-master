<?php
namespace Jdunn\abqBike

use Ramsey\Uuid\Uuid;

class User implements \JsonSerializable
		use ValidateDate;
		use ValidateUuid;
/**
 *
 * id for this user is th Primary Key
 *
 *
 **/
private $userId;
/**
 *
 *
 *
 **/

/** constructor for user Classes
 *
 *
 *
 **/