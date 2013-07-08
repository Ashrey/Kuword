<?php
Load::model('links');
class LinksController extends ScaffoldController{
	public $_model = 'links';
	
	function before_filter(){
		$this->ptitle = __('Links');
	}
	
}
