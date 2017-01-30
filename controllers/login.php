<?php
	
	class Login extends Controller {
	
		function __construct() {
		
			parent::__construct();
		
		}
		
		public function index($message = null) {
			if ($message) {
				$this->view->message = $message;
			}
			
			$this->view->footer = 'footer.php';
			$this->view->render('login/index');
			
		}
		
		
		public function run() {
			//todo validation
			$login = $_POST['login'];
			$password = Hash::create( $_POST['password'] );
			$this->model->run($login, $password);
		}
		
		
	}

?>