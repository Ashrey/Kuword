<?php
class LinkPlugin implements Plugin {

	static function execute(){
		$o_dblink = Load::model('links');
		View::partial('plugin/link', null,  array('link'  => $o_dblink->group(1)));
	}
	
	static function init(){
		Tcode::add('link', array('LinkPlugin','execute')); 	
	}
}
?>
