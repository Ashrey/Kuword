<?php
class SocialBarPlugin implements Plugin{

	static function init(){
		Tcode::add('socialbar', array('SocialBarPlugin','execute'));
	}
	
	static function execute($a_attr){
		View::partial('plugin/socialbar');
	}
}
?>
