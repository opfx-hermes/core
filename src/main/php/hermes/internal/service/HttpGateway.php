<?php

namespace hermes\internal\service;

use Object;
use opfx\net\URL;
use hermes\util\archives\JsonArchive;

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

	public function service() {
// 		$request = HttpServiceRequest::create();
		$request = new HttpServiceRequest();
// 		$this->parseRequest( $request );

		$strUrl = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}{$_SERVER['REQUEST_URI']}";
		$url = new URL( $strUrl );
		$request->setUrl( $url );
		$request->setMethod( $_SERVER['REQUEST_METHOD'] );
		$request->setContentType( self::getRequestContentType() );
		//		if ( $request->getContentType() == 'application/json' ) {

		$rawPostData = file_get_contents( 'php://input' );
		if ( isset( $GLOBALS['MOCK_RAWPOST'] ) ) {
			$rawPostData = $GLOBALS['MOCK_RAWPOST'];
		}
		if ( ! empty( $rawPostData ) ) {

			$data = json_decode( $rawPostData );
		}
		$archive = new JsonArchive( false, $data );
		$request->marshall( $archive );

		$response = new HttpServiceResponse();

		$response->setContentType( $request->getContentType() );

		$result = $this->context->process( $request, $response );

		echo $response;
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
