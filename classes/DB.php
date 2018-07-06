<?php



class DB
{

	public static $db = null;
	public static $update_flag_set = false;

	/**
	 * Соединяется с базой данных
	 *
	 * @param $config  Массив данных для подключения.
	 *
	 * @throws \Exception
	 */
	public static function connect($config){
		static::$db = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);
		if (static::$db->connect_errno) {
			throw new Exception(__METHOD__." Не удалось подключиться к MySQL: " . static::$db->connect_error);
		}

		static::$db->set_charset('utf8');
	}

	/**
	 * Возвращает записи парсеров из БД
	 *
	 * @return mixed
	 */
	public static function loadParsers(){
		return static::get("SELECT * FROM tbl_overwatch_parsers");
	}

	/**
	 * Выполняет SQL запрос к БД
	 *
	 * @param $query
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public static function query($query){
		$result = static::$db->query($query);
		if($result === false){
			throw new Exception(__METHOD__." Ошибка: ".static::$db->error );
		}
		return $result;
	}

	/**
	 * Возвращает флаг update_forbidden из БД.
	 * Если значение равно 1, то обновление запрещено.
	 *
	 * @return int
	 */
	public static function check_update_flag(){
		$result = static::get_row("SELECT update_forbidden FROM tbl_overwatch_settings");
		return intval($result[0]);
	}

	/**
	 * Устанавливает значение update_forbidden в БД.
	 *
	 * @param $value
	 */
	public static function set_update_forbidden($value){
		$value = $value ? 1 : 0;
		static::query("UPDATE tbl_overwatch_settings SET update_forbidden = $value");
		static::$update_flag_set = (bool)$value;
	}

	/**
	 * Возвращает последние записи из БД , опубликованные после указанного времени
	 *
	 * @param int $timestamp   Время, с которого нужно искать записи.
	 *
	 * @return mixed
	 */
	public static function check_tasks($timestamp){

		$datetime = date('Y-m-d H:i:s', $timestamp);
		$results = static::get("SELECT * FROM tbl_overwatch_tasks WHERE published > '$datetime' ORDER BY published DESC");
		foreach($results as &$result){
			$result['published'] = strtotime($result['published']);
		}
		return $results;
	}


	/**
	 * Добавляет новые записи в общую таблицу.
	 *
	 * @param $tasks
	 */
	public static function update_tasks($tasks){

		if(empty($tasks)) return;

		$values = [];
		foreach($tasks as $task){
			array_push($values, "( '".implode("','",$task)."' )");
		}

		static::query( "INSERT INTO tbl_overwatch_temp (`domain`, url, title, published, founded, description) VALUES ".implode(',', $values) );
		static::query( "DELETE FROM tbl_overwatch_temp WHERE EXISTS (SELECT * FROM tbl_overwatch_tasks WHERE tbl_overwatch_tasks.url = tbl_overwatch_temp.url)" );
		static::query( "INSERT INTO tbl_overwatch_tasks (SELECT * FROM tbl_overwatch_temp)" );
		static::query( "TRUNCATE TABLE tbl_overwatch_temp" );
	}


	/**
	 * Возвращает все результаты SELECT запроса
	 *
	 * @param $query
	 *
	 * @return mixed
	 */
	function get($query){
		$result = static::query($query);
		return $result->fetch_all(MYSQLI_ASSOC);
	}


	/**
	 * Возвращает единственный результат запроса
	 *
	 * @param $query SQL запрос
	 *
	 * @return mixed
	 */
	function get_row($query){
		$result = static::query($query);
		return $result->fetch_row();
	}



	public static function deleteOldTasks()
	{
		$time = date("Y-m-d H:i:s", time() - 1*24*60*60 );
		$res = DB::query("DELETE FROM tbl_overwatch_tasks WHERE published < '$time'");
	}
}