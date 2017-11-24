<?php

namespace hermes\internal\service;

use stdClass;
use Object;
use opfx\net\URL;

class HttpGateway extends Object {

	/**
	 *
	 * @var ServiceContext
	 */
	private $context;

	public function __construct() {
		parent::__construct();
		$this->context = new ServiceContext();
	}

	public function getRouter(): Router {
		return $this->router;
	}

	public function service() {
// 		$request = HttpServiceRequest::create();
		$request = new HttpServiceRequest();
		$this->parseRequest( $request );

		$response = new HttpServiceResponse();

		$response->setContentType( $request->getContentType() );

		$result = $this->context->process( $request, $response );

		$data = json_encode( $result );
		$response->appendBody( $data );

		$this->flushResponse( $response );
	}

	private function parseRequest( HttpServiceRequest $request ) {
		$strUrl = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}{$_SERVER['REQUEST_URI']}";
		$url = new URL( $strUrl );
		$request->setUrl( $url );
		$request->setMethod( $_SERVER['REQUEST_METHOD'] );
		$request->setContentType( self::getRequestContentType() );

		if ( $request->getContentType() == 'application/json' ) {
			if ( isset( $_REQUEST['json'] ) ) {
				$request->setBody( $_REQUEST['json'] );
			}

			$rawPostData = file_get_contents( 'php://input' );
			if ( isset( $GLOBALS['MOCK_RAWPOST'] ) ) {
				$rawPostData = $GLOBALS['MOCK_RAWPOST'];
			}
			if ( ! empty( $rawPostData ) ) {
				$data = json_decode( $rawPostData );
			}

			$properties = get_object_vars( $data );
			foreach ( $properties as $name => $value ) {
				if ( is_string( $value ) ) {
					$request->setParameter( $name, $value );
				} else {
					$request->setParameterValues( $name, $value );
				}
			}
		}
	}

	private function flushResponse( HttpServiceResponse $response ): void {
		$output = $response->getBody();
		echo $output;
	}

	private static function getRequestContentType(): string {
		$contentType = '';
		if ( isset( $_REQUEST['contentType'] ) ) {
			return $_REQUEST['contentType'];
		}
		if ( isset( $_SERVER['CONTENT_TYPE'] ) ) {
			return $_SERVER['CONTENT_TYPE'];
		}
		return $contentType;
	}
}
