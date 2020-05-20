<?php
Class View{
	public static function viewOutput($template, $data){
		extract($data);
		include('view/templates/' . $template . '.php');	
	}
	
	public static function viewGet($template, $data){
		ob_start();
		self::viewOutput($template, $data);
		
		$out = ob_get_contents();
		ob_end_clean();
		
		return $out;
	}
	
}