<?php
    /* Singleton design */
	abstract class Database {
    
        protected static $pdo = null;
    
        public static function init() {
            if (!self::$pdo):
                self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER , DB_PASSWORD);
            endif;
            return self::$pdo;
		}
		
		/**
		* Close all live connections upon class deletion
		*/
		protected function __destruct()
		{
			self::$pdo = null;
		}
	
	}

?>