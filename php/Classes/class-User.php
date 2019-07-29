<?php
namespace Jdunn\abqBike

use Ramsey\Uuid\Uuid;

class User implements \JsonSerializable
		use function Sodium\crypto_box_keypair_from_secretkey_and_publickey;use ValidateDate;
		use ValidateUuid;
/**
 *
 * id for this user is th Primary Key
 * @var Uuid\ $userId
 *
 **/
private $userId;

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

		public_function __construct($newUserId, string $newUserName, string $newUserEmail, string $newUserHash, ?string $newUserActivationToken) {
					try {
						$this->setUserId($newUserId);
						$this->setUsername($newUserName);
						$this->setUserEmail($newUserEmail);
						$this->setUserHash($newUserHash);
						$this->setUserActivationToken($newUserActivationToken);
					} catch(\InvalidArgumentException |\RangeException |\TypeError|\Exception $exception) {
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
				try{
							$uuid = self:validateUuid($newUserId);
				} catch(\InvalidArgumentException |\RangeException |\Exception |\TypeError $exception)
}
