<?php

namespace hermes;

interface IContext {

	/**
	 *
	 * @return IService[]
	 */
	public function getServices(): array;

	public function getService( string $serviceName ): IService;
}