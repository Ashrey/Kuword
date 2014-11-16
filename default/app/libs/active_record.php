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
\KBackend\Libs\Config::read('backend');
Config::read('databases');
\Kumbia\ActiveRecord\Db::setConfig(array('default' => Config::get('databases.development')));
class ActiveRecord extends \KBackend\Libs\ARecord{
    protected static $database = 'default';
}
