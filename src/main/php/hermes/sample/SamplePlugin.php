<?php

namespace hermes\sample;

use hermes\AbstractPlugin;
use hermes\IService;

class SamplePlugin extends AbstractPlugin /* implements IService*/
{

	public function __construct() {
		parent::__construct();
	}
}