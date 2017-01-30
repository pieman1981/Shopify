<?php
	
class View_Model extends Model {

    protected $_view_schema = "";

    function __construct() 
    {
        parent::__construct();
        $this->createView();
    }

    /**
    * Creates the Model's MySQL View
    */
    function createView()
    {
        if(preg_match("/SELECT/", $this->getSchema()))
        {
            $this->pdo_query("CREATE VIEW `" . $this->_table . "` AS " . $this->getSchema());
        }
    }

    /**
    * Gets MySQL View Schema SQL
    */
    function getSchema()
    {
        return $this->_view_schema;
    }

    /**
    * Gets MySQL View Schema SQL
    */
    function setSchema($sql)
    {
        $this->_view_schema = $sql;
    }
}
?>