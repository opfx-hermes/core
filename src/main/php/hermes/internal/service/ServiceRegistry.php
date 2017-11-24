<?php

namespace hermes\internal\service;

class ServiceRegistry {
	private static $entries = [ ];

	static public function registerServiceClass( $serviceName, $serviceClass ): void {
		self::$entries[$serviceName] = $serviceClass;
	}

	static public function getServiceClass( $serviceName ): string {
		$result = '';
		if ( isset( self::$entries[$serviceName] ) ) {
			$result = self::$entries[$serviceName];
		}
		return $result;
	}

	static public function getRegisteredServices(): array {
		return self::$entries;
	}
}