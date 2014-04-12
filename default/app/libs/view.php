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
	
    public static function getContent()
    {
		ob_start();
		parent::content();
        return ob_get_clean();
    }

	public static function render(/* Controller */ $controller){
		/* Guarda el controlador actual*/
		self::$_controller = $controller;
		
		/*Establece las configuraciones de haanga*/
		Haanga::configure(array(
			'template_dir' => APP_PATH.'views',
			'cache_dir' => APP_PATH.'temp/cache/haanga',
			'compiler' => array( /* opts for the tpl compiler */
				'strip_whitespace' => TRUE,
				'allow_exec'  => TRUE
			),
		));
		/*Captura el posible scaffold*/
		$scaffold = $controller->scaffold;
		
		/*extrae las variables del controllador*/
        $vars = get_object_vars($controller);
        self::$_content = NULL;

        // si se encuentra en produccion
        if (PRODUCTION) {
            // si se cachea vista
            if (self::$_cache['type'] == 'view') {
                // el contenido permanece nulo si no hay nada cacheado o la cache expiro
                self::$_content = Cache::driver()->get($_url, self::$_cache['group']);
            }
        }
        
         // carga la vista si no esta en produccion o se usa scaffold o no hay contenido cargado
        if (!PRODUCTION || $scaffold || !self::$_content) {
            // Carga el contenido del buffer de salida
            self::$_content = ob_get_clean();
            // Renderizar vista
            if ($view = self::$_view) {
                $file =  self::getPath();
                if (!is_file(APP_PATH ."views/$file") && $scaffold) {
                    $file = "_shared/scaffolds/$scaffold/$view.phtml";

                }
                self::$_content = Haanga::Load($file, $vars, true);
                // si esta en produccion y se cachea la vista
                if (PRODUCTION && self::$_cache['type'] == 'view') {
                    Cache::driver()->save(self::$_content, self::$_cache['time'], $_url, self::$_cache['group']);
                }
            }
        } else {
            ob_clean();
        }

		// Renderizar template
        if ($template = self::$_template) {
			self::$_content = Haanga::Load("_shared/templates/{$template}.phtml", $vars, true, array('content' => self::$_content ));
			 // si esta en produccion y se cachea template
            if (PRODUCTION && self::$_cache['type'] == 'template') {
                Cache::driver()->save(self::$_content, self::$_cache['time'], $_url, "kumbia.templates");
            }
        }
        echo self::$_content;
	}

}
