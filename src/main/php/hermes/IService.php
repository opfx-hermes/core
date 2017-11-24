<?php

namespace hermes;

interface IService {

	/**
	 * Returns the name of this service.
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Returns the context in which this service is being called.
	 *
	 * @return IContext
	 */
	public function getContext(): IContext;
}