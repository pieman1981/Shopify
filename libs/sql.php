<?php
	class Sql {
    
   protected $connection = null;
    
   function __construct() {
        $this->connection = Database::init();
    }
    
    public function pdo_select($sql = '', $data = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $sth = $this->connection->prepare($sql);
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }
    
    public function pdo_insert($table = '', $data = array()) {
        
        ksort($data);
        $fieldnames = implode('`,`', array_keys($data));
        $filevalues = ':' . implode(', :', array_keys($data));

        $sth = $this->connection->prepare("INSERT INTO $table (`$fieldnames`) VALUES ($filevalues)");
        
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", ($value ? $value : ''));
        }
        $sth->execute();
        return $this->connection->lastInsertId();
    }
    
    public function pdo_update($table = '', $data = array(), $where = '') {
        
        $fielddetails  = '';
        ksort($data);
        foreach ($data as $key => $value) {
            $fielddetails  .= "`$key`=:$key,";
        }
        $fielddetails = rtrim($fielddetails,',');
        
        $sth = $this->connection->prepare("UPDATE $table SET $fielddetails WHERE $where");
        
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        //var_dump( $sth );
        if ($sth->execute())
            return true;
        else
            return false;
    }
    
    public function pdo_delete($sql = '',$data = array()) {
        
        $sth = $this->connection->prepare($sql);
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();	
    }
    
    public function pdo_query($sql = '', $return = false)
    {
      $sth = $this->connection->prepare($sql);
      $sth->execute();
			
			if ($return):
				 return $sth->fetchAll(PDO::FETCH_ASSOC);
			endif;
    }
		
		
	
	}

?>