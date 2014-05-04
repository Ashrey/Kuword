<?php
/**
 * Controlador para proteger los controladores que heredan
 * Para empezar a crear una convención de seguridad y módulos
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
class ScaffoldController extends  \KBackend\Libs\ScaffoldController {

    public $basetpl = 'admin.phtml';

	final protected function initialize(){
		Load::lib('i18n');
		View::template('private');
	}

	final protected function finalize(){
		$this->title = Conf::get('title');
		$this->desc  = Conf::get('desc');
		$this->menu = Load::model('links')->getDashboardBar();
	}
}
