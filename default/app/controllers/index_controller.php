<?php
Load::models('posts', 'post_type');
class IndexController extends AppController{
	
	public function before_filter(){
		Load::model('places');
		Plugins::init();
		if (Input::isAjax()) {
		  View::template(NULL);
		}
	}
	public function index($i_page = 1){
		$i_page = (int)$i_page;
		$this->pag = Posts::all($i_page);
		$this->ptitle=__('Timeline - (Page %d)', $i_page);
		$this->url = null;
	}
	
	/**
	 * this action show the Post publish
	 * @param <type> $s_idpost
	 */
	public function post($slug){
		$o_post = Load::model('posts')->getPostBySlug($slug);
		if($o_post){
			$this->post = $o_post;
			$this->ptitle = $o_post->title;
			$p = new Parsedown();
			$this->text = $p->parse($o_post->content);
			$this->canonical = PUBLIC_PATH."post/{$o_post->strid}";
		}else{
			$this->_notFound();
		}
	}
	
	protected function _notFound(){
		$this->ptitle = __('Page not found');
		View::select('notfound');
	}

	
	protected function after_filter(){ 
		$this->menu   = Load::model('links')->getNavBar();
		$this->title  = Conf::get('title');
		$this->desc   = Conf::get('desc');
		$this->style  = Conf::get('style').'/'.Conf::get('style');
		$this->footer = Places::get('footer');
	}
}
