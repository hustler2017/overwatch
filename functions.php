<?php
defined('OVERWATCH') or die();

function update_tasks(){

	//DB::set_update_forbidden(1);

	$parsers = load_parsers();
	$all_tasks = [];
	$current_time = time();
	foreach($parsers as $parser){
		/** @var $parser Parser */


		$last_time = strtotime($parser->last_update);
		$diff = $current_time - $last_time;

		if($diff > $parser->update_time ){

			$tasks = $parser->tick();
			$all_tasks = array_merge($tasks, $all_tasks);
			$date = date('Y-m-d H:i:s', $current_time);
			$parser->last_update = $date;
			$parser->save();
		}

	}
	DB::update_tasks($all_tasks);
	//DB::set_update_forbidden(0);
}

function load_parsers(){
	$parsers = [];

	$results = DB::loadParsers();
	foreach($results as $item_data){

		$classname = $item_data['classname'];
		$filename = __DIR__.'/classes/'.ucfirst($classname).'.php';

		if(file_exists($filename)){
			include_once $filename;
			$parser = new $classname($item_data);
			array_push($parsers, $parser);
		}
	}

	return $parsers;
}

function get_template($name, $options = [])
{
	extract($options);
	ob_start();
	include 'tpl'.DIRECTORY_SEPARATOR.$name.'.php';
	$content = ob_get_clean();
	return $content;
}


function run($config){

	DB::connect($config);

	if(DB::check_update_flag() === 0){
		update_tasks();
	}

	$current_time = time();
	$from_the_time =  $current_time - 1*60*60;
	$tasks = DB::check_tasks($from_the_time);

	return $tasks;
}