<?php

	class User_Model extends Model {
	
    var $_fields = array('name','details','image','sex','category_id','dob','login','password','address_1','address_2','town','county','postcode','role','link_id','paid','active','admin_notes','count');
    
    var $_table = "users";
    
		public function __construct() {

			parent::__construct();
			
		}
		
	  function checkUsername($login = '', $id = null)
		{
			if ($login):
				$conditions['login'] = $login;
				if ($id)
					$conditions['id'] = array('!=', $id);
					
				$users = $this->find(array('fields' => array('id'),'conditions' => $conditions), true);
				if (is_array($users) && count($users) > 0)
					return false;
					
			endif;
			
			return true;
		}
        
    function reset()
    {
        $this->pdo_query("UPDATE `users` SET `paid` = 0 WHERE `paid` = 1");
    }
    
    function save($data = array())
    {
			//unique username
      if (isset($data['login']) && strlen(trim($data['login'])) > 1):
				$result = $this->checkUsername($data['login'], (isset($data['id']) ? $data['id'] : null));
				if (!$result):
						Session::set('error','Your email has been used by another user, please try again.');
						return false;
				endif;
			endif;
			
      if (isset($data['password']) && strlen(trim($data['password'])) > 1)
        $data['password'] = Hash::create($data['password']);
      else
        unset($data['password']);
        
      if (isset($data['name']) && strlen(trim($data['name'])) > 1)
        $data['link_id'] = create_slug($data['name']);
     
		  if (empty($data['paid']))
				$data['paid'] = 0;
				
			if (empty($data['active']))
				$data['active'] = 0;
				
     //handle image uploads
      $target_dir = UPLOADPATH . 'users/';

      if (!empty($_FILES["image"]["name"])):
        $status = $this->upload($_FILES["image"], $target_dir);
        if (key($status) != 5)
        {
          Session::set('error',$status[key($status)]);
          return false;
        }
        else
        {
          Session::remove('error');
          $data['image'] = $status[5];
          return parent::save($data);   
        }
      else:
        Session::remove('error');
        return parent::save($data);   
      endif;

    }
		
	}

?>