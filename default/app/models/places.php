<?php
class Places extends ActiveRecord {
	static function get($token){
		$a = self::first(
            array('where' =>  'token= :token '),
            array(':token'=>$token)
        );
		return isset($a->val)?$a->val:'';
	}
	
}
