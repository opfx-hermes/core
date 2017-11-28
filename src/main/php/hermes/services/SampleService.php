<?php

namespace hermes\services;

use hermes\entities\SampleEntity;

/**
 * This is a sample service
 * @service SampleService
 */
class SampleService extends AbstractService {

	/**
	 * @api
	 */
	public function getSampleEntities(): void {
	}

	/**
	 * @api
	 *
	 * @param SampleEntity $entity
	 */
	public function updateSampleEntity( SampleEntity $entity ): void {
	}
}
