<?php
/**
 * Created by Averin Ilya.
 * Date: 22.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */


function getExpiredDomains(){
	global $current_time;
	$update_delay = 60;
	$rows = _getallquery("SELECT * FROM tbl_overwatch_domains WHERE last_query < '".date("Y-m-d H:i:s",$current_time - $update_delay)."' ORDER BY last_query ASC ");
	return $rows;
}

function connect_database(){

	$mysqli = new mysqli(DB_HOST, DB_LOGIN, DB_PASS, DB_NAME);
	if ($mysqli->connect_errno) {
		throw new Exception("Не удалось подключиться к MySQL: " . $mysqli->connect_error);
	}

	$mysqli->set_charset('utf8');
	$GLOBALS['mysqli'] = $mysqli;
}

function driver($domain)
{
	$classname = $domain['name'];
	$driver = new $classname($domain);
	return $driver;
}

function getOldestQuery($domain)
{
	$queryData = _getquery("SELECT * FROM tbl_overwatch_queries WHERE domain_id = {$domain['id']} ORDER BY query_time ASC LIMIT 1");
	return $queryData;
}

function saveItems($items, $domain)
{
	global $current_time, $mysqli;

	foreach($items as $item)
	{
		$row = _getquery("SELECT * FROM tbl_overwatch_results WHERE original_id = {$item['id']} AND domain_id={$domain['id']}");
		if(empty($row)){

			foreach($item as $key => $value)
			{
				$item[$key] = $mysqli->escape_string($item[$key]);
			}

			$time = $item['time'];
			if(date($time) == false)
			{
				$time = "null";
			}
			else
			{
				$time = "'".date("Y-m-d H:i:s",$time)."'";
			}

			$current = "'".date("Y-m-d H:i:s",$current_time)."'";

			_query("INSERT INTO tbl_overwatch_results (domain_id, original_id, query_time, title, href, original_time) VALUES( {$domain['id']} , {$item['id']}, $current, '{$item['title']}', '{$item['href']}', $time)");
		}
	}
}


function _query($query)
{
	global $mysqli;

	$result = $mysqli->query($query);
	if(!$result){
		throw new Exception("Ошибка: ".$mysqli->error );
	}
}

function _getquery($query)
{
	global $mysqli;

	$result = $mysqli->query($query);
	if(!$result){
		throw new Exception("Ошибка: ".$mysqli->error );
	}
	$row = $result->fetch_assoc();
	return $row;
}

function _getallquery($query)
{
	global $mysqli;

	$result = $mysqli->query($query);
	if(!$result){
		throw new Exception("Ошибка: ".$mysqli->error );
	}
	$row = $result->fetch_all(MYSQLI_ASSOC);
	return $row;
}

function update_data()
{
	global $current_time, $diag;

	$domains = getExpiredDomains();
	foreach($domains as $domain){
		$query = getOldestQuery($domain);
		$driver = driver($domain);
		$html = $driver->get($query);
		if(!empty($html)){
			$diag[$domain['name']] = 'ok';
		}
		$items = $driver->parse($html);
		saveItems($items, $domain);
		_query("UPDATE tbl_overwatch_domains SET last_query = '".date("Y-m-d H:i:s",$current_time)."' WHERE id = {$domain['id']}");
		_query("UPDATE tbl_overwatch_queries SET query_time = '".date("Y-m-d H:i:s",$current_time)."' WHERE id = {$query['id']}");
	}

}

function get_results()
{
	global $current_time;

	$timestamp = $current_time - 300;
	if(isset($_POST['timestamp'])){
		if(date($_POST['timestamp']) !== false){
			$timestamp = $_POST['timestamp'];
		}
	}

	$last_update = "'".date("Y-m-d H:i:s",$timestamp)."'";

	$results = _getallquery("SELECT * FROM tbl_overwatch_results WHERE  ( original_time IS NULL AND query_time > $last_update )  OR  ( original_time > $last_update)");

	return $results;
}

function get_template($name, $options = [])
{
	extract($options);
	ob_start();
	include 'tpl'.DIRECTORY_SEPARATOR.$name.'.php';
	$content = ob_get_clean();
	return $content;
}



function items_layout($results)
{
	$layout = '';
	foreach($results as $item){

		$timestamp = $item['original_time'] ? $item['original_time'] : $item['query_time'];
		$timestamp = strtotime($timestamp);
		$label = timePassed($timestamp);
		if($item['original_time'] === null) {
			$label = 'найдено ' . $label;
		}

		$layout .= get_template('item',['href' => $item['href'], 'title' => $item['title'], 'domain' => $item['domain_id'], 'time' => $timestamp, 'label' => $label ]);
	}

	return $layout;
}


function timePassed($timestamp)
{
	global $current_time;

	$current = new DateTime("@$current_time");
	$given = new DateTime("@$timestamp");
	$interval = $current->diff($given);
	if($interval->d){
		return $interval->d." дней назад";
	}
	if($interval->h){
		return $interval->h." часов назад";
	}
	if($interval->i){
		return $interval->i." минут назад";
	}
	return $interval->s." секунд назад";
}
