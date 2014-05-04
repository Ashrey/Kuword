<?php
Load::model('posts');
Load::model('post_type');
class PostsController extends ScaffoldController{
	public $_model = 'posts';
	
	function before_filter(){
		$this->ptitle = __('Posts');
	}

    function edit($id){
        $this->sel = PostType::all();
        parent::edit($id);
    }
	
}
