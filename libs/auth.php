<?php

	class Auth {
	
		public static function handleLogin() {
			
			Session::init();
			$logged = Session::get('loggedIn');
			if (!$logged) {
				Session::destroy();
				header('location: ' . URL . 'login' );
				exit;
			}		
			
		}
		
		public static function handleRole() {
		
			$role = Session::get('role');
			if ($role != 1) {
				header('location: ' . MEMBERSURL);
				exit;
			}		
			
		}
	
	}


?>