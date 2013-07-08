<?php
interface Plugin{
	static function init();
}
	 
final class Plugins{
	 	
	private  static $a_enable = array();	
	private static  $a_available = array();
	 		
	static function load($s_name){
		$s_filename = APP_PATH."plugins/$s_name.php";
		require_once $s_filename;
		$s_name .='Plugin';
		call_user_func(array($s_name,'init'));
	}
	
	static function init(){
		self::$a_enable = Conf::get('addon');
		foreach(self::$a_enable as $s_str)
			self::load($s_str);
	}
}	 	
?>
