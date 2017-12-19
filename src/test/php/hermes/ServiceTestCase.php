<?php

namespace hermes;

use hermes\TestCase;

class ServiceTestCase extends TestCase {
	private $service;

	public function setUp() {
		parent::setUp();
		$ctx = $this->getContext();
		//$this->service = $ctx->getService( static::SERVICE_NAME );
	}

	/**
	 * @test
	 *
	 * @param string $name
	 * @return IService
	 */
	public function getService( string $name = '' ) {
		$ctx = $this->getContext();
		if ( empty( $name ) ) {
			$name = static::SERVICE_NAME;
		}
		$service = $ctx->getService( $name );
		$this->assertInstanceOf( IService::class, $service );

		return $service;
	}
}