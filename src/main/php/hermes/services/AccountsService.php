<?php

namespace hermes\services;

use hermes\entities\User;
use hermes\CoreException;

/**
 * @service AccountsService
 */
class AccountsService extends AbstractService {

	public function register() {
	}

	public function authenticate( $username, $password ) {
	}

	public function validateUsername( string $username ) {
	}

	public function validateEmail( string $email ) {
	}

	public function activate() {
	}

	public function login( string $username, $password ) {
		if ( empty( $password ) ) {
			throw new CoreException( 'Invalid account information.' );
		}
		$user = new User();
		$user->setUsername( $username );
		return $user;
	}
}