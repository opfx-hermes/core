<?php

namespace hermes;

use JsonSerializable;
use hermes\util\Archive;

interface IMarshallable extends JsonSerializable {

	public function marshall( Archive $archive ): void;
}
?>