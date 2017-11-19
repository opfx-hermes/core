<?php

namespace hermes\internal\service;

use opfx\net\URL;
use opfx\net\http\HTTPRequest;
use hermes\service\IServiceRequest;

class HttpServiceRequest extends HTTPRequest implements IServiceRequest {

	static public function create(): HttpServiceRequest {
		$request = new self();

		$strUrl = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}{$_SERVER['REQUEST_URI']}";
		$url = new URL( $strUrl );
		$request->setUrl( $url );

		return $request;
	}

	public function getInputStream() {
		//TODO
	}
}