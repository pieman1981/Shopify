<?php
	
	class Model extends Sql {
		
    protected $_fields = array();
    protected $_table = "";
    
		function __construct() {
			parent::__construct();
		}
    
    public function find($data = array(), $limit = false, $limit_no = 1)
    {
        //dynamically build sql statement - fields
        if (isset($data['fields'])):
          foreach ($data['fields'] as $key => $val):
            if ($val != 'id'):
              if (!in_array($val, $this->_fields))
                unset($data['fields'][$key]);
            endif;
          endforeach;
          $fields = implode(',',$data['fields']);
        else:
          $fields = '*';
        endif;
        
        //where
        $replacements = $conditions_array = $or_conditions_array = array();
        
        if (isset($data['conditions'])):
					//allow for OR
					if (isset($data['conditions']['OR'])):
						$or_conditions = '(';
						foreach ($data['conditions']['OR'] as $key => $value):
							if (is_array($value)):
								$replacements[$key] = $value[1];
								$or_conditions_array[] = '`' . $key . '` ' . $value[0] . ' :' . $key; 
							else:
								$replacements[$key] = $value;
								$or_conditions_array[] = '`' . $key . '` = :' . $key; 
							endif;
						endforeach;
						$or_conditions .= implode(' OR ',$or_conditions_array);
						$or_conditions .= ')';
						unset($data['conditions']['OR']);
					endif;
					//allow for AND
          foreach ($data['conditions'] as $key => $value):
            if (is_array($value)):
							$replacements[$key] = $value[1];
              $conditions_array[] = '`' . $key . '` ' . $value[0] . ' :' . $key; 
            else:
              $replacements[$key] = $value;
              $conditions_array[] = '`' . $key . '` = :' . $key; 
            endif;
          endforeach;
          $conditions = implode(' AND ',$conditions_array);
					//Add OR if present
					if (isset($or_conditions)):
						$conditions .= ' AND ' . $or_conditions;
					endif;
        else:
           $conditions = "1";
        endif;
        
        //order
        $order = '';
        if (isset($data['order']))
          $order = ' ORDER BY ' . $data['order'];
        else if (isset($data['group']))
          $order = ' GROUP BY ' . $data['group'];
       
       //limit
       $limited = '';
       if ($limit)
       {
          $limited = " LIMIT $limit_no";
       }   
       
       $sth = $this->pdo_select( 'SELECT ' . $fields . ' FROM `' . $this->_table . '` WHERE ' . $conditions . $order . $limited, $replacements );
       
       if (is_array($sth) && count($sth) > 0):
        foreach ($sth as $key => $model):
          foreach ($model as $mkey => $value):
            $sth[$key][$mkey] = html_entity_decode($value);
          endforeach;
        endforeach;
       endif;
       return $sth;

    }
    
    public function save($data = array()) 
    {
      $update_data = array();
			$fields = $this->_fields;
			foreach ($fields as $val) :
				if (isset($data[$val])) : 
					$update_data[$val] = (is_array($val) ? serialize($val) : $data[$val]);
				endif;
			endforeach;
      
      if ( isset($data['id']) && $data['id'] != 0 ) 
      {
				if ($this->pdo_update($this->_table, $update_data, '`id` = ' . $data['id'])) {
					return $data['id'];
				}
				else {
					return false;
				}
			} 
      else 
      {
				$id = $this->pdo_insert($this->_table, $update_data);
        return $id;
			}
      
      return false;
		}
    
    public function delete($data) {
      $replacements = $conditions_array = array();
      
      if (isset($data['conditions'])):
        foreach ($data['conditions'] as $key => $value):
          $replacements[$key] = $value;
          $conditions_array[] = '`' . $key . '` = :' . $key; 
        endforeach;
        $conditions = implode(' AND ',$conditions_array);
        
        $sth = $this->pdo_delete('DELETE FROM `' . $this->_table . '` WHERE ' . $conditions, $replacements);
      endif;
    
    }
    
    public function upload($file, $path, $image_only = true)
    {
        $target_file = $path . basename($file["name"]);
        $message = '';
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
				if ($image_only):
					$check = getimagesize($file["tmp_name"]);
					if($check === false):
							//$message .= "File is not an image.";
							return array(1 => "File is not an image.");
					endif;
				endif;
    
    
        // Check file size
        if ($file["size"] > MAXUPLOADSIZE) 
        {
            //$message .= "Sorry, your file is too large. It must be less than 500000, yours is " . $_FILES["image"]["size"];
            return array(2 => "Sorry, your file is too large. It must be less than MAXUPLOADSIZE, yours is " . $file["size"]);
        }
        // Allow certain file formats
				if ($image_only):
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ):
							//$message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
							return array(3 => "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
					endif;
				else:
					if($imageFileType != "pdf"):
							return array(3 => "Sorry, only PDFs allowed.");
					endif;
				endif;
				
        
        $name = time() . rand(100,999) . '.' . $imageFileType;
        $full = $path . $name;

        if (move_uploaded_file($file["tmp_name"], $full )) 
        {
            //$message = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
           // $data['image'] = $_FILES["image"]["name"];
            return array(5 => $name);
        } 
        else 
        {
            //$message = "Sorry, there was an error uploading your file.";
            return array(4 => "Sorry, there was an error uploading your file.");
        }
      
    }
	
	}

?>