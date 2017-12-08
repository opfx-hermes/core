<?php

namespace hermes\services;

use hermes\entities\User;
use hermes\CoreException;
use hermes\IUser;
use opfx\data\Db;
use opfx\data\mysql\MySqlConnection;

/**
 * @service accounts
 */
class AccountsService extends AbstractService {

	public function register( string $username, string $fullname, string $birthdate, string $email, string $password, string $referralCode = '' ) {
		$this->validateUsername( $username );
		$this->validateEmail( $email );

		try {
			$conn = Db::getConnection( 'auth' );
			$sql = "INSERT INTO `account` (`username`,`password`) VALUES ('$username', '$password')";
			$id = $conn->execSql( $sql );
		} catch ( MySqlConnection $e ) {
			throw new CoreException( "Failed to register account.", 0, $e );
		}
		return true;
	}

	public function authenticate( $username, $password ) {
	}

	public function validateUsername( string $username ) {
	}

	public function validateEmail( string $email ) {
	}

	public function activate() {
	}

	public function login( string $username, $password ): IUser {
		if ( empty( $password ) ) {
			throw new CoreException( 'Invalid account information.' );
		}
		$user = new User();
		$user->setUsername( $username );
		return $user;
	}
}