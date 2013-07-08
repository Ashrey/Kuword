<?php
class Places extends ActiveRecord {
	static function get($token){
		$model = new Places();
		$a =$model->find_first("token='$token'");
		return isset($a->val)?$a->val:'';
	}
	
}
