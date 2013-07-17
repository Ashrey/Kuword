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
 * Helper Tag
 *
 * Helper base para creacion de Tags
 *
 * @category   KumbiaPHP
 * @package    Helpers
 * @copyright  Copyright (c) 2005-2012 KumbiaPHP Team (http://www.kumbiaphp.com)
 * @license    http://wiki.kumbiaphp.com/Licencia     New BSD License
 */
class Tag
{
    /**
     * Hojas de estilo
     *
     * @var array
     **/
    protected static $_css = array();
    
    /**
     * Scripts
     *
     * @var array
     **/
    protected static $_js = array();
    
    
    /**
     * Convierte los argumentos de un metodo de parametros por nombre a un string con los atributos
     *
     * @param array $params argumentos a convertir
     * @return string
     */
    public static function getAttrs($params)
    {
        $data = '';
        foreach($params as $k => $v) {
            $data .= " $k=\"$v\"";
        }
        return $data;
    }
    
    /**
     * Crea un tag
     *
     * @param string $tag nombre de tag
     * @param string $content contenido interno
     * @param string $attrs atributos para el tag
     * @return string
     **/
    public static function create($tag, $content = NULL, $attrs = NULL) 
    {
        if(is_array($attrs)) {
            $attrs = self::getAttrs($attrs);
        }

        if(is_null($content)) {
            echo "<$tag $attrs />";
        }

        echo "<$tag $attrs>$content</$tag>";
    }
    
    /**
     * Incluye un archivo javascript
     *
     * @param string $src archivo javascript
     * @param boolean $cache indica si se usa cache de navegador
     */
    public static function js($src)
    {
		self::$_js[] = array('src' => $src);
    }
    
     /**
     * Incluye un parcial javascript
     *
     * @param string $src archivo javascript
     * @param boolean $cache indica si se usa cache de navegador
     */
    public static function partialjs($src, $cache = TRUE)
    {
		self::$_js[] = array('partial' => $src);
    }
    
    /**
     * Incluye un archivo de css
     *
     * @param string $src archivo css
     * @param string $media medio de la hoja de estilo
     */
    public static function css($src, $media = 'screen')
    {
        self::$_css[] = array('src' => $src, 'media' => $media);
    }
    
    /**
     * Obtiene el array de hojas de estilo
     *
     * @return array
     */
    public static function getCss()
    {
        return self::$_css;
    }
    
        /**
     * Obtiene el array de scripts
     *
     * @return array
     */
    public static function getJs()
    {
        return self::$_js;
    }
}