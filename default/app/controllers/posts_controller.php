<?php
Load::model('posts');
class PostsController extends ScaffoldController{
	public $_model = 'posts';
	
	function before_filter(){
		$this->ptitle = __('Posts');
	}
	
}
