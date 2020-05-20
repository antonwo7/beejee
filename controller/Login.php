<?php
namespace Controller;

class Login extends \Controller {
	
	public $messages = array();
	private $login = "admin";
	private $password = "123";
	
	public function Index(){
		session_start(); 
		
		if( isset( $_POST['Login'] ) ){
			$args['Login'] = $_POST["Login"];
			$args['Password'] = $_POST["Password"];
			
			if($this->Validate($args)){
				if( ( $args['Login'] == $this->login ) && ( $args['Password'] == $this->password ) ){
					$_SESSION["is_auth"] = true;
					$_SESSION["login"] = $args['Login']; 
					$this->messages['success'] = 'Successfully logged!';
				}
				else{
					$this->messages['errors'][] = 'Login or password incorrect!';
				}
				
			}
		}
		
		$data['messages'] = $this->messages;
		$data['action'] = '';
		$data['logout_action'] = \Loader::getUrl('Login', 'LogOut');
		return \View::viewGet('Login', $data);
	}
	
	public function LogOut(){
		session_start(); 
		session_unset();

		redirect();
	}
	
	public function Validate(&$args){
		foreach($args as $key => $arg){
			$args[$key] = e($arg);
		}
		
		if(strlen($args['Login']) < 2) $this->messages['errors'][] = 'Field Login less than 2 characters';
		if(strlen($args['Password']) < 2) $this->messages['errors'][] = 'Field Password less than 2 characters';
		
		if(!empty($this->messages['errors'])) 
			return false;
		return true;
	}
}