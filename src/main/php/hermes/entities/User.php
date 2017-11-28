<?php

namespace hermes\entities;

use hermes\IUser;

/**
 * @alias User;
 */
class User extends AbstractEntity implements IUser {

	public function __construct() {
		parent::__construct();
	}
}