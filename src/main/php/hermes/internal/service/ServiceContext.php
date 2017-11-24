<?php

namespace hermes\internal\service;

use Object;
use hermes\IService;
use hermes\services\DiscoveryService;
use hermes\services\SampleService;
use hermes\IContext;

class ServiceContext extends Object implements IContext {
	private $services;

	public function __construct() {
		parent::__construct();
		$this->services = [ ];
	}

	public function getService( string $serviceName ): IService {
		if ( isset( $this->services[$serviceName] ) ) {
			return $this->services[$serviceName];
		}
		$serviceClass = ServiceRegistry::getServiceClass( $serviceName );
		if ( empty( $serviceClass ) ) {
			throw ServiceNotFoundException::failedToLocate( $serviceName );
		}

		$service = new $serviceClass( $this, $serviceName );
		$this->services[$serviceName] = $service;

		return $this->services[$serviceName];
	}

	public function getServices(): array {
		$registeredServices = ServiceRegistry::getRegisteredServices();
		$serviceNames = array_keys( $registeredServices );
		foreach ( $serviceNames as $serviceName ) {
			$this->getService( $serviceName );
		}
		return $this->services;
	}

	public function process( HttpServiceRequest $request, HttpServiceResponse $response ) {
		$serviceName = $request->getParameter( 'serviceName' );
		$methodName = $request->getParameter( 'methodName' );

		$params = $request->getParameterValues( 'parameters' );
		$service = $this->getService( $serviceName );
		return $service->invoke( $methodName, $params );
	}
}