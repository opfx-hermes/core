<?php

namespace hermes\internal\service;

use opfx\Object;
use hermes\IService;
use hermes\CoreException;
use hermes\IContext;
use opfx\data\Db;

class PhpUnitServiceContext extends Object implements IContext {
	private $services;

	public function __construct() {
		parent::__construct();
		$this->services = [ ];
		$this->init();
	}

	protected function init() {
// 		$odbcIniFile = "$cwd/etc/odbc.ini";
		Db::loadConfiguration( ODBC_INI_FILENAME );
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
// 		$data = $request->getParameterValues( 'data' );
		$session = $request->getSession();
		$target = $request->getTarget();
		$serviceName = $target->serviceName;
		$methodName = $target->methodName;
		$parameters = $target->parameters;

		$response->setSession( $session );
		try {
			$service = $this->getService( $serviceName );
			$result = $service->invoke( $methodName, $parameters );
			$response->setResult( $result );
		} catch ( CoreException $e ) {
			$response->setException( $e );
		}
	}

	public function process_old( HttpServiceRequest $request, HttpServiceResponse $response ) {
		$serviceName = $request->getParameter( 'serviceName' );
		$methodName = $request->getParameter( 'methodName' );

		$params = $request->getParameterValues( 'parameters' );
		$service = $this->getService( $serviceName );
		try {
			$result = $service->invoke( $methodName, $params );
		} catch ( CoreException $e ) {
		}
	}
}