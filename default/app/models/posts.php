<?php
class Posts extends ActiveRecord {
	
	function initialize(){
		
	}
	
	function index($cond, $page){
		return $this->paginate("page: $page", 'per_page: 2','order: modified_in DESC', 
		'columns: posts.id, title, strid, modified_in, pt.name as post_type',
		'join: JOIN post_type pt ON post_type_id = pt.id'
		);
	}
	
	function all($page = 1){
		$ppage = 15;
		return $this->paginate('order: modified_in desc',
					"page: $page",
					"per_page: $ppage",
					'conditions: post_type_id = 1');		
	}
	
	function getPostBySlug($slug){
		return $this->find_first("conditions: post_type_id = 1 AND
		 strid = '$slug'");
	}
	
	function getPageBySlug($slug){
		return $this->find_first("conditions: type_id = 2 AND
		 strid = '$slug'");
	}
}
