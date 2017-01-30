<?php

class Form {

	private $_currentItem = null;
	private $_postData = array();
	private $_validator = null;
	private $_error = array();
	
	public function __construct() {
	
		$this->_validator = new Validation();
		
		
	}
	
	public function post($field) {
	
		$this->_postData[$field] = (isset($_POST[$field]) ? $_POST[$field] : null);
		$this->_currentItem = $field;
		return $this;
	
	}
	
	public function validate($type, $arg = null) {

		if ($arg == null) {
			$error = $this->_validator->{$type}($this->_postData[$this->_currentItem]);
		} else {
			if ($type == 'compare')
				$error = $this->_validator->{$type}($this->_postData[$this->_currentItem],$this->_postData[$arg]);
			else
				$error = $this->_validator->{$type}($this->_postData[$this->_currentItem],$arg);
		}
		if ($error) {
			$this->_error[$this->_currentItem] = $error;
		}
		
		return $this;
		
	}

	public function fetch( $fieldname = false ) {
		
		if ( $fieldname && isset($this->_postData[$fieldname]) && $this->_postData[$fieldname] != null  ) {
			return $this->_postData[$fieldname];
		} else {
			return $this->_postData;
		}
		
	}
	
	public function submit() {
		
		if (empty($this->_error)) {
			return true;
		} else {
			$str = '';
			foreach ($this->_error as $key => $value) {
				$str .= $key . ' => ' . $value . "\n";
			}
			throw new Exception($str);
		}
	}





}



?>