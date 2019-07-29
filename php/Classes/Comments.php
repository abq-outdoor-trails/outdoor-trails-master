<?php

namespace ; //TODO CHANGE NAMESPACE!!!

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Class declaration for the Comments class
 *
 * This class will contain all the state variables and methods for any instance of Comments
 * @package //TODO PUT NAMESPACE HERE
 * @author wharris21
 **/
class Comments {
	use ValidateUuid;
	use ValidateDate;

	/**
	 * id for this comment; this is the primary key
	 * @var Uuid $commentId
	 **/
	private $commentId;
	/**
	 * route id for this comment; this is a foreign key
	 * @var Uuid $commentsRouteId
	 **/
	private $commentsRouteId;
	/**
	 * user id for this comment; this is a foreign key
	 * @var Uuid $commentsUserId
	 **/
	private $commentsUserId;
	/**
	 * string content of this comment
	 * @var string $commentContent
	 **/
	private $commentContent;
	/**
	 * DateTime object containing the validated date
	 * @var \DateTime $commentDate
	 **/
	private $commentDate;
}