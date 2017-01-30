<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

	define( 'URL', ($_SERVER['HTTP_HOST'] == 'localhost' ? 'http://localhost:1234/ShopifyTest/' : 'http://simonlait.info/examples/ShopifyTest/' ) );
    define( 'MEMBERSURL', ($_SERVER['HTTP_HOST'] == 'localhost' ? 'http://localhost:1234/ShopifyTest/' : 'http://simonlait.info/examples/ShopifyTest/members/' ) );
	define( 'DB_HOST', ($_SERVER['HTTP_HOST'] == 'localhost' ? 'localhost' : 'localhost') );
	
	define( 'HASH_KEY', 'shopifytest' );
	define( 'NOW', date('Y-m-d H:i:s', time()) );
	define( 'FROMEMAIL', 'noreply@runningclub.com' );
	define( 'UPLOADPATH', "public/images/uploads/");
	define( 'EXPORTPATH', "public/exports/");
    define( 'MAXUPLOADSIZE', 900000);
	
	function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

	function mysql_prep($value)
	{
		if (get_magic_quotes_gpc())
			$value = stripslashes($value);
		else
			$value = addslashes($value);
		return $value;
	} 
    
    function removeHost($host)
    {
        if (strpos($host, 'http:') !== 0)
        {
            $host =  str_replace('http:', '', $host);
        }
        elseif (strpos($host, 'https://') !== 0)
        {
            $host =  str_replace('https:', '', $host);
        }
        return $host;
    }
	
  function create_slug($string)
   {
		$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		return strtolower($slug);
	}
  
  function prr($data, $var_name=null, $return=false)
	{
		if ($return === false)
			print "\n<pre>\n" . ($var_name === null ? '' : "\${$var_name} = ") . print_r($data, true) . "\n</pre>\n";
		else
			return "\n<pre>\n" . ($var_name === null ? '' : "\${$var_name} = ") . print_r($data, true) . "\n</pre>\n";
	}
	
	function excerpt($string = '', $wordsreturned = 100)
	{
		/*  Returns the first $wordsreturned out of $string.  If string
		contains more words than $wordsreturned, the entire string
		is returned.
		*/
		$retval = $string;  //    Just in case of a problem
		$array = explode(" ", $string);
		if (count($array)<=$wordsreturned)
		/*  Already short enough, return the whole thing
			*/
		{
		$retval = $string;
		}
		else
		/*  Need to chop of some words
			*/
		{
		array_splice($array, $wordsreturned);
		$retval = implode(" ", $array)." ...";
		}
		return $retval;
	}
  function now()
  {
    $date=time();
    return date("Y-m-d H:i:s", ($date*1));
  }
  
  function pickerDB($date = null)
  {
    $date = strtotime(preg_replace("/\//", "-", $date));

		return date("Y-m-d H:i:s", ($date*1));
  }
  
  function dbPicker($mysql_date = null, $format = "d/m/Y")
	{
		if($mysql_date)
			$timestamp = strtotime($mysql_date);
		else
			$timestamp = time();

		return date($format,$timestamp);
	}
	
	function calulateRaceMinutes($data)
	{
		$mins = 0;
		if ($data['time_hours'])
		{
			$mins = $data['time_hours'] * 60;
		}
		
		if ($data['time_mins'])
		{
			$mins += $data['time_mins'];
		}
		
		return $mins;
	}
  
  function formatRaceTime($data)
  {
      if (!$data['time_hours'])
        $time = '00:';
      else
      {
        if ($data['time_hours'] < 10)
          $time = '0' . $data['time_hours'] . ':';
        else
          $time = $data['time_hours'] . ':';
      }
      
      if (!$data['time_mins'])
        $time .= '00:';
      else
      {
        if ($data['time_mins'] < 10)
          $time .= '0' . $data['time_mins'] . ':';
        else
          $time .= $data['time_mins'] . ':';
      }
      
      if (!$data['time_secs'])
        $time .= '00';
      else
      {
        if ($data['time_secs'] < 10)
          $time .= '0' . $data['time_secs'];
        else
          $time .= $data['time_secs'];
      }
      
      return ($time == '00:00:00' ? '-' : $time );
  }
	
  function formatAddress($data, $seperator = ', ')
  {
    $address = array();
    if (!empty($data['race_address_1']))
      $address[] = $data['race_address_1'];
    if (!empty($data['race_address_2']))
      $address[] = $data['race_address_2'];
    if (!empty($data['race_town']))
      $address[] = $data['race_town'];
    if (!empty($data['race_town']))
      $address[] = $data['race_county'];
    if (!empty($data['race_postcode']))
      $address[] = $data['race_postcode'];

    return implode($address,$seperator);
  }
	
	function getMonth($number)
	{
		$month = '';
		switch ($number)
		{
			case 1:
				$month = 'January';
				break;
			case 2:
				$month = 'February';
				break;
			case 3:
				$month = 'March';
				break;
			case 4:
				$month = 'April';
				break;
			case 5:
				$month = 'May';
				break;
			case 6:
				$month = 'June';
				break;
			case 7:
				$month = 'July';
				break;
			case 8:
				$month = 'August';
				break;
			case 9:
				$month = 'September';
				break;
			case 10:
				$month = 'October';
				break;
			case 11:
				$month = 'November';
				break;
			case 12:
				$month = 'December';
				break;
			
		}
		
		return $month;
	}
    
    function dayWeek($number)
    {
        switch ($number)
        {
            case 1:
               $day = 'Sunday';
               break; 
            case 2:
               $day = 'Monday';
               break; 
            case 3:
               $day = 'Tuesday';
               break; 
            case 4:
               $day = 'Wednesday';
               break; 
            case 5:
               $day = 'Thursday';
               break; 
            case 6:
               $day = 'Friday';
               break; 
            case 7:
               $day = 'Saturday';
               break; 
            default:
                $day = '-';    
        }
        
        return $day;
    }

?>