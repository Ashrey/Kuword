<?php
Load::models('posts');
class AppController extends \KBackend\Libs\ScaffoldController {

	final protected function initialize() {

	}

	final protected function finalize() {
		$this->pagename = Conf::get('title');
		$this->pagedesc = Conf::get('desc');
		$this->style = Conf::get('style') . '/' . Conf::get('style');
		$this->footer = Posts::getSection('footer');
		$this->ptitle = isset($this->ptitle) ? $this->ptitle : $this->title;
	}
}
