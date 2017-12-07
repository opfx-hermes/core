<?php

namespace hermes\internal\service;

use opfx\net\http\HTTPResponse;
use hermes\IMarshallable;
use hermes\util\TMarshallable;
use hermes\util\Archive;
use hermes\CoreException;

class HttpServiceResponse extends HttpResponse implements IMarshallable {
	use TMarshallable;
	private $result;
	private $session;
	/**
	 *
	 * @var CoreException
	 */
	private $exception;

	public function setSession( $session ): void {
		$this->session = $session;
	}

	public function setResult( $result ): void {
		$this->result = $result;
	}

	public function setException( CoreException $exception ): void {
		$this->exception = $exception;
	}

	public function marshall( Archive $archive ): void {
		if ( $archive->isStoring() ) {
			$archive->session = $this->session;
			if ( $this->exception ) {
				$archive->result = null;
				$archive->error = $this->exception;
			} else {

				$archive->result = $this->result;
				$archive->error = null;
			}
		}
	}

	public function __toString() {
		return json_encode( $this );
	}
}