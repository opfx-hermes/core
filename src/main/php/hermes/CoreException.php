<?php

namespace hermes;

use Throwable;
use Exception;

class CoreException extends Exception {
	const SEVERITY_FATAL = 1;
	private $uuid;
	private $severity;

	public function __construct( string $message = '', int $code = null, Throwable $previous = null, int $severity = CoreException::SEVERITY_FATAL ) {
		parent::__construct( $message, $code, $previous );
		$this->uuid = uniqid();
	}
}