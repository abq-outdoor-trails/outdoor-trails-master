<?php

namespace AbqOutdoorTrails;

require_once(dirname(__DIR__) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;

/**
 * Class User
 * @package AbqOutdoorTrails
 * This is a class for a user of ABQ trails application
 * This represents all data contained in a user id
 * @author JDunn
 **/
	class User implements \JsonSerializable {

	use ValidateUuid;
	/**
 	*
 	* id for this user is th Primary Key
 	* @var Uuid\ $userId
 	*
 	**/
	private $userId;

	/**
	 * User Name of user this is unique
	 * @var string userName
	 **/
	private $userName;

	/**
	 * Email address for user this is unique
	 * @var string userEmail
	 *
	 **/
	private $userEmail;

	/**
	 * Hash or password for the user
	 * @var string profileHash
	 **/
	private $userHash;

	/**
	 * Activation Token for the user
	 * @var string userActivationToken
	 **/
	private $userActivationToken;

	/** constructor for user Classes
	 *
	 * @param string | Uuid $newUserId of this user or null if a new User
	 * @param string $newUserName of this user or null if already a value
	 * @param string $newUserEmail string containing email value
	 * @param string $newUserHash string containing password hash
	 * @param string $newUserActivationToken user token to safeguard against malicious attacks
	 * @param \DateTime|string|null $newUserActivationToken
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g. strings too long or negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 *
	 **/

	public function __construct($newUserId, string $newUserName, string $newUserEmail, string $newUserHash, ?string $newUserActivationToken) {
		try {
			$this->setUserId($newUserId);
			$this->setUserName($newUserName);
			$this->setUserEmail($newUserEmail);
			$this->setUserHash($newUserHash);
			$this->setUserActivationToken($newUserActivationToken);
		} catch (\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
		//determine what exception type was thrown//
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *accessor method for user id
	 *
	 * @return Uuid value of user id (or null if new user)
	 **/

	public function getUserId(): Uuid {
		return ($this->userId);
	}

	/**
	 * mutator method for user id
	 *
	 * #param Uuid | string $newUserId value of new user id
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if the profile id is not valid
	 **/
	public function setUserId($newUserId): void {
		try {
			$uuid = self::validateUuid($newUserId);
					} catch(\InvalidArgumentException |\RangeException |\Exception |\TypeError $exception)
	}

}