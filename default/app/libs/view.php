<?php
/**
 * Esta clase permite extender o modificar la clase ViewBase de Kumbiaphp.
 *
 * @category KumbiaPHP
 * @package View
 **/

// @see KumbiaView
require_once CORE_PATH . 'kumbia/kumbia_view.php';

class View extends KumbiaView {

		
	/**
	 * Reescribo para pasar los parametros
	 */
	public static function partial($partial, $time = false, $val = array()){
		$array = get_object_vars(self::get('controller'));
		parent::partial($partial, FALSE, array_merge($val, $array));
	}

}
