<?php

namespace hermes;

use opfx\Object;
use hermes\internal\service\ServiceNotFoundException;

abstract class AbstractPlugin extends Object {

	protected function __construct() {
		parent::__construct();
	}

	public function getName(): string {
		$name = get_called_class();
		return $name;
	}

	public function invoke( string $methodName, array $parameters ) {
		if ( ! ( $this instanceof IService ) ) {
			ServiceNotFoundException::notAService( $this->getName() );
		}
		if ( ! method_exists( $this, "do$methodName" ) ) {
		}
	}

	public function handle() {
	}
}