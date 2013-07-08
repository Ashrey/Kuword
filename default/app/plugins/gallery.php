<?php
class GalleryPlugin implements ABPlugin{

	static $is_get = false;

	static function init(){
		HTag::css('colorbox.css');
		ABTCode::add('gallery', array('GalleryPlugin','execute'));
	}

	static function execute($a_attr){
		/*Activate Js file*/
		if(!self::$is_get){
			HTag::js('jquery.colorbox.js');
			HTag::jsembed('$("a.pic").colorbox()');
			self::$is_get=true;
		}
		$s_galname = isset($a_attr['name'])?$a_attr['name']:'gallery';
		$s_dir = PATH_RESOURCE.$a_attr['dir'];
		$o_galdir = new ABDir($s_dir);
		$o_galdir->mkdir('min');
		$o_dir = $o_galdir->ls();

		foreach($o_dir as $o_file){

			if($o_file->isdir)continue;
			try{
				//if not exist thumbnail
				if(!file_exists("$s_dir/min/{$o_file->name}.gif")){
					$o_min = new ABImagen($o_file->path);
					$o_min->resize(150, 100, "$s_dir/min/{$o_file->name}.gif");
				}
				$s_title = isset($a_arg[$o_file->name])?$a_arg[$o_file->name]:'';
				$s_src =	URL_HOST."resource/{$a_attr['dir']}/$o_file->name";
				$s_min = URL_HOST."resource/{$a_attr['dir']}/min/$o_file->name.gif";
				echo "<a href=\"$s_src\" rel=\"$s_galname\" class=\"pic\" title=\"$s_title\"><img src=\"$s_min\" alt=\"$s_title\"/></a>";
			}catch (Exception $E){}
		}
	}
}
?>