<?php

namespace hermes\services;

/**
 * This is a sample service
 * @service UserService
 */
class UserService extends AbstractService {

	public function authenticate( User $user ) {
		$password = $user->getPassword();
		$user = $this->getUser( $user );

		if ( $user->getPassword() === $password ) {
			return true;
		}
	}

	/**
	 * @api
	 */
	public function getUser(): void {
	}

	public function getUsers() {
	}
}
