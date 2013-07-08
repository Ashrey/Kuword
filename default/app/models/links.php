<?php
class Links extends ActiveRecord {
	function initialize(){

	}
	
	function getNavBar(){
		return $this->find("conditions: link_type_id = 1");
	}
	
	function getDashboardBar(){
		return $this->find("conditions: link_type_id = 2");
	}
	
}
