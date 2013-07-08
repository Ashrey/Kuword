<?php
class BlogUtil{
	/**
	 * Write a record in the log
	 */
	static function log(){
		$fp = fopen(PATH_APP."log.log", 'a');
		$a_var = func_get_args();
		fwrite($fp, '['.date('d/m/Y h:i:s') . ']');
		foreach ($a_var as $s_value) {
			fwrite($fp, "\t$s_value \n");
		}
		fclose($fp);
	}

	static function encodeURL($s_str){
		$a_char = array (
			'?' => '', '¿'=> '','!'=> '', '*'=> '', '&'=> 'and', '@'=> 'at',
			'#'=> '', '-'=> '', '(' => '', ')' => '', '['=> '',']'=> '',
			'{'=> '','}'=> '', '$'=> 'dollar', '%'=> '', '\''=> '','\\' => '',
			'/' => '', '"'=> '', ' ' => '-', '.' => 'dot',
			'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A',
			'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a',
			'Ç'=>'C',
			'ç'=>'c',
			'Ð'=>'Dj',
			'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E',
			'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
			'ƒ'=>'f',
			'Ì'=>'I', 'Í'=>'I', 'Î'=>'I','Ï'=>'I',
			'ì'=>'i', 'í'=>'i', 'î'=>'i','ï'=>'i',
			'Ñ'=>'N',
			'ñ'=>'n',
			'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O',
			'ð'=>'o',  'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o',
			'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U',
			'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü' => 'u',
			'Ý'=>'Y',
			'ý'=>'y', 'ý'=>'y', 'ÿ'=>'y',
			'Š'=>'S', 'š'=>'s',
			'Ž'=>'Z', 'ž'=>'z',
			'Þ'=>'B', 'ß'=>'Ss',
			'þ'=>'b',
		);
		return  strtr(strtolower($s_str), $a_char);
	}


	static function dateFormat($s_date, $i_until = 4){
		$i_time  = strtotime($s_date);
        $i_diff = time() - $i_time;
           $a_time = array(
				__('Now') => 1,
			   __('second(s)') => 60,
			   __('minute(s)') => 60,
			   __('hour(s)') => 24,
			   __('day(s)') => 7,
			   __('Week(s)') => 4.35,
			   __('Mount(s)') => 12,

			);
		   $i = 0;
			foreach($a_time as $s_name => $i_value){
				$i++;
				if($i_diff <= $i_value){
					$i_diff = round($i_diff);
					return "$i_diff $s_name";
                }
				$i_diff /= $i_value;
				if($i>$i_until)break;
			}
		return strftime(Conf::get('dateformat'),$i_time);
	}

	static function shortPost($s_str){
		$s_tmp = strip_tags($s_str);
		unset($s_str);
		$i_pos = isset($s_tmp[500]) ? strpos($s_tmp, ' ', 500) : strlen($s_tmp) -1;
		return substr($s_tmp, 0, $i_pos);
	}

	static function doGzip($Proccess, $level = 9){
		$Temp =  "\x1f\x8b\x08\x00\x00\x00\x00\x00";
		$Size = strlen($Proccess);
		$Crc = crc32($Proccess);
		$Contents = gzcompress($Proccess, $level);
		unset($Proccess);
		$Contents = substr($Contents, 0, strlen($Contents) - 4);
		return $Temp . $Contents . pack('V', $Crc). pack('V', $Size);
	}

	static function avatar($s_email, $s = 60, $d = 'wavatar', $r = 'g') {
		$s_hash = md5(strtolower(trim($s_email)));
		return "http://www.gravatar.com/avatar/$s_hash?s=$s&amp;d=$d&amp;r=$r";
	}

	static function niceComment($s_str){
		/*Subtituye eoticones*/
		$s_str = preg_replace('/(^|\s)(;\)|:\/|:\||:\(|:\)|:D|:P|o.O|<3|:@|:\'\(|:S|:\$|:#|:O)/ei',
		"'\\1'.Htag::image_to('smile/\\2.png')", $s_str);
		// enlaces imagenes
		$s_str = preg_replace('/(^|\s)@(\w+)/e',
		"'\\1@'.Htag::link_to('pages/reply/\\2', '\\2', array('rel'=>'nofollow'))", $s_str);
		$s_str = preg_replace('/(^|\s)#(\w+)/e',
		"'\\1#'.Htag::link_to('pages/reply/\\2', '\\2', array('rel'=>'nofollow'))", $s_str);
		return  nl2br($s_str);
	}
}
?>
