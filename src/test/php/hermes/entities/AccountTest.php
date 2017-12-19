<?php

namespace hermes\entities;

use hermes\TestCase;
use hermes\internal\entities\Account;

class AccountTest extends TestCase {

	/**
	 * @test
	 */
	public function activate() {
		$account = new Account( - 1, 'btw01' );
		$account->activate();
		$actual = $account->isActive();
		$this->assertTrue( $actual );
	}

	/**
	 * @test
	 */
	public function setUsername() {
		$account = new Account( - 1, 'btw01' );
		$account->setUsername( 'john' );
	}
}