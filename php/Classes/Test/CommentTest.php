<?php
namespace AbqOutdoorTrails\AbqBike\Test;

use AbqOutdoorTrails\AbqBike\{Comment, User, Route};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 3) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the Comment class.  Tests *ALL* MySQL/PDO enabled methods for both invalid and valid inputs
 *
 * @see Comment
 * @author wharris21@cmm.edu
 **/
class CommentTest extends AbqBikeTest {
	/**
	 * User that created the Comment; this is for foreign key relations
	 *
	 * @var User user
	 **/
	protected $user = null;

	/**
	 * Route the Comment is on; this is for foreign key relations
	 *
	 * @var Route route
	 **/
	protected $route = null;

	/**
	 * valid user hash to create the User object to own the test
	 *
	 * @var Uuid VALID_USER_HASH
	 **/
	protected $VALID_USER_HASH;

	/**
	 * content of the Comment
	 *
	 * @var string VALID_COMMENTCONTENT
	 **/
	protected $VALID_COMMENTCONTENT = "PHPUnit test passing?!?";

	/**
	 * timestamp of the comment; this starts as null and is assigned later
	 *
	 * @var \DateTime VALID_COMMENTDATE
	 **/
	protected $VALID_COMMENTDATE = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() : void {
		// run the default setUp() method first
		parent::setUp();
		$password = "abc123";
		$this->VALID_USER_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);

		// create and insert a User to own the test Comment
		$this->user = new User(generateUuidV4(), "deepdivecode", "bob@abc.com", $this->VALID_USER_HASH, null);
		$this->user->insert($this->getPDO());

		// create and insert a Route associated with the test Comment
		$this->route = new Route(generateUuidV4(), "This is a route name", "http://www.waynesworld.com", "Bike Blvd.", 45, "This is a route description");
		$this->route->insert($this->getPDO());

		// calculate the date, using the time the unit test was setup
		$this->VALID_COMMENTDATE = new \DateTime();
	}

	/**
	 * test inserting a valid Comment and verify that the MySQL data matches
	 **/
	public function testInsertValidComment() : void {
		// create a new Comment and insert into MySQL
		$commentId = generateUuidV4();
		$comment = new Comment($commentId, $this->route->getRouteId(), $this->user->getUserId(), $this->VALID_COMMENTCONTENT, $this->VALID_COMMENTDATE);
		$comment->insert($this->getPDO());

		// grab the comment data from MySQL and enforce the fields match our expectations
		$pdoComment = Comment::getCommentsByRouteId($this->getPDO(), $comment->getCommentId());

		$this->assertEquals($pdoComment->getCommentId()->toString(), $commentId->toString());
		$this->assertEquals($pdoComment->getCommentRouteId()->toString(), $commentRouteId->toString());
		$this->assertEquals($pdoComment->getCommentUserId()->toString(), $commentUserId->toString());
		$this->assertEquals($pdoComment->getCommentContent(), $this->VALID_COMMENTCONTENT);
		// format the date to seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoComment->getCommentDate()->getTimestamp(), $this->VALID_COMMENTDATE->getTimestamp());
	}

	/**
	 * test creating a Comment and then deleting it
	 **/
	public function testDeleteValidComment() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("comment");

		// create a new Comment and insert it into MySQL
		$commentId = generateUuidV4();
		$commentRouteId = generateUuidV4();
		$commentUserId = generateUuidV4();
		$comment = new Comment($commentId, $commentRouteId, $commentUserId, $this->VALID_COMMENTCONTENT, $this->VALID_COMMENTDATE);

		// delete the Comment from MySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("comment"));
		$comment->delete($this->getPDO());

		// grab the data from MySQL and enforce the Comment does not exist
		$pdoComment = Comment::getCommentsByRouteId($this->getPDO(), $comment->getCommentRouteId());
		$this->assertNull($pdoComment);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("comment"));
	}
//
//	/**
//	 * test grabbing a Comment that does not exist
//	 **/
//	public function testGetInvalidCommentByCommentId() : void {
//		// grab a comment id that exceeds the maximum allowable comment id
//		$comment = Comment::getCommentId();
//		$this->assertNull($comment);
//	}

	/**
	 * test get comment array by route id
	 **/
	public function testGetValidCommentsByCommentRouteId() : void {
		// count the number of rows and save for later
		$numRows = $this->getConnection()->getRowCount("comment");

		// create a new Comment and insert into MySQL
		$commentId = generateUuidV4();
		$commentRouteId = generateUuidV4();
		$commentUserId = generateUuidV4();

		$comment = new Comment($commentId, $commentRouteId, $commentUserId, $this->VALID_COMMENTCONTENT, $this->VALID_COMMENTDATE);
		$comment->insert($this->getPDO());

		// grab the data from MySQL using getCommentsByRouteId() and enforce the fields match expected values
		$results = Comment::getCommentsByRouteId($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("comment"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("AbqOutdoorTrails\\AbqBike\\Comment", $results);

		// grab the result from the created array and validate it
		$pdoComment = $results[0];
		$this->assertEquals($pdoComment->getCommentId(), $commentId);
		$this->assertEquals($pdoComment->getCommentRouteId(), $commentRouteId);
		$this->assertEquals($pdoComment->getCommentUserId(), $commentUserId);
		$this->assertEquals($pdoComment->getCommentContent(), $this->VALID_COMMENTCONTENT);
		// format the date as seconds since the beginning of time to prevent round off errors
		$this->assertEquals($pdoComment->getCommentDate()->getTimestamp(), $this->VALID_COMMENTDATE->getTimestamp());
	}

	/**
	 * test get comment array by comment date
	 **/
	public function testGetValidCommentsByCommentDate() : void {
		// count the number of rows and save for later
		$numRows = $this->getConnection()->getRowCount("comment");

		// create a new Comment and insert into MySQL
		$commentId = generateUuidV4();
		$commentRouteId = generateUuidV4();
		$commentUserId = generateUuidV4();

		$comment = new Comment($commentId, $commentRouteId, $commentUserId, $this->VALID_COMMENTCONTENT, $this->VALID_COMMENTDATE);
		$comment->insert($this->getPDO());

		// grab the data from MySQL using getCommentsByCommentDate() and enforce the fields match expected values
		$results = Comment::getCommentsByCommentDate($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("comment"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("AbqOutdoorTrails\\AbqBike\\Comment", $results);

		// grab the result from the created array and validate it
		$pdoComment = $results[0];
		$this->assertEquals($pdoComment->getCommentId(), $commentId);
		$this->assertEquals($pdoComment->getCommentRouteId(), $commentRouteId);
		$this->assertEquals($pdoComment->getCommentUserId(), $commentUserId);
		$this->assertEquals($pdoComment->getCommentContent(), $this->VALID_COMMENTCONTENT);
		// format the date as seconds since the beginning of time to prevent round off errors
		$this->assertEquals($pdoComment->getCommentDate()->getTimestamp(), $this->VALID_COMMENTDATE->getTimestamp());
	}
}