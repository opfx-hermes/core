<?php

namespace hermes\internal\service;

use Object;
use hermes\IService;
use hermes\service\IServiceRequest;
use hermes\service\IServiceResponse;

class Router extends Object {

	public function __construct() {
		parent::__construct();
	}

	public function getService( string $serviceName ): IService {
		if ( empty( $serviceName ) ) {
			// 			//IllegalArgumentException::emptyString(1);
		}
	}

	public function executeServiceCall( IServiceRequest $request, IServiceResponse $response ): void {
		$service = new \hermes\sample\SamplePlugin();
		$params = array ();
		$service->invoke( 'ping', $params );
		//TODO deal with the response
	}
}
