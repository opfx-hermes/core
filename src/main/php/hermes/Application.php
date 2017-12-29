<?php

namespace hermes;

use opfx\Object;
use hermes\internal\service\HttpGateway;

class Application extends Object {

	static public function main(): void {
		$gateway = new HttpGateway();
		$gateway->service();
	}
}