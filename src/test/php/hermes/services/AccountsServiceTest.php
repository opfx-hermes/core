<?php

namespace hermes\services;

use hermes\ServiceTestCase;

class AccountsServiceTest extends ServiceTestCase {
	const SERVICE_NAME = 'accounts';

	public function setUp() {
		parent::setUp();
	}

	/**
	 * @test
	 *
	 * {@inheritdoc}
	 *
	 * @see \hermes\ServiceTestCase::getService()
	 */
	public function getService( string $name = '' ) {
		return parent::getService( $name );
	}

	/**
	 * @depends getService
	 * @test
	 */
	public function register( AccountsService $service ) {
		$username = 'btw01';
		$fullname = 'john doe';
		$birthdate = '2007-12-23';
		$email = 'btw01@gmail.com';
		$password = 'gigel';

		$actual = $service->register( $username, $fullname, $birthdate, $email, $password );
	}

	/**
	 * @depends getService
	 * @test
	 */
	public function login( AccountsService $service ) {
		$username = 'btw01';
		$password = 'gigel';
		$actual = $service->login( $username, $password );
	}
}