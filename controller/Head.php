<?php
namespace Controller;

class Head extends \Controller{
	public function Index(){
		$data['login'] = \Loader::loadController('Login');
		return \View::viewGet('Head', $data);
	}
}