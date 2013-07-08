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
// Carga el active record
\Load::coreLib('kumbia_active_record');
class ActiveRecord extends \KumbiaActiveRecord implements \ArrayAccess {


    public function offsetSet($indice, $valor) {
        if (!is_null($indice)) {
            $this->{$indice} = $valor;
        }
    }

    public function offsetExists($indice) {
        return isset($this->{$indice});
    }

    public function offsetUnset($indice) {
        //no se pueden quitar atributos.
    }

    public function offsetGet($indice) {
        return $this->offsetExists($indice) ? $this->{$indice} : NULL;
    }
    
    public static function __callStatic($name, $args){
		$model = get_called_class();
		$obj = new $model();
		$name = substr($name, 1);
		return call_user_func_array(array($obj, $name), $args);
    }
    
    public function get_alias($key){
		 if ($key && array_key_exists($key, $this->alias)) {
            return $this->alias[$key];
        } else {
            return ucfirst(str_replace('_', ' ', $key));
        }
        return $this->alias;
	}

}
