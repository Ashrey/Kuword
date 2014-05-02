<?php
class Links extends ActiveRecord {
	function initialize(){

	}
	
	function getNavBar(){
		return self::all(array('where' => 'link_type_id = 1'));
	}
	
	function getDashboardBar(){
		return self::all(array('where' =>  'link_type_id = 2'));
	}
}
