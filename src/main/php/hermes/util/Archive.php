<?php

namespace hermes\util;

use opfx\Object;

abstract class Archive extends \stdClass {
	/**
	 *
	 * @var bool
	 */
	private $storing;
	protected $data;

	protected function __construct( bool $storing = false, $data = null ) {
		$this->storing = $storing;
		$this->data = $data;
	}

	abstract public function write( $name, $data ): void;

	abstract public function read( $data );

	public function isStoring(): bool {
		return $this->storing;
	}
}