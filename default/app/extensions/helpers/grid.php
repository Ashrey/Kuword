<?php
class Grid{
	protected  $s_caption = '';
	protected  $a_headers = array();
	protected  $a_data = array();
	protected  $a_ignore = array();
	protected  $s_id ='';
	protected  $s_action = '';
	protected  $a_request = array();

	public function __construct($a_array, $s_caption, $s_action = ''){
		$this->a_data = $a_array;
		$this->s_action  = $s_action;
		$this->s_caption = $s_caption;
	}

	public function setHeaders(){
		$this->a_headers = func_get_args();
	}

	public function setRequest(){
		$this->a_request = func_get_args();
	}

	public function setId($s_id, $b_ignore = true){
		if($b_ignore)
			$this->a_ignore[] = $s_id;
		$this->s_id = $s_id;
	}

	public function ignore(){
		$a_args = func_get_args();
		$this->a_ignore = array_merge($this->a_ignore,  $a_args);
	}

	public function show($s_view = 'dgrid'){
		View::partial('grid',false, get_object_vars($this));
	}

	static function get_version(){
		return 'Beta 0.1';
	}
}
?>
