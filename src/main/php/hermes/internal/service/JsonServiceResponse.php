<?php

namespace hermes\internal\service;

use \Object;
use hermes\service\IServiceRequest;
use hermes\service\IServiceResponse;

class JsonServiceResponse extends Object implements IServiceResponse {
	/**
	 *
	 * @var JsonServiceRequest
	 */
	private $request;

	public function __construct( IServiceRequest $request ) {
		parent::__construct();
		$this->request = $request;
		$request->setResponse( $this );
	}
}