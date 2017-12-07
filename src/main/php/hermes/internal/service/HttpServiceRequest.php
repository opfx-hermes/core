<?php

namespace hermes\internal\service;

use opfx\net\http\HTTPRequest;
use hermes\util\Archive;

class HttpServiceRequest extends HTTPRequest {
	private $session;
	private $target;

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

	public function getSession() {
		return $this->session;
	}

	public function getTarget() {
		return $this->target;
	}

	public function marshall( Archive $archive ): void {
		if ( ! $archive->isStoring() ) {
			$this->session = $archive->session;
			$this->target = $archive->target;
		}
		//TODO UnsupportedOperation?
	}
}