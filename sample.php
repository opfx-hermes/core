<?php
interface ISample {

	function getName();
}
class Sample implements ISample {
	private $name = 'name';

	public function getName() {
		return $this->name;
	}
}

$sample = new class() implements ISample {

	function __get( $property ) {
	}
};

$name = $sample->getName();