<?php

Class Shopify_Model extends Model {
    
    private $username = '9376ee7ad57003a423e150e00db37808';
    private $password = 'fdbcfe7ebbc67a41f47c42ac1efdd4bc';
    private $apiUrl = ''; 
    private $Curl = null;
    
    function __construct()
    {
        $this->Curl = new Curl();
    }
    
    private function buildURL($dest = 'products.json')
    {
        return 'https://' . $this->username . ':' . $this->password . '@laits-running-shop.myshopify.com/admin/' . $dest;
    }
    
    public function get_products()
    {
        $url = $this->buildURL();
        
        return $this->Curl->request($url);
    }
    
    public function create_product($data) 
    {
        $url = $this->buildURL();
        
        return $this->Curl->request($url, $data);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}





?>