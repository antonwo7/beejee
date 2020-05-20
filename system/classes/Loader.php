<?php
Class Loader{
	public static function loadController($controllerName, $controllerMethod = 'Index'){
		$controllerFullName = '\\'. 'Controller' . '\\' . $controllerName;
		$controller = new $controllerFullName();
		return $controller->$controllerMethod();
	}

	public static function loadModel($modelName, $modelMethod = 'Index', $args){
		$modelFullName = '\\'. 'Model' . '\\' . $modelName;
		$model = new $modelFullName();
		
		return $model->$modelMethod($args);
	}
	
	public static function getUrl($controllerName, $methodName){
		return SITE_URL . $controllerName . '/' . $methodName;
	}
}
