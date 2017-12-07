<?php

namespace hermes\util;

use hermes\util\archives\JsonArchive;

trait TMarshallable {

	public function marshall( Archive $archive ) {
	}

	public function jsonSerialize() {
		$archive = new JsonArchive( true );
		$this->marshall( $archive );
		return $archive;
	}
}