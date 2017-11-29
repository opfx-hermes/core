<?php

namespace hermes\internal\service;

use opfx\net\http\HTTPRequest;

class HttpServiceRequest extends HTTPRequest {

	/**
	 *
	 * @param string $name
	 * @return string[]
	 */
	public function getParameterValues( string $name ): array {
		$result = [ ];
		if ( isset( $this->params[$name] ) ) {
			$result = $this->params[$name];
		}
		return $result;
	}
}