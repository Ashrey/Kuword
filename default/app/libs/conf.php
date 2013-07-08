<?php
class Conf{
	/*store all config*/
	private static $a_config;
	const _DEFAULT = 'basic';

	/**
	 * Load config in the fa
	 * @param string $s_filename
	 * @param <type> $b_force
	 * @return <type>
	 */
	public static function load($s_filename= self::_DEFAULT, $b_force = false){
		$s_file = $s_filename;
		if(isset(self::$a_config[$s_file]) and !$b_force)return;
		$s_filename = APP_PATH."config/$s_filename.json";
		if(!is_file($s_filename))
			throw new Exception("The $s_filename not is a file");
		self::$a_config[$s_file] = json_decode(file_get_contents($s_filename));
		if(empty(self::$a_config[$s_file])) throw new Exception('File of configuration not Valid');
	}

	/**
	 * Get a value of config
	 * @param <type> $s_key
	 * @param <type> $s_file
	 * @return <type>
	 */
	public static function get($s_key, $s_file= self::_DEFAULT){
		/**
		 * Try load file
		 */
		if(!isset(self::$a_config[$s_file]))
			self::load ($s_file);
		return property_exists(self::$a_config[$s_file], $s_key) ?
				self::$a_config[$s_file]->$s_key : null;
	}

	/**
	 * Get all config file
	 * @param <type> $s_file
	 * @return <type>
	 */
	public static function getAll($s_file =  self::_DEFAULT){
		return self::$a_config[$s_file];
	}

	/**
	 * Set a config value
	 * @param <type> $s_key
	 * @param <type> $o_val
	 * @param <type> $s_file
	 */
	public static function set($s_key, $o_val, $s_file = self::_DEFAULT){
		self::$a_config[$s_file]->$s_key = $o_val;
	}


	public static function save($s_file = self::_DEFAULT){
		return file_put_contents(
			PATH_APP."config/$s_file.json",
			self::format(json_encode(self::$a_config[$s_file]))
		);
	}

	/**
	 * Convert json format to human reader text
	 * @param <type> $s_json
	 * @return string
	 */
	public static function format($s_json){
		$s_str	= '';
		$i_row = 0;
		$i_len	= strlen($s_json);
		$b_str = false;
		for($i = 0; $i < $i_len;$i++) {
			$s_char = $s_json[$i];
			/*Am I into string?*/
			if($s_char == '"')
				$b_str = !$b_str;
			if($b_str){
				$s_str .= $s_char;
				continue;
			}
			if($s_char == '}' || $s_char == ']' && !$b_str) {
				$s_str .= "\n";
				$i_row--;
				$s_str .= str_repeat ("\t", $i_row);
			}
			$s_str .= $s_char;
			if ($s_char == ',' || $s_char == '{' || $s_char == '[' && !$b_str) {
				$s_str .= "\n";
				if ($s_char != ',')
					$i_row ++;
				$s_str .= str_repeat ("\t", $i_row);
			}
		}
		return $s_str;
	}

	/**
	 * Conver string time to second
	 * @param <type> $s_time
	 * @return <type>
	 */
	static  function convertTime($s_time){
		if(is_numeric($s_time))
			return (int) $s_time;

		$a_time = array(
			's' => 1,
			'm' => 60,
			'h' => 3600,
			'd' => 86400
		);
		$s_time = trim(strtolower($s_time));
		$s_char = substr($s_time, -1);
		$i = substr($s_time,0, -1);
		return isset($a_time[$s_char]) ?
			$i*$a_time[$s_char]:
			$i;
	}
}
?>
