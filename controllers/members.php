<?php
	
	class Members extends Controller {
    
		function __construct() {
      
            parent::__construct();
            Auth::handleLogin();
		
		}
		
		public function index() {
            $this->view->header = 'header_members.php';
            $this->view->footer = 'footer_members.php';


            $this->view->render('members/index');
		}
    
        public function logout() {
                Session::destroy();
                header('location: ' . URL . 'login/index');
            }
        
        }

?>