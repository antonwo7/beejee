<?php

function get_current_url(){
	$result = '';
 
	if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
		$result .= 'https://';
	} else {
		$result .= 'http://';
	}
	
	$result .= $_SERVER['SERVER_NAME'];
	$result .= $_SERVER['REQUEST_URI'];
	
	return $result;
}

function redirect($url = SITE_URL){
	header('Location: ' . $url);
	exit;
}

function get_page_link(){
	$current_url = get_current_url();
	
	if(strpos($current_url, 'page=') !== false)
		return preg_replace('/ page=(\d{1,}) /xsi', 'page=', get_current_url());
	else if(strpos($current_url, '?') !== false)
		return $current_url . "&page=";
		
	return $current_url . "?page=";
}

function e($value){
	 return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function isAuth(){
	 if (isset($_SESSION["is_auth"])) { 
		return $_SESSION["is_auth"];
	}
	return false; 
}

