<?php
include 'startup.php';

if(isset($_POST['timestamp'])){
    define('ISAJAX',1);
	header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_HOST']);
}

try
{
	connect_database();

	update_data();

	$results = get_results();
	$layout = items_layout($results);

	if(defined('ISAJAX')){
		echo json_encode(['ok' => true, 'data' => $layout, 'time' => $GLOBALS['current_time'], 'diag' => $GLOBALS['diag']]);
		exit;
    }

    echo get_template('main', [ 'time' => $GLOBALS['current_time'], 'domain' => DOMAIN, 'items' => $layout ]);
}
catch (Exception $e) {
    if(defined('ISAJAX')){
	    echo json_encode(['ok' => false, 'message' => $e->getMessage()]);
    } else
        echo $e->getMessage();
}




