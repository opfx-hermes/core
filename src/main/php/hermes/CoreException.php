<?php

namespace hermes;

use Throwable;
use Exception;
use hermes\util\TMarshallable;
use hermes\util\Archive;

class CoreException extends Exception implements IMarshallable {
	use TMarshallable;
	const SEVERITY_FATAL = 0;
	private $uuid;
	private $severity;

	public function __construct( string $message = '', int $code = 0, Throwable $previous = null, int $severity = CoreException::SEVERITY_FATAL ) {
		parent::__construct( $message, $code, $previous );
		$this->uuid = uniqid();
		$this->severity = $severity;
	}

	public function getSeverity(): int {
		return $this->severity;
	}

	public function marshall( Archive $archive ): void {
		if ( $archive->isStoring() ) {
			// FIXME : this should be getUUID();
			$archive->id = $this->uuid;
			$archive->code = $this->getCode();
			$archive->severity = $this->getSeverity();
			$archive->message = $this->getMessage();
		}
	}
}