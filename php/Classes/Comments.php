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
	 * DateTime object containing the validated date
	 * @var \DateTime $commentDate
	 **/
	private $commentDate;

	/**
	 * constructor method for the Comments class
	 *
	 * @param Uuid $newCommentId id of this comment
	 * @param Uuid $newCommentRouteId id of the route associated with this comment
	 * @param Uuid $newCommentUserId id of the user associated with this comment
	 * @param string $newCommentContent string value of comment content
	 * @param \DateTime DateTime value of the comment's date
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of range (greater than specified range)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other error occurs
	 **/
	public function __construct($newCommentId, $newCommentRouteId, $newCommentUserId, $newCommentContent, $newCommentDate) {
		try {
			$this->setCommentId($newCommentId);
			$this->setCommentsRouteId($newCommentRouteId);
			$this->setCommentsUserId($newCommentUserId);
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
	 * @return Uuid value of comment id
	 **/
	public function getCommentId() {
		return($this->commentId);
	}

	/**
	 * setter method for comment id
	 *
	 * @param Uuid $commentId new value of comment id
	 *
	 **/
	public function setCommentId($commentId) {

	}
}