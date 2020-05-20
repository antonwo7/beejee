<?php
Class Autoloader{
	public static function register(){
		
		spl_autoload_register(
			function($class){
				
				$directory = 'system/classes';
				$class_parts = explode('\\', $class);
				
				if(!empty($class_parts[1])){
					$directory = strtolower($class_parts[0]);
					$class = $class_parts[1];
				}
				
				$file = $directory . '/' . $class . '.php';
				if(file_exists($file)){
					require_once $file;
					return;
				}
				
				return false;
			}
		);
	}
}
?>