<?php

namespace hermes\services;

use Object;
use hermes\IService;
use hermes\IContext;

abstract class AbstractService extends Object implements IService {
	private $context;

	/**
	 * The name of this service.
	 *
	 * @var string
	 */
	private $name;

	public function __construct( IContext $context, string $name ) {
		parent::__construct();
		$this->context = $context;
		$this->name = $name;
	}

	public function getContext(): IContext {
		return $this->context;
	}

	public function getName(): string {
		return $this->name;
	}

	final public function invoke( string $methodName, array $parameters = [] ) {
		return call_user_func_array( [ $this,$methodName ], $parameters );
	}
}
