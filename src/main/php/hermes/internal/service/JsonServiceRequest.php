<?php

namespace hermes\internal\service;

use \Object;
use hermes\service\IServiceRequest;
use hermes\service\IServiceResponse;

class JsonServiceRequest extends Object implements IServiceRequest {
	/**
	 *
	 * @var JsonServiceResponse
	 */
	private $response;
	/**
	 *
	 * @var string
	 */
	private $serviceName;

	/**
	 *
	 * @var string
	 */
	private $methodName;

	public function __construct() {
		parent::__construct();
	}

	public function setResponse( IServiceResponse $response ): void {
		$this->response = $response;
	}

	public function setTargetServiceName( string $serviceName ) {
	}

	public function getTargetServiceName(): string {
		return $this->serviceName;
	}

	public function getTargetMethodName(): string {
		return 'sample';
	}
}