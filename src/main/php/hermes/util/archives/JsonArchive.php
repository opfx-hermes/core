<?php

namespace hermes\util\archives;

use hermes\util\Archive;

class JsonArchive extends Archive implements \JsonSerializable {

	public function __construct( bool $storing = false, $data = null ) {
		parent::__construct( $storing, $data );
		if ( $data === null ) {
			$this->data = new \stdClass();
		}
	}

	public function __get( $attribute ) {
		return $this->data->$attribute;
	}

	public function __set( $attribute, $value ) {
		$this->write( $attribute, $value );
	}

	public function write( $name, $data ): void {
		if ( is_object( $data ) && $data instanceof \JsonSerializable ) {
			$data = $data->jsonSerialize();
		}
		$this->data->$name = $data;
	}

	public function read( $data ): void {
	}

	public function jsonSerialize() {
		return $this->data;
	}

	public function __toString() {
		return json_encode( $this->data );
	}
}