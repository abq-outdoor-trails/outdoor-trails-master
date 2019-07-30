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
					} catch(\InvalidArgumentException |\RangeException |\Exception |\TypeError $exception) {
								$exceptionType = get_class($exception);
								throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//convert and store the user id
		$this->userId = $uuid;
	}
		/**
		 * accessor method for account user name
		 *
		 * @return string value of the user name
		 *
	 	**/

	public function getUserName() : ?string {
				return ($this->userName)
	}

		/**
		 * mutator method for account user name
		 *
		 * @param string $newUserName
		 * @throws \InvalidArgumentException if string is too long or is insecure
		 * @throws \RangeException if the userName is too long
		 * @throws \TypeError if the userName is not a string
		 *
		 **/

	public function setUserName(string $newUserName) : void {
				//verify the userName is secure//
				$newUserName = trim($newUserName);
				$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
				if(empty($newUserName) === true) {
								throw(new \InvalidArgumentException("User Name is insecure"));

				}

				//store the user name//
				$this->userName = $newUserName;
	}

		/**
		 * accessor method for user email
		 *
		 * @return string value of email
		 *
		 **/

	public function getUserEmail(): string {
				return $this->userEmail;
	}

		/**
		 * mutator for the user email
		 *
		 * @param string $newUserEmail new value of email
		 * @throws \InvalidArgumentException if $newUserEmail is not a valid email of insecure
		 * @throws \RangeException if $newUserEmail is > 128 characters
		 * @throws \TypeError if $newUserEmail is not a strin
		 *
		 **/
	public function setUserEmail(string $newUserEmail): void {

				//verify the email will fit in the database//
				$newUserEmail = trim($newUserEmail);
				$newUserEmail = filter_var($newUserEmail, FILTER_VALIDATE_EMAIL);
				if(empty($newUserEmail) === true) {
							throw(new \InvalidArgumentException("user email is empty or insecure"));

				}

				//verify the email will fit in the database//
				if(strlen($newUserEmail) > 128) {
					throw(new \RangeException("user email is too large"));
				}

				//store the email//
				$this->userEmail = $newUserEmail;
	}

				/**
				 * accessor method for user hash
				 *
				 * @return string value of hash
				 *
				 **/

		public function getUserHash(): string {
					return $this->userHash;
		}

				/**
				 *
				 * mutator method for user hash
				 *
				 * @param string $newUserHash
				 * @throws \InvalidArgumentException if the hash is not secure
				 * @throws \RangeException if the hash is not 97 characters
				 * @throws \TypeError if profile hash is not a string
				 *
				 **/

		public function setUserHash(string $newUserHash): void {
			//enforce that the hash is properly formatted//
			$newUserHash = trim($newUserHash);
			if(empty($newUserHash) === true) {
						throw(new \InvalidArgumentException("user password hash empty or insecure"));

			}

			//enforce the hash is really an Argon hash//
			$userHashInfo = password_get_info("$newUserHash");
			if(userHashInfo["algoName"] !== "argon2i") {
						throw(new \InvalidArgumentException("user hash is not a valid hash"));

			}

			//enforce that the hash is exactly 97 characters//
			if(strlen($newUserHash) !==97) {
							throw(new \RangeException("User hash must be 97 characters"));

			}

			//store the hash//
			$this->userHash = $newUserHash;
		}

		/**
		 * accessor method for user activation token
		 *
		 * @return string value of the activation token
		 *
		 **/
	public function getUserActivationToken() : ?string {
				return ($this->userActivationToken);
	}

		/**
		 * mutator method for user activation token
		 *
		 * @param string $newUserActivationToken
		 * @throws \InvalidArgumentException if the token is not a string or insecure
		 * @throws \RangeException if the tokn is not exactly 32 characters
		 * @throws \TypeError if the activation token is not a string
		 *
		 **/

	public function setUserActivationToken(?string $newUserActivationToken): void {
				if($newUserActivationToken === null) {
				$this->userActivationToken = null;
				return;
				}

				$newUserActivationToken = strtolower(trim($newUserActivationToken));
				if(ctype_xdigit($newUserActivationToken) === false) {
							throw(new\RangeException("user activation is not valid"));
				}

				//make sure user activation token is only 32 characters//
				if(strlen($newUserActivationToken) !== 32) {
						throw(new\RangeException("user activation token has to be 32"));

				}
				$this->userActivationToken = $newUserActivationToken;
	}
}