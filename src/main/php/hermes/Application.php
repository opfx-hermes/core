<?php

namespace hermes;

use Object;
use hermes\internal\service\Gateway;

class Application extends Object {

	static public function main(): void {
		$gateway = new Gateway();
		$gateway->service();
	}
}