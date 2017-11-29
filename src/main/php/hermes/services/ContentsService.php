<?php

namespace hermes\services;

/**
 * @service ContentsService
 */
class ContentsService extends AbstractService {

	/**
	 * @api
	 */
	public function getMenuItems() {
		$json = '[
        {
            "type": "item",
            "name": "Soccer",
            "id": 0
        },
        {
            "type": "item",
            "name": "Basketball",
            "id": 1
        },
        {
            "type": "item",
            "name": "Football",
            "id": 2
        },
        {
            "type": "item",
            "name": "Basketball",
            "id": 3
        }]';
		$result = json_decode( $json );
		return $result;
	}
}
