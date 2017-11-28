<?php

namespace hermes\entities;

use hermes\IUser;

class Account extends AbstractEntity {

	/**
	 * Returns the user associated with this account.
	 *
	 * @return IUser
	 */
	public function getUser(): IUser {
		return null;
	}
}