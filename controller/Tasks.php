<?php
namespace Controller;

class Tasks extends \Controller {
	private $messages = array();
	
	public function Index(){
		
		if( !empty( $_POST ) && ( !isset( $_POST['Login'] ) ) ){
			$args['Name'] = $_POST['Name'];
			$args['Email'] = $_POST['Email'];
			$args['Task'] = $_POST['Task'];
			
			if($this->Validate($args)){
				\Loader::loadModel('Tasks', 'add_task', $args);
				$this->messages['success'] = "Task successfully added!";
			}
		}
		
		$args = array();
		$args['offset'] = ( !empty( $_GET['page'] ) ? ( intval($_GET['page']) - 1 ) * PER_PAGE : 0 );
		$args['sort'] = ( !empty( $_GET['sort'] ) ? $_GET['sort'] : '1' );
		$args['how'] = ( !empty( $_GET['how'] ) ? $_GET['how'] : '' );
		
		$current_url = get_current_url();
		
		$data['messages'] = $this->messages;
		$data['page_link'] = get_page_link();
		$data['doit_link'] = SITE_URL . 'Tasks/doTask/';
		$data['how'] = ( !empty( $_GET['how'] ) ? $_GET['how'] : '' );
		$data['sort'] = ( !empty( $_GET['sort'] ) ? $_GET['sort'] : '' );
		$data['current_page'] = ( !empty( $_GET['page'] ) ? ( intval($_GET['page']) ) : 1 );
		$data['tasks'] = \Loader::loadModel('Tasks', 'get_tasks', $args);	

		
		$data['pages'] = $data['tasks']['count'] / PER_PAGE;
		if( !is_int($data['pages']) ) $data['pages']++;

		$data['add_task_action'] = '';
		$data['edit_task_action'] = \Loader::getUrl('Tasks', 'getTask');
		$data['save_task_action'] = \Loader::getUrl('Tasks', 'saveTask');
		
		
		return \View::viewGet('Tasks', $data);
	}
	
	public function doTask($id){
		$args['id'] = $id;
		
		\Loader::loadModel('Tasks', 'do_task', $args);
		redirect();
	}
	
	public function Validate(&$args){
		foreach($args as $key => $arg){
			$args[$key] = e($arg);
		}
		if(strlen($args['Name']) > 60) $this->messages['errors'][] = 'Field Name more than 60 characters';
		if(strlen($args['Email']) > 60) $this->messages['errors'][] = 'Field Email more than 60 characters';
		if(strlen($args['Task']) > 300) $this->messages['errors'][] = 'Field Task more than 300 characters';
		
		if(strlen($args['Name']) < 2) $this->messages['errors'][] = 'Field Name less than 2 characters';
		if(strlen($args['Task']) < 3) $this->messages['errors'][] = 'Field Task less than 3 characters';
		
		if(!preg_match('/ .+@.+\..+ /xsi', $args['Email'])) $this->messages['errors'][] = 'Field Email is not an email';
		
		if(!empty($this->messages['errors'])) 
			return false;
		return true;
	}
	
	public function getTask($id){
		session_start(); 
		
		$args['id'] = $id;
		if(isAuth())
			echo \Loader::loadModel('Tasks', 'get_task', $args);
		else
			echo 'User not logged!';
	}
	
	public function saveTask($id){
		session_start(); 
		$args['id'] = $id;
		$args['task'] = $_POST['task'];
		
		if(isAuth())
			\Loader::loadModel('Tasks', 'save_task', $args);
		else
			echo 'User not logged! Don`t you understand!?';
	}
}