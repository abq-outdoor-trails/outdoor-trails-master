<?php

namespace AbqOutdoorTrails\AbqBike;

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
	 * id for this user is the Primary Key
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
		} catch(\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
			//determine what exception type was thrown//
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for user id
	 *
	 * @return \Uuid value of user id (or null if new user)
	 **/

	public function getUserId(): Uuid {
		return ($this->userId);
	}

	/**
	 * mutator method for user id
	 *
	 * @param Uuid | string $newUserId value of new user id
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if the user id is not valid
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

	public function getUserName(): string {
		return ($this->userName);
	}

	/**
	 * mutator method for account user name
	 *
	 * @param string $newUserName
	 * @throws \InvalidArgumentException if user name is insecure
	 * @throws \RangeException if the userName is too long
	 * @throws \TypeError if the userName is not a string
	 *
	 **/

	public function setUserName(string $newUserName): void {
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
	 * @throws \TypeError if $newUserEmail is not a string
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
		$userHashInfo = password_get_info($newUserHash);
		if($userHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("user hash is not a valid hash"));

		}

		//enforce that the hash is exactly 97 characters//
		if(strlen($newUserHash) !== 97) {
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
	public function getUserActivationToken(): ?string {
		return ($this->userActivationToken);
	}

	/**
	 * mutator method for user activation token
	 *
	 * @param string $newUserActivationToken
	 * @throws \InvalidArgumentException if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
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
			throw(new\RangeException("user activation token has to be 32 characters"));

		}
		$this->userActivationToken = $newUserActivationToken;
	}

	/**
	 * inserts this user into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 *
	 *
	 **/
	public function insert(\PDO $pdo): void {

		//create query template//
		$query = "INSERT INTO `user`(userId, userName, userEmail, userHash, userActivationToken) VALUES (:userId, :userName, :userEmail, :userHash, :userActivationToken)";
		$statement = $pdo->prepare($query);

		$parameters = ["userId" => $this->userId->getBytes(), "userName" => $this->userName, "userEmail" => $this->userEmail, "userHash" => $this->userHash, "userActivationToken" => $this->userActivationToken];
		$statement->execute($parameters);

	}

	/**
	 * deletes this user from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 *
	 *
	 **/
	public function delete(\PDO $pdo): void {

		//create query template//
		$query = "DELETE FROM `user` WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template//
		$parameters = ["userId" => $this->userId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this user from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 *
	 *
	 **/
	public function update(\PDO $pdo): void {
		// create query template
		$query = "UPDATE `user` SET  userName = :userName, userEmail = :userEmail, userHash = :userHash, userActivationToken = :userActivationToken WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template

		$parameters = ["userId" => $this->userId->getBytes(), "userName" => $this->userName, "userEmail" => $this->userEmail, "userHash" => $this->userHash, "userActivationToken" => $this->userActivationToken];
		$statement->execute($parameters);
	}

	/**
	 * gets the user by the userId
	 *
	 * @param \PDO $pdo $pdo PDO connection object
	 * @param $userId Id to search for the (data type should be mixed/not specific)
	 * @return user|null user or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 *
	 **/
	public static function getUserByUserId(\PDO $pdo, $userId): ?User {
		//sanitize the user id before searching//
		try {
			$userId = self::validateUuid($userId);
		} catch(\InvalidArgumentException|\RangeException|\Exception|\TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		//create query template//
		$query = "SELECT userId, userName, userEmail, userHash, userActivationToken FROM `user` WHERE userId = :userId";
		$statement = $pdo->prepare($query);

		//bind the user id to the placeholder in the template
		$parameters = ["userId" => $userId->getBytes()];
		$statement->execute($parameters);

		//grab the user from mySQL
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {

				$user = new user($row["userId"], $row["userName"], $row["userEmail"], $row["userHash"], $row["userActivationToken"]);

			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}

	/**
	 * gets the user by user name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userName user name to search for
	 * @return \SplFixedArray of all users found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 *
	 *
	 **/
	public static function getUserByUserName(\PDO $pdo, string $userName): \SPLFixedArray {
		//sanitize the user name before searching
		$userName = trim($userName);
		$userName = filter_var($userName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($userName) === true) {
			throw(new \PDOException("not a valid user name"));
		}

		//create query template
		$query = "SELECT userId, userName, userEmail, userHash, userActivationToken FROM `user` WHERE userName= :userName";
		$statement = $pdo->prepare($query);

		//bind the user name to the place holder in the template
		$parameters = ["userName" => $userName];
		$statement->execute($parameters);


		$user = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		while(($row = $statement->fetch()) !== false) {
			try {
				$user = new user($row[$userId], $row["userName"], $row["userEmail"], $row["userHash"], $row["userActivationToken"]);
				$user[$user->key()] = $user;
				$user->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($user);
	}

	/**
	 * gets the user by email
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userEmail email to search for
	 * @return user|null user or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 *
	 *
	 **/
	public static function getUserByUserEmail(\PDO $pdo, string $userEmail): ?user {
		//sanitize the email before searching
		$userEmail = trim($userEmail);
		$userEmail = filter_var($userEmail, FILTER_VALIDATE_EMAIL);

		if(empty($userEmail) === true) {
			throw(new \PDOException("not a valid email"));
		}

		//create query template
		$query = "SELECT userId, userName, userEmail, userHash, userActivationToken FROM `user` WHERE userEmail = :userEmail";
		$statement = $pdo->prepare($query);

		//bind the user email to the profile holder in the template
		$parameters = ["userEmail" => $userEmail];
		$statement->execute($parameters);

		//grab the user from mySQL
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new user($row["userId"], $row["userName"], $row["userEmail"], $row["userHash"], $row["userActivationToken"]);

			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}

	/**
	 * get the user by the user activation token
	 *
	 * @param string $userActivationToken
	 * @param \PDO object $pdo
	 * @return user | null user or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 *
	 *
	 **/
	public static function getUserByUserActivationToken(\PDO $pdo, string $userActivationToken): ?user {
		//make sure activation token is in the right format ahd that it is a string representation of a hexadecimal
		$userActivationToken = trim($userActivationToken);
		if(ctype_xdigit($userActivationToken) === false) {
			throw(new \InvalidArgumentException("user activation token is empty or in the wrong format"));

		}

		//create the query template
		$query = "SELECT userId, userName, userEmail, userHash, userActivationToken FROM `user` WHERE userActivationToken = :userActivationToken";
		$statement = $pdo->prepare($query);

		//bind the user activation token to the placeholder in the template
		$parameters = ["userActivationToken" => $userActivationToken];
		$statement->execute($parameters);

		//grab the user from mySQL
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new user($row["userId"], $row["userName"], $row["userEmail"], $row["userHash"], $row["userActivationToken"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["profileId"] = $this->profileId->toString();
		unset($fields["profileActivationToken"]);
		unset($fields["profileHash"]);
		return ($fields);
	}

		/**
		 * inserts this user into mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 *
		 *
		 **/
	public function insert(\PDO $pdo): void {

		//create query template//
		$query = "INSERT INTO user(userId, userName, userEmail, userHash, userActivationToken) VALUES (:userId, :userName, :userEmail, :userHash, :userActivationToken)";
		$statement = $pdo->prepareI($query);

		$parameters = ["userId" => $this->userId-getBytes(), "userName" => $this->userName, "userEmail" => $this->userEmail, "userHash" => $this->userHash, "userActivationToken" => $this->userActivationToken];
		$statement->execute($parameters);

	}

		/**
		 * deletes this user from mySQL
		 *
		 * @param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 *
		 *
		 **/
	public function delete(\PDO $pdo): void {

					//create query template//
					$query = "DELETE FROM user WHERE userId = :userId";
					$statement = $pdo->prepare($query);

					//bind the member variables to the place holders in the template//
					$parameters = ["userId" => $this->userId->getBytes()];
					$statement->execute($parameters);
	}
}