<?php
namespace Controller;

class Common extends \Controller{
	public function Index(){
		$data['head'] = \Loader::loadController('Head');
		$data['tasks'] = \Loader::loadController('Tasks');
		
		\View::viewOutput('Common', $data);
	}
}