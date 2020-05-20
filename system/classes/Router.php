<?php
Class Router{
	
	public function __construct(){
		$controller_name = '\Controller\Common';
		$action_name = 'Index';
		
		$path_with_get = str_replace(SITE_URL, '', get_current_url());
		$path_parts = explode('?', $path_with_get);
		$path = $path_parts[0];
		
		$route_parts = explode('/', $path);
		
		if(!empty($route_parts[0]))	
			$controller_name = '\\Controller\\' . $route_parts[0];
		
		if(!empty($route_parts[1]))	
			$action_name = $route_parts[1];
		
		$controller = new $controller_name();
		
		if(method_exists($controller, $action_name)){
			if(!empty($route_parts[2]))	
				$controller->$action_name($route_parts[2]);
			else
				$controller->$action_name();
		}
		else{
			echo "Ошибка маршрутизации";
		}
	}

}