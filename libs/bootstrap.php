<?php

class Bootstrap {

	private $_url = null;
	private $_controller_name = null;
	private $_controller = null;
	private $_method = null;
  private $_is_members = false;
	
	function __construct() {
		$this->init();
	}
	
	private function init() {
	
		$this->getURL();
		$this->loadController();
		$this->loadControllerMethod();
	}
	
	private function getURL() {
	
		$url = (isset( $_GET['url']) ? $_GET['url'] : null );
		$url = rtrim(filter_var($url, FILTER_SANITIZE_URL),'/');
		$this->_url = explode( '/', $url );
    
    if ($this->_url[0] == 'members')
    {
      $this->_is_members = true;
      //any methods added here need also to be added to members controller
      if (empty($this->_url[1]) || $this->_url[1] == 'index'  || $this->_url[1] == 'logout')
      {
        //all good 0 = members and 1 = index
      }
      else
      {
        //handle auth here
         Auth::handleLogin();
         
        //remove members part url array
        unset($this->_url[0]);
        //ressign 0 index to array
        $this->_url = array_values($this->_url);
      }
    }
    
	}
	
	private function loadController() {
		if ( empty($this->_url[0]) ) {
			$this->_controller_name = 'index';
		} else {
			$this->_controller_name = $this->_url[0];
		}

		$file = 'controllers/' . strtolower($this->_controller_name) . '.php';
		if ( file_exists($file) ) {
        include $file;
		} else {
			$this->error();
			return false;
		}
    
    //echo $file;
 
    $controllerName = ucfirst($this->_controller_name);
		$this->_controller = new $controllerName;
		$this->_controller->loadModel( $this->_controller_name );
    $this->_controller->setControllerName($this->_controller_name);

	}
	
	private function loadControllerMethod() {
		
		if (isset( $this->_url[1] )) {
    
      
			$this->_method = $this->_url[1];
      $this->_controller->setMethodName($this->_method);
      
			if ( method_exists( $this->_controller, $this->_method ) ) {
			
				$length = count($this->_url);
				
				switch ($length) {
					case 5:
						if ( isset( $this->_url[4] ) ) { 
							$args1 = $this->_url[2];
							$args2 = $this->_url[3];
							$args3 = $this->_url[4];
							$this->_controller->{$this->_method}($args1, $args2, $args3);
						}
						return false;
						break;
					
					case 4:
						if ( isset( $this->_url[3] ) ) { 
							$args1 = $this->_url[2];
							$args2 = $this->_url[3];
							$this->_controller->{$this->_method}($args1, $args2);
						}
						return false;
						break;
						
					case 3:
						if ( isset( $this->_url[2] ) ) { 
							$args1 = $this->_url[2];
							$this->_controller->{$this->_method}($args1);
						}
						return false;
						break;
						
					case 2:
						$this->_controller->{$this->_method}();
						return false;
						break;
						
					default:
						$this->loadDefaultMethod();
						return false;
						break;
					
				}
			}
			else {
				$this->error();
				return false;
			}
		} else {
			$this->loadDefaultMethod();
		}
	
	}
	
	private function loadDefaultMethod() {
		
    $this->_controller->setMethodName('index');
    
    
		if ( method_exists( $this->_controller, 'index' ) ) {
			$this->_controller->index();
			return false;
		} else {
			$this->error();
			return false;
		}
	}
	
	private function error() {
	
		require 'controllers/error.php';
		$controller = new Error();
		$controller->index();
		exit;
		
	}
}
?>