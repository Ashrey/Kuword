<?php

/**
 * KumbiaPHP web & app Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://wiki.kumbiaphp.com/Licencia
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@kumbiaphp.com so we can send you a copy immediately.
 *
 * Flash Es la clase standard para enviar advertencias,
 * informacion y errores a la pantalla
 * 
 * @category   Kumbia
 * @package    Flash 
 * @copyright  Copyright (c) 2005-2009 Kumbia Team (http://www.kumbiaphp.com)
 * @license    http://wiki.kumbiaphp.com/Licencia     New BSD License
 */
class Scaffold {

    static function filter($model) {
        /* Carga los filtros actuales */
        $cond = Session::get('filter', strtolower($model->source));
        $param = array(
            /* Relaciones */
            'rel' => array(
                '=' => 'Igual',
                'LIKE' => 'Parecido',
                '<>' => 'Diferente',
                '<' => 'Menor',
                '>' => 'Mayor'
            ),
            'col' => array_diff($model->fields, $model->_at, $model->_in, $model->primary_key),
            'model' => $model,
            'cond' => $cond
        );
        ob_start();
        View::partial('backend/filter', false, $param);
        return ob_get_clean();
    }
    
    static function request($model){
        /* Se asegura de que siempre exista el filtro 
         * en el espacio de nombres */
        if (!Session::has('filter', $model)) {
            Session::set('filter', array(), $model);
        }

        /* Analiza las peticiones */
        if (Input::post('clear')) {/* Elimina todos los filtros */
            Session::set('filter', array(), $model);
            Flash::info('Filtros Borrados');
        } elseif (Input::post('add')) {/* Agrega un filtro */
            $cond = Session::get('filter', $model);
            $nuevo = Input::post('filter');
            $nuevo['val'] = empty($nuevo['val']) && $nuevo['val'] !== '0' ?
                    'NULL' : '"' . addslashes($nuevo['val']) . '"';
            $cond[uniqid()] = $nuevo;
            Session::set('filter', $cond, $model);
        } elseif (Input::post('remove')) {/* Remueve un filtro */
            $cond = Session::get('filter', $model);
            $key = Input::post('remove');
            unset($cond[$key]);
            Session::set('filter', $cond, $model);
        }
        /* Hace Redireccion en caso de peticones POST */
       if ($_SERVER['REQUEST_METHOD'] == 'POST')
            Router::redirect();
        $cond = Session::get('filter', $model);
        /* Crea los filtros */
        $filter = array('1 = 1 ');
        foreach ($cond as $val) {
            $filter[] = implode(' ', $val);
        }
        return implode(' AND ', $filter);  
    }
    
    static function update($model, $field){
        $model = is_string($model)? Load::model($model):$model;
        $model_name = Util::smallcase(get_class($model));
         $tipo = trim(preg_replace('/(\(.*\))/', '', $model->_data_type[$field])); //TODO: recoger tamaño y otros valores
         switch ($tipo) {
                case 'tinyint': case 'smallint': case 'mediumint':
                case 'integer': case 'int': case 'bigint':
                case 'float': case 'double': case 'precision':
                case 'real': case 'decimal': case 'numeric':
                case 'year': case 'day': case 'int unsigned': // Números

                    if (strripos($field, '_id', -3)) {
                        $model_name = substr($field, 0, -3);
                        $model_asoc= Load::model($model_name);
                        $pk = $model_asoc->primary_key[0];
                        $show = $model_asoc->non_primary[0];
                        
                        echo Form::dbSelect('filter[val]',$show, array($model_name, 'find', "columns: $pk,$show"), 'Seleccione');
                        break;
                    } else {
                        echo "<input  type=\"number\" name=\"filter[val]\">" . PHP_EOL;
                        break;
                    }

                case 'date': // Usar el js de datetime
                    echo "<input  type=\"date\" name=\"filter[val]\">" . PHP_EOL;
                    break;
                case 'datetime': case 'timestamp':
                    echo "<input  type=\"datetime\" name=\"filter[val]\">" . PHP_EOL;
                    break;

                case 'enum': case 'set': case 'bool':
                    // Intentar usar select y lo mismo para los field_id
                    echo "<input  class=\"select\" name=\"filter[val]\" type=\"text\">" . PHP_EOL;
                    break;

                case 'text': case 'mediumtext': case 'longtext':
                case 'blob': case 'mediumblob': case 'longblob': // Usar textarea
                    echo "<textarea  name=\"filter[val]\">{$model->$field}</textarea>" . PHP_EOL;
                    break;

                default: //text,tinytext,varchar, char,etc se comprobara su tamaño
                    echo "<input  type=\"text\" name=\"filter[val]\">" . PHP_EOL;
                //break;
            }
    }

}
