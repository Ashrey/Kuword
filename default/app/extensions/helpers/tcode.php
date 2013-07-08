<?php
class Tcode{
	static $a_tag = array();
	
	static function add($s_key, $m_val){
		if ( is_callable($m_val)){
			self::$a_tag[$s_key] = $m_val;
		}else{
			ABUtil::log("$s_key no load as TagCode");
		}
	}
	
	static  function remove($s_key){
		unset(self::$a_tag[$s_key]);
	}
	
	static  function exec($s_str){
		return preg_replace_callback('#\[%(\w+)([\w"=\h]*)(\v+(.+)\v?)?%\]#um',
			'Tcode::query', $s_str);
	}
	
	static  function query($a_attr){
		$s_tag = $a_attr[1];
		//If no defined code return the same
		if(!isset(self::$a_tag[$s_tag]))
			return $a_attr[0];
		//Content of code
		$content = isset($a_attr[3])? $a_attr[3]:'';
		$a_param = array();
		//Parse param
		$patro = 
		preg_match_all('/(\w+)\s*=\s*"([^"]*)"(?:\s|$)/', $a_attr[2],
			$match, PREG_SET_ORDER);
		foreach ($match as $m)
			$a_param[strtolower($m[1])] = stripcslashes($m[2]);
		return call_user_func(self::$a_tag[$s_tag],$a_param, $content);
	}
	
	static function placehold($s_text, $a_place){
		$a_search  = array_map(array('ABTCode', 'addR'), array_keys($a_place));
		$a_replace = array_values($a_place);
		return str_replace ($a_search ,$a_replace , $s_text);
	}
	
	static function addR($s_str){
		return "%$s_str%";
	}
		
		
}
