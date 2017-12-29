<?php

namespace hermes\internal\collections;

use opfx\Object;
use hermes\internal\repositories\AccountRepository;
use hermes\entities\IAccount;
use hermes\IEntity;

class AccountSet extends Object {
	private $repo;
	public $elements;

	public function __construct() {
		parent::__construct();
		$this->repo = AccountRepository::getInstance();
		$this->elements = [ ];
	}

	public function getProvider() {
		return $this->repo;
	}

	public function contains( IEntity $account ): bool {
		if ( ! ( $account instanceof IAccount ) ) {
			return false;
		}
		/* @var IAccount $account */
		if ( ! isset( $this->elements[$account->getKey()] ) ) {
			$this->repo->loadOne( $account );
			if ( $account->getKey() > 0 ) {
				$this->elements[$account->getKey()] = $account;
				return true;
			}
		}
		return false;
	}

	public function where( $predicate ) {
		return $this->getProvider()->createQuery( $this );
	}

	public function first() {
		if ( empty( $this->elements ) ) {
			$this->repo->load( $this );
		}
		if ( empty( $this->elements ) ) {
			return null;
		}
		$values = array_values( $this->elements );
		return $values[0];
	}

	public function add( IAccount $account ) {
	}
}
