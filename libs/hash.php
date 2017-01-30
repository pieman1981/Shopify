<?php 

	class Hash {
		//algo = sha256
		public static function create($data, $algo = 'md5',  $salt = HASH_KEY) {
		
			$context = hash_init($algo, HASH_HMAC, $salt);
			hash_update($context, $data);
			return hash_final($context);
			
		}
		
	}

?>