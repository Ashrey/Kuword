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
require_once CORE_PATH . 'kumbia/controller.php';

class AdminController extends Controller {

	final protected function initialize(){
		Load::lib('i18n');
		View::template('private');
	}

	final protected function finalize(){
		$this->title = Conf::get('title');
		$this->desc  = Conf::get('desc');
	}
}
