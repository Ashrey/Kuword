<?php
use \KBackend\Libs\Paginator;
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

     protected function createPaginator(){
        $param = array(
            'fields' => 'Posts.id, title, modified_in, name',
            'join'   => 'JOIN PostType as r ON post_type_id = r.id',
            'order'  => 'Posts.id DESC'
        );
        return new Paginator($this->_model, $param);
    }
	
}
