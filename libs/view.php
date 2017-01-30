<?php
	class View {
	
		function __construct() {
      
		}
		
		public function render($name) {
			require 'views/' . (isset($this->header) ? $this->header : 'header.php');
			require 'views/' . $name . '.php';
			require 'views/' . (isset($this->footer) ? $this->footer : 'footer.php');
		}
	
	}


?>