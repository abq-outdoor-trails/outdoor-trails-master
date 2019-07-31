<?php

namespace AbqOutdoorTrails\AbqBike;

require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Class declaration for the Comments class
 *
 * This class will contain all the state variables and methods for any instance of Comments
 * @package AbqOutdoorTrails\AbqBike;
 * @author wharris21
 **/
class Comments implements \JsonSerializable {
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

	/**
	 * getter method for comment content
	 *
	 * @return string value of comment's content
	 **/
	public function getCommentContent() : string {
		return($this->commentContent);
	}

	/**
	 * setter method for comment content
	 *
	 * @param string $newCommentContent
	 * @throws \InvalidArgumentException if comment content is empty or insecure
	 * @throws \RangeException if comment content is too large or negative
	 **/
	public function setCommentContent(string $newCommentContent) : void {
		// trim, sanitize, and verify comment content is secure
		$newCommentContent = trim($newCommentContent);
		$newCommentContent = filter_var($newCommentContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCommentContent)) {
			throw(new \InvalidArgumentException('Comment content is empty or insecure'));
		}
		// verify the comment will fit in the database
		if(strlen($newCommentContent) > 256) {
			throw(new \RangeException('Comment content too large (must be 256 characters or less)'));
		}
		// store the comment content
		$this->commentContent = $newCommentContent;
	}

	/**
	 * getter method for comment date
	 *
	 * @return \DateTime PHP DateTime object for date comment was posted
	 **/
	public function getCommentDate() : \DateTime {
		return($this->commentDate);
	}

	/**
	 * setter method for comment date
	 *
	 * @param \DateTime $newCommentDate
	 * @throws \InvalidArgumentException if date is not valid`
	 * @throws \RangeException if date is out of valid range
	 * @throws \Exception if any other exception occurs
	 **/
	public function setCommentDate($newCommentDate = NULL) : void {
		// if the date is null, use the current date and time
		if($newCommentDate === NULL) {
			$this->commentDate = new \DateTime();
			return;
		}
		// store the date using the ValidateDate trait
		try {
			$newCommentDate = self::validateDateTime($newCommentDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// store date on the object
		$this->commentDate = $newCommentDate;
	}

	/**
	 * inserts this comment into MySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when MySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {
		// create insert query template
		$query ="INSERT INTO comments(commentId, commentRouteId, commentUserId, commentContent, commentDate) VALUES(:commentId, :commentRouteId, :commentUserId, :commentContent, :commentDate)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the placeholders in the insert query template
		$formattedDate = $this->commentDate->format("Y-m-d H:i:s.u");
		$parameters = ["commentId" => $this->commentId->getBytes(), "commentRouteId" => $this->commentRouteId->getBytes(), "commentUserId" => $this->commentUserId->getBytes(), "commentContent" => $this->commentContent, "commentDate" => $formattedDate];
		$statement->execute($parameters);
	}

	/**
	 * deletes this comment from MySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when MySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {
		// create delete query template
		$query = "DELETE FROM comments WHERE commentId = :commentId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the placeholder in the query template
		$parameters = ["commentId" => $this->commentId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * gets comments by route id, for display on the individual route page
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid | string $routeId route id to search by
	 * @return \SplFixedArray SplFixedArray of Routes found
	 * @throws \PDOException when MySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getCommentsByRouteId(\PDO $pdo, Uuid $routeId) : \SplFixedArray{
		try {
			$routeId = self::validateUuid($routeId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 */
	public function jsonSerialize() : array {
		// get the state variables
		$fields = get_object_vars($this);

		// convert id values to strings
		$fields["commentId"] = $this->commentId->toString();
		$fields["commentRouteId"] = $this->commentRouteId->toString();
		$fields["commentUserId"] = $this->commentUserId->toString();

		// format the date so the front end can use it
		$fields["commentDate"] = round(floatval($this->commentDate->format("U.u")) * 1000);
		return($fields);
	}
}