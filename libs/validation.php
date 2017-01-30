<?php

class Validation {

	public function __construct() {}
	
	public function minlength($data, $arg) {
		
		if (strlen($data) < $arg) {
			return "Your string must at least $arg characters long";
		}
		
	}
	
	public function maxlength($data, $arg) {
		
		if (strlen($data) > $arg) {
			return "Your string must be no more than $arg characters long";
		}
		
	}
	
	public function compare($data, $compare) {
		if ($data !== $compare) {
			return "Your passwords do not match. Please try again";
		}
	}
	
	public function digit($data) {
		
		if (!ctype_digit($data)) {
			return "You must enter a number";
		}
		
	}
	
	public function __call($name, $args) {
		throw new Exception("$name does not exist inside of: " . __CLASS__);
	}

}


?>