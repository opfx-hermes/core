<?php

namespace hermes\entities;

use hermes\IUser;
use hermes\IMarshallable;
use hermes\util\Archive;
use hermes\util\TMarshallable;

/**
 * @alias User;
 */
class User extends AbstractEntity implements IUser, IMarshallable {

	use TMarshallable;
	private $username;

	public function __construct() {
		parent::__construct();
	}

	public function setUsername( string $username ) {
		$this->username = $username;
	}

	public function marshall( Archive $archive ): void {
		if ( $archive->isStoring() ) {
			$archive->type = 'User';
			$archive->id = 234543;
			$archive->username = $this->username;
		}
	}
}