<?php
/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 **/

/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

function __(){
	return call_user_func_array(array('I18n', 'get'), func_get_args());
}
Load::models('posts');
class AppController extends  \KBackend\Libs\ScaffoldController {

	final protected function initialize()
	{
        
	}

	final protected function finalize()
	{
        $this->pagename  = Conf::get('title');
        $this->pagedesc   = Conf::get('desc');
        $this->style  = Conf::get('style').'/'.Conf::get('style');
        $this->footer = Posts::getSection('footer');
        $this->ptitle = isset($this->ptitle)?$this->ptitle:$this->title;

	}
}
