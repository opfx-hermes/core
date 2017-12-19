<?php

namespace hermes\services;

use hermes\entities\User;
use hermes\CoreException;
use hermes\IUser;
use opfx\data\Db;
use opfx\data\mysql\MySqlConnection;
use hermes\entities\IAccount;
use hermes\internal\collections\AccountSet;
use hermes\internal\entities\Account;

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

	public function loginx( string $username, string $password ): IUser {
		$accounts = $this->getAccounts();
// 		$account = $accounts->where( function ( IAccount $account ) use (&$username ): bool {
// 			$account->getUsername() === $username;
// 		} )->first();

		$account = $accounts->first();
		if ( is_null( $account ) ) {
			// FIXME
		}
		$password = $this->encryptPassword( $password );
		if ( $password !== $account->getPassword() ) {
			//FIXME
		}
		$user = $account->getUser();
		return $user;
	}

	public function getAccounts() {
		static $accounts = null;
		if ( $accounts === null ) {
			$accounts = new AccountSet();
		}
		return $accounts;
	}

	public function login( string $username, string $password ): IUser {
		if ( empty( $username ) ) {
			throw new CoreException( 'Invalid account information.' );
		}
		if ( empty( $password ) ) {
			throw new CoreException( 'Invalid account information.' );
		}
		if ( $password === 'error' ) {
			throw new CoreException( 'Invalid account information.' );
		}

// 		$account = new Account( - 2, $username );
// 		$accounts = $this->getAccounts();
// 		if ( ! $accounts->contains( $account ) ) {
// 			throw CoreException( 'Invalid account information.' );
// 		}
// 		if ( $account->getPassword() !== $password ) {
// 			throw CoreException( 'Invalid account information.' );
// 		}
		$user = new User();
		$user->setUsername( $username );
		return $user;
	}

	private function encryptPassword( string $password ): string {
		return crypt( $password, $password );
	}
}