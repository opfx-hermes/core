<?php

namespace hermes;

use PHPUnit_Framework_TestCase;
use hermes\internal\service\PhpUnitServiceContext;

class TestCase extends PHPUnit_Framework_TestCase {

	/**
	 *
	 * @var IContext
	 */
	private $ctx;

	public function setUp() {
		parent::setUp();
		$this->ctx = new PhpUnitServiceContext();
	}

	protected function getContext(): IContext {
		return $this->ctx;
	}
}