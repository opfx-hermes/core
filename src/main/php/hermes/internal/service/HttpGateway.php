<?php

namespace hermes\internal\service;

use stdClass;
use Object;
use opfx\net\http\HTTPRequest;

class HttpGateway extends Object {

	/**
	 *
	 * @var Router
	 */
	private $router;

	public function __construct() {
		parent::__construct();
		$this->router = new Router( $this );
	}

	public function getRouter(): Router {
		return $this->router;
	}

	public function service() {
		$request = HttpServiceRequest::create();
	}

	public function _service() {
		$contentType = null;
		if ( isset( $_REQUEST['contentType'] ) ) {
			$contentType = $_REQUEST['contentType'];
		} elseif ( isset( $_SERVER['CONTENT_TYPE'] ) ) {
			$contentType = $_SERVER['CONTENT_TYPE'];
		}
		$requestUri = explode( '/', $_SERVER['REQUEST_URI'] );
		$serviceName = $requestUri[3];
		$serviceMethod = $requestUri[4];

		$rawInput = file_get_contents( 'php://input' );

		$processor = new JSONRequestProcessor( $this );

		$request = $processor->deserialize( $_REQUEST, $rawInput );
		$request->setTargetServiceName( $serviceName );
// 		$request->setTargetMethodName( $serviceMethod );

		$response = $processor->process( $request );
	}
}
