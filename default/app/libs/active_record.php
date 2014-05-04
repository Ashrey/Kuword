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

\Kumbia\ActiveRecord\Db::setConfig(array('default' => Config::get('databases.development')));
\Kumbia\ActiveRecord\Db::setConfig(include KBACKEND_PATH.'/config/databases.php');
class ActiveRecord extends \Kumbia\ActiveRecord\ActiveRecord{

}
