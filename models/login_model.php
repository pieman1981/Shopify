<?php

	class Login_Model extends Model {
	
		public function __construct() {
		
			parent::__construct();

		}
		
		public function run($login = '', $password = '') {
            
          $User = new User_Model();
          $data = $User->find(array('fields' => array('id','name'), 'conditions' => array('login' => $login, 'password' => $password)));
                
                if (is_array($data) && count($data) > 0) {
                        Session::init();
                        Session::set('name', ($data[0]['name'] != '' ? $data[0]['name'] : 'Guest' ));
                        Session::set('id', $data[0]['id']);
                        Session::set('loggedIn',true);
                        header('location: ' . URL . 'members' );
                } else {
                    header('location: ' . URL . 'login/index/2' );
                }
            }
		
		public function reset($login = '') {
			
			$User = new User_Model();
            $data = $User->find(array('fields' => array('id','name'), 'conditions' => array('login' => $login)),true);
			
			if (is_array($data) && count($data) > 0) {
				
				$data = $data[0];
                if ($data['active'] == 0):
                    header('location: ' . URL . 'login/forgotten_password/4' );
                    die;
                endif;
                
				$password = randomPassword();
				
				$save_user = $User->save(array('active' => 1, 'paid' => $data['paid'], 'password' => $password, 'id' => $data['id']));
				//password not saved for some reason
				if (!$save_user):
					header('location: ' . URL . 'login/forgotten_password/3' );
				endif;
				
				$body  = file_get_contents('./views/email-templates/HTML-ForgottenPassword.html');

				$body = str_replace('<!--FULLNAME-->', $data['name'], $body);
				$body = str_replace('<!--EMAIL-->', $data['login'], $body);
				$body = str_replace('<!--PASSWORD-->', $password, $body);
				$body = str_replace('<!--LOGINLINK-->', '<a href="' . URL . 'login/index">' . URL . 'login/index</a>', $body);

				//send notification email
				$t_oEmail = new PHPMailer();
				//$t_oEmail->IsSMTP(); // telling the class to use SMTP
				$t_oEmail->Host  = 'localhost'; // SMTP server
				$t_oEmail->SMTPDebug  = 0; // enables SMTP debug information (for testing)
				$t_oEmail->SMTPAuth   = false; // enable SMTP authentication
				$t_oEmail->Port       = 25;   

				$t_oEmail->SetFrom('noreply@bearbrookrunningclub.com', 'Bearbrook Running Club Website');

				$t_oEmail->AddAddress($data['login'],  $data['name']);
				
				$t_oEmail->Subject    = "Bearbrook Login Details";
				
				$t_oEmail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
				
				$t_oEmail->MsgHTML($body);

				
				if ( $t_oEmail->Send() )
				{
					header('location: ' . URL . 'login/index/1' );
				}
				else 
				{
					header('location: ' . URL . 'login/forgotten_password/3' );
				}
			} 
			else {
				header('location: ' . URL . 'login/forgotten_password/1' );
			}
		}
		
		
	}

?>