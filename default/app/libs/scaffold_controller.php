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
Load::lib('i18n');
View::template('private');
class ScaffoldController extends AppController {

    public $basetpl = 'admin.phtml';


	protected function after_filter(){
		$this->menu = Load::model('links')->getDashboardBar();
	}
}
