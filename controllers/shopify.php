<?php
	
	class Shopify extends Controller {
    
		function __construct() {
      
            parent::__construct();
            Auth::handleLogin();
		
		}
		
		public function index() {
            $this->view->header = 'header_members.php';
            $this->view->footer = 'footer_members.php';
            
            $Shopify = new Shopify_Model();

            $this->view->products = $Shopify->get_products();


            $this->view->render('shopify/index');
		}
        
        public function add() {
            $this->view->header = 'header_members.php';
            $this->view->js = array('drag.js');
            $this->view->footer = 'footer_members.php';
            $this->view->render('shopify/add');
		}
        
        public function upload() {
            if (isset($_POST)):
                $Shopify = new Shopify_Model();
                
                //handle image uploads
                  $target_dir = UPLOADPATH . 'shopify/';

                  if (!empty($_FILES["file"]["name"])):
                    $status = $Shopify->upload($_FILES["file"], $target_dir);
                    echo $status[5];
                  endif;
            endif;
        }

        public function save() {
            
            if (isset($_POST)):

                //prepare post data
                $post['product']['id'] = 0;
                $post['product']['vendor'] = "Lait's Running Shop";
                $post['product']['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
                $post['product']['body_html'] = trim($_POST['body_html']);
                $post['product']['product_type'] = filter_var($_POST['product_type'], FILTER_SANITIZE_STRING);
                $post['product']['variants'][0]['price'] = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
                $post['product']['variants'][0]['sku'] = filter_var($_POST['sku'], FILTER_SANITIZE_STRING);  
 
                if (!empty($_POST['image'])):
                    $post['product']['images'][0]['src'] = URL . 'public/images/uploads/shopify/' . $_POST['image'];
                endif;

                $Shopify = new Shopify_Model();

                $result = $Shopify->create_product($post);
                
                if (isset($result['product']['id'])):
                    header('location:' . MEMBERSURL . 'shopify/index');
                    unset($_POST);
                endif;
            else:
                header('location:' . MEMBERSURL . 'shopify/index');
            endif;
            
        }
    }
    

?>