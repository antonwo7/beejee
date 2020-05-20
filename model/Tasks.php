<?php
namespace Model;

class Tasks{
	public function get_tasks($args){
		global $db;
		
		$result = array();
		
		$query_string = "SELECT SQL_CALC_FOUND_ROWS * FROM tasks ORDER BY " . $db->prepare( $args['sort'] ) . " " . $db->prepare( $args['how'] ) . " LIMIT " . PER_PAGE . " OFFSET " . $db->prepare( $args['offset'] );
		$query = $db->query($query_string);

		while ($row = $query->fetch_assoc()){
			$result['list'][] = $row;
		}
		
		$query_string = 'SELECT FOUND_ROWS() as count;';
		$query = $db->query($query_string);
		$result['count'] = array_shift($query->fetch_assoc());

		$query->close();
		
		return $result;
	}
	
	public function add_task($args){
		global $db;
		
		$query_string = "INSERT INTO tasks ( Name, Email, Task ) VALUES ( '" . 
			$args['Name'] . "', '" . 
			$args['Email'] . "', '" .
			$args['Task'] . "') ";
		
		$db->query($query_string);
	}
	
	public function do_task($args){
		global $db;
		
		$query_string = "UPDATE tasks SET Status=1 WHERE id=" . $db->prepare( $args['id'] );
		$db->query($query_string);
	}
	
	public function get_task($args){
		global $db;
		
		$query_string = "SELECT task FROM tasks WHERE id='" . $db->prepare( $args['id'] ) . "'";
		$query = $db->query($query_string);
		$task = array_shift($query->fetch_assoc());
		$query->close();
		
		return $task;
	}
	
	public function save_task($args){
		global $db;
		
		$query_string = "UPDATE tasks SET Task='" . $db->prepare( $args['task'] ) . "' WHERE id='" . $db->prepare( $args['id'] ) . "'";
		$query = $db->query($query_string);
	}
}

?>