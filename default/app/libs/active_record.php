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
Config::read('databases');

\Kumbia\ActiveRecord\Db::setConfig(Config::get('databases.development'));
class ActiveRecord extends \Kumbia\ActiveRecord\ActiveRecord{

}
