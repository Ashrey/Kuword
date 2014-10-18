<?php
class BlogUtil{
	
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
	
	static function trucate($text, $lenght){
		$html = isset($text[$lenght]) ? substr($text,0,  strpos ($text, "\n", $lenght)) : $text;
		$parse = new Parser();
		return $parse->text($html);
	}
}

