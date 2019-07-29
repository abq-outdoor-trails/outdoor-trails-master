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
	// traits being used in this class
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
	private $commentRouteId;
	/**
	 * user id for this comment; this is a foreign key
	 * @var Uuid $commentsUserId
	 **/
	private $commentUserId;
	/**
	 * string content of this comment
	 * @var string $commentContent
	 **/
	private $commentContent;
	/**
	 * PHP DateTime object containing the validated date the comment was submitted
	 * @var \DateTime $commentDate
	 **/
	private $commentDate;

	/**
	 * constructor method for the Comments class
	 *
	 * @param Uuid/string $newCommentId id of this comment
	 * @param Uuid/string $newCommentRouteId id of the route associated with this comment
	 * @param Uuid/string $newCommentUserId id of the user associated with this comment
	 * @param string $newCommentContent string value of comment content
	 * @param \DateTime|string|null DateTime value of the comment's date
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of range (greater or less than than specified range)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newCommentId, $newCommentRouteId, $newCommentUserId, string $newCommentContent, $newCommentDate = null) {
		try {
			$this->setCommentId($newCommentId);
			$this->setCommentRouteId($newCommentRouteId);
			$this->setCommentUserId($newCommentUserId);
			$this->setCommentContent($newCommentContent);
			$this->setCommentDate($newCommentDate);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * getter method for comment id
	 *
	 * @return Uuid value of commentId
	 **/
	public function getCommentId() : Uuid {
		return($this->commentId);
	}

	/**
	 * setter method for comment id
	 *
	 * @param Uuid $newCommentId new value of comment id
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of range (greater or less than specified range)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function setCommentId($newCommentId) : void {
		try {
			// try to validate the uuid
			$uuid = self::validateUuid($newCommentId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			// throw error if invalid uuid
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// store the comment id
		$this->commentId = $uuid;
	}

	/**
	 * getter method for comment's associated route id
	 *
	 * @return Uuid value of commentRouteId
	 **/
	public function getCommentRouteId() : Uuid {
		return($this->commentRouteId);
	}

	/**
	 * setter method for comment's associated route id
	 *
	 * @param Uuid $newCommentRouteId value of new comment's associated route id
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of range (greater or less than specified range)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function setCommentRouteId($newCommentRouteId) : void {
		try {
			// try to validate the uuid
			$uuid = self::validateUuid($newCommentRouteId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			// throw error if invalid uuid
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// store the comment's associated route id
		$this->commentRouteId = $uuid;
	}

	/**
	 * getter method for comment's associated user id
	 *
	 * @return Uuid value of commentUserId
	 **/
	public function getCommentUserId() : Uuid {
		return($this->commentUserId);
	}

	/**
	 * setter method for comment's associated user id
	 *
	 * @param Uuid $newCommentUserId value of new comment's associated user id
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of range (greater or less than specified range)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function setCommentUserId($newCommentUserId) : void {
		try {
			// try to validate the uuid
			$uuid = self::validateUuid($newCommentUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			// throw error if invalid uuid
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// store the comment's associated route id
		$this->commentUserId = $uuid;
	}
}