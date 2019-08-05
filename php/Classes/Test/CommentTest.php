<?php
namespace AbqOutdoorTrails\AbqBike\Test;

use AbqOutdoorTrails\AbqBike\{User, Route};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the Comment class.  Tests *ALL* MySQL/PDO enabled methods for both invalid and valid inputs
 *
 * @see Comment
 * @author wharris21@cmm.edu
 **/
class CommentTest extends DataDesignTest {
	/**
	 * User that created the Comment; this is for foreign key relations
	 *
	 * @var User user
	 **/
	protected $user = null;
}