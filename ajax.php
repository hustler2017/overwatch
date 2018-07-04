<?php
/**
 * Created by Averin Ilya.
 * Date: 03.07.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
define('OVERWATCH', true);
define('ISAJAX',1);
header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_HOST']);

include 'load.php';

try{
	if(MAINTANCE === true)
		throw new Exception("технические работы");

	$result = run($config);
	echo json_encode(array('error' => false, 'tasks' => $result));
}
catch(Exception $e)
{
	echo json_encode( array('error' => $e->getMessage() ));
}