<?php

namespace hermes\internal\service;

use opfx\Object;
use hermes\service\IServiceRequest;
use hermes\service\IServiceResponse;
use hermes;
use hermes\CoreException;

class JsonRequestProcessor extends Object {

	/**
	 *
	 * @var Gateway
	 */
	private $gateway;

	public function __construct( Gateway $gateway ) {
		parent::__construct();
		$this->gateway = $gateway;
	}

	public function deserialize( array $requestData, $rawPostData ): IServiceRequest {
		$json = '';
		if ( ! empty( $rawPostData ) ) {
			$json = $rawPostData;
		} elseif ( isset( $requestData['json'] ) ) {
			$json = $requestData['json'];
		}

		//FIXME throw exception if 'json' is empty
		$data = json_decode( $json );
		//TODO check for error

		$request = new JsonServiceRequest( $serviceName, $methodName, $params );

		return $request;
	}

	public function process( IServiceRequest $request ): IServiceResponse {
		$response = new JsonServiceResponse( $request );
		$router = $this->gateway->getRouter();
		try {
			$router->executeServiceCall( $request, $response );
		} catch ( CoreException $e ) {
			//TODO
			throw $e;
		}
		return $response;
	}
}