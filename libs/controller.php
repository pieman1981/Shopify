<?php

	class Controller {

        protected $_controller_name = "";
        protected $_method_name = "";
        protected $_members_only = array('add','add_details','edit','archive','delete','save','all','new','submit','approve','live');
    
		function __construct() {

			$this->view = new View();
			if (isset($_POST)) {
				foreach ($_POST as $key => $value) {
                  if (is_array($value))
                  {
                    $_POST[$key] = serialize($value);
                  }
                  else
                  {
                    $_POST[$key] = trim($value);
                    $_POST[$key] = stripslashes($value);
                    $_POST[$key] = htmlspecialchars($value);
                  }
				}
			}
		}
    
		public function setMethodName($name) {
          $this->_method_name = $name;
          if (in_array($this->_method_name, $this->_members_only))
             Auth::handleLogin();
          
        }
    
        public function setControllerName($name) {
          $this->_controller_name = $name;
        }
    
        public function getURL() {
          return $this->_controller_name . '/' . ($this->_method_name ? $this->_method_name : 'index');
        }
    
        public function setMembersOnly($methods = array()) {
          $this->_members_only = $methods;
        }
    
		public function loadModel($name) {
			$path = 'models/' . $name . '_model.php';
			if ( file_exists( $path ) ) {
				require_once $path;
				$modelName = ucfirst($name) . '_Model';
				$this->model = new $modelName();
			}
			
		}

	}



?>