<?php
/**
 * Created by Averin Ilya.
 * Date: 03.07.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
define('OVERWATCH', true);

include 'load.php';

try{
	if(MAINTANCE === true)
		throw new Exception("технические работы");

	$result = run($config);
	echo get_template('main', [ 'items' => $result, 'message' => '' ]);
}
catch(Exception $e)
{
	echo get_template('main', [ 'items' => [], 'message' => $e->getMessage() ]);
}



