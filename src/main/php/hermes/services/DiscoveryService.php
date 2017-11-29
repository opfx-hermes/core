<?php

namespace hermes\services;

use stdClass;
use hermes\IService;

/**
 * @service DiscoveryService
 */
class DiscoveryService extends AbstractService {

	/**
	 * @api
	 *
	 * @return \stdClass[]
	 */
	public function discover() {
		$result = [ ];
		$context = $this->getContext();
		$services = $context->getServices();

		/** @var IService $service */
		foreach ( $services as $service ) {
			$serviceReflector = new \ReflectionObject( $service );
			$serviceComment = $this->formatComment( $serviceReflector->getDocComment() );
			$methodDescriptors = [ ];
			$methodReflectors = $serviceReflector->getMethods( \ReflectionMethod::IS_PUBLIC );
			/** @var \ReflectionMethod $methodReflector */
			foreach ( $methodReflectors as $methodReflector ) {
				$methodDescriptor = new stdClass();
				$methodDescriptor->name = $methodReflector->getName();
				$methodDescriptor->comment = $this->formatComment( $methodReflector->getDocComment() );
				if ( strpos( $methodDescriptor->comment, '@api' ) == false ) {
					continue;
				}
				$parameterDescriptors = [ ];
// 				$parameterReflectors = $methodReflector->getParameters();

// 				/** @var \ReflectionParameter $parameterReflector */
// 				foreach ( $parameterReflectors as $parameterReflector ) {
// 					$parameterName = $parameterReflector->getName();
// 					$parameterType = '';
// 					$parameterExample = '';
// 					$parameterDescriptors[] = $parameterDescriptor;
// 				}

				$methodDescriptor->parameters = $parameterDescriptors;
				//FIXME we should first try to get the docblock return annotation
				$methodDescriptor->return = $methodReflector->getReturnType();
				$methodDescriptors[$methodDescriptor->name] = $methodDescriptor;
			}
			$serviceDescriptor = new stdClass();
			$serviceDescriptor->name = $service->getName();
			$serviceDescriptor->methods = $methodDescriptors;
			$serviceDescriptor->comment = $serviceComment;
			$result[$serviceDescriptor->name] = $serviceDescriptor;
		}
		return $result;
	}

	private function formatComment( string $comment ): string {
		$result = str_replace( '    ', '', $comment );
		$result = str_replace( "\t", '', $result );
		$result = str_replace( '/**', '', $result );
		$result = str_replace( '*/', '', $result );
		$result = str_replace( '*', '', $result );
		return $result;
	}
}
