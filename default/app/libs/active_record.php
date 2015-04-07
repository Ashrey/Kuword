<?php
/**
 * ActiveRecord
 *
 * Esta clase es la clase padre de todos los modelos
 * de la aplicacion
 *
 * @category Kumbia
 * @package Db
 * @subpackage ActiveRecord
 */ 
use Kumbia\ActiveRecord\Db;
\Config::read('databases');
Db::setConfig(Config::get('databases'));

class ActiveRecord extends \KBackend\Libs\ARecord {
	protected static $database = 'default';

	public static function getTable() {
		$class = explode('\\', get_called_class());
		$name = strtolower(end($class));
		return "$name";
	}
}
