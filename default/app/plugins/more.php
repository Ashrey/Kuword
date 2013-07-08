<?php
class MorePlugin implements Plugin {
	
	static function execute($param){
		$param = array_merge(array(
			'twitter' => '',
			'facebook' => ''
		), $param);
		return View::partial('plugin/more',false, $param);
	}
	
	static function init(){
		Tcode::add('more', 'MorePlugin::execute'); 	
	}
}
?>
