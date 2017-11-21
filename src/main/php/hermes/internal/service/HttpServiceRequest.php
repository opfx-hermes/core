<?php

namespace hermes\internal\service;

use opfx\net\URL;
use opfx\net\http\HTTPRequest;
use hermes\service\IServiceRequest;

class HttpServiceRequest extends HTTPRequest implements IServiceRequest {
	protected $params;

	static public function create(): HttpServiceRequest {
		$request = new self();

		$strUrl = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}{$_SERVER['REQUEST_URI']}";
		$url = new URL( $strUrl );
		$request->setUrl( $url );
		$request->setContentType( self::getContentType() );
		if ( isset( $_REQUEST['json'] ) ) {
			$request->setBody( $_REQUEST['json'] );
		}

		if ( $request->getContentType() == 'application/json' ) {
			$json = $request->getBody();
			$data = json_decode( $json );
			$properties = get_object_vars( $data );
			foreach ( $properties as $name->$value ) {
				$request->setParameter( $name, $value );
			}
		}
		return $request;
	}

	public function getParameter( string $name ): string {
		return $this->params[$name];
	}

	public function setParameter( string $name, string $value ): void {
		$this->params[$name] = $value;
	}

	private static function getRequestContentType(): string {
		$contentType = '';
		if ( isset( $_REQUEST['contentType'] ) ) {
			return $_REQUEST['contentType'];
		}
		if ( isset( $_SERVER['CONTENT_TYPE'] ) ) {
			return $_REQUEST['CONTENT_TYPE'];
		}
		return $contentType;
	}
}