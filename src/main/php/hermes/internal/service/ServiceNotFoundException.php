<?php

namespace hermes\internal\service;

use hermes\CoreException;

class ServiceNotFoundException extends CoreException {

	public function __construct( $message ) {
		parent::__construct( $message, 404, null );
	}

	static public function failedToLocate( $serviceName ) {
		throw new static( "Failed to locate '$serviceName' service." );
	}

	static public function notAService( $serviceName ) {
		throw new static( "The '$serviceName' plugin is not a service." );
	}

// 	static public function methodNotFound($serviceName, $methodName) {
	// 		throw new static("")
	// 	}
}