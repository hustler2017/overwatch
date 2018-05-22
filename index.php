<?php
error_reporting(E_ERROR);


//   test
include 'config.php';
include 'libs/phpquery/phpQuery-onefile.php';
include 'classes/Parser.php';
include 'classes/Weblancer.php';
include 'classes/Freelancehunt.php';
include 'classes/Freelansim.php';
include 'classes/Freelance.php';
include 'classes/Fl.php';

if(isset($_POST['timestamp'])){
    define('ISAJAX',1);
	header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_HOST']);
}

$GLOBALS['current_time'] = time();
$GLOBALS['diag'] = [];

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

    page_layout($layout);

}
catch (Exception $e) {
    if(defined('ISAJAX')){
	    echo json_encode(['ok' => false, 'message' => $e->getMessage()]);
    } else
        echo $e->getMessage();
}


function items_layout($results)
{
	$layout = '';
	foreach($results as $item){
		$layout .= item_layout($item);
	}

	return $layout;
}

function item_layout($item)
{
    return "<li><div class=\"title\"><a href=\"{$item['href']}\" target=\"_blank\">{$item['title']}</a></div><div class=\"description\"></div><div class=\"time\"></div></li>";
}

function page_layout($layout)
{
?><!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-store" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            body{
                background-color: #fcfafb;
            }
            ul{
                list-style: none;
                padding-left: 0;
            }
            li{
                display: block;
                padding: 2px 6px;
                background-color: #cde4ff;
                transition: all 10s ease;
                color: black;
                border-radius: 9px;
                margin: 7px;
                -webkit-box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.25);
                -moz-box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.25);
                box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.25);
            }
            li a{
                text-decoration: none;
                color: black;
                font-weight:500;
                font-size:15px;
                font-family: "Segoe UI";
            }
            li.new{
                background-color: #28d6d6ab;
                transition: all 15s ease;
            }

            .cols{
                display: flex;
                justify-content: center;
            }
            .cols > *{
                flex-basis: 400px;
                border-radius: 10px;
                border: 1px solid #1876b8;
                margin: 10px;
                overflow: hidden;

                -webkit-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.7);
                -moz-box-shadow: 0px 0px 4px 1px rgba(0,0,0,0.7);
                box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.26);
            }
            .cols  .content{
                height: 800px;
                overflow-y: scroll;
                -webkit-box-shadow: inset 0px 1px 2px 1px rgba(0,0,0,0.25);
                -moz-box-shadow: inset 0px 1px 2px 1px rgba(0,0,0,0.25);
                box-shadow: inset 0px 1px 2px 1px rgba(0,0,0,0.25);
            }
            .head{
                color: white;
                background-color: #1876b8;
                text-align: center;
                padding-top: 4px;
            }
            .cols .head a{
                color: white;
                font-family: Segoe UI;
                font-size: 16px;
                text-transform: uppercase;
                font-weight: 600;
                text-shadow: 1px 1px 2px black, 0 0 1em #53bfd8;
            }

            .logo{
                display: block;
                background-image: url(favicon.png);
                background-repeat: no-repeat;
                height: 93px;
                width: 96px;
                margin: 0 auto;
                background-position: center;
                background-size: contain;
                position: relative;
                top: 16px;
            }

        </style>
    </head>
    <body>

    <iframe width="0" height="0" src="https://www.youtube.com/embed/9nlw2GZUBg8?list=RD9nlw2GZUBg8&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="" style="height: 0;">
    </iframe>

    <div style="width: 300px; height: 240px; margin: 0 auto; position: relative; z-index: 1000 ">
        <img src="http://www.neizvestniy-geniy.ru/images/works/photo/2012/05/615491_1.gif"
             style="display: block;height: auto;width: 100%">
    </div>


    <div style=" display: none;
    text-align:  center;
    font-family: Segoe UI;
    font-size: 35px;
    margin: 20px;
    color: #00ceff;
    text-shadow: 1px 1px 2px black, 0 0 1em #53bfd8; /* Параметры тени */
">
        <i class="logo"></i>
        OverWatch
    </div>

    <div class="cols">
        <div class="all">
            <div class="head">
                <a target="_blank" href="https://www.weblancer.net/">
                    weblancer.net
                </a>
                <a target="_blank" href="https://freelansim.ru/">
                    freelansim.ru
                </a>
                <a target="_blank" href="https://freelancehunt.com/">
                    freelancehunt.com
                </a>
                <a target="_blank" href="https://freelance.ru/">
                    freelance.ru
                </a>
                <a target="_blank" href="https://fl.ru/">
                    fl.ru
                </a>
            </div>
            <div class="content">
                <ul class="list">
                    <?= $layout ?>
                </ul>
            </div>
        </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
    <script>
        var server = "<?= DOMAIN ?>";
        var timestamp = <?= $GLOBALS['current_time'] ?>;
    </script>
    <script src="js/overwatch.js"></script>
    <script>

    </script>
    </body>
    </html>
<?php
}


function getExpiredDomains(){
	global $current_time;
	$update_delay = 60;
	$rows = _getallquery("SELECT * FROM tbl_overwatch_domains WHERE last_query < '".date("Y-m-d H:i:s",$current_time - $update_delay)."' ORDER BY last_query ASC ");
	return $rows;
}

function connect_database(){

    if($_SERVER['HTTP_HOST'] == "localhost"){
	    $mysqli = new mysqli(DB_HOST, DB_LOGIN, DB_PASS, DB_NAME);
    } else {
	    $mysqli = new mysqli("localhost", "u0437_u0437588", "5367ayasdBJASHDB**asd*33###", "u0437588_one");
    }


	$mysqli = new mysqli("localhost", "root", "2312", "overwatch");
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
			_query("INSERT INTO tbl_overwatch_results (domain_id, original_id, query_time, title, href) VALUES( {$domain['id']} , {$item['id']}, '".date("Y-m-d H:i:s",$current_time)."', '{$item['title']}', '{$item['href']}')");
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

	$timestamp = $current_time - 60;
	if(isset($_POST['timestamp'])){
		if(date($_POST['timestamp']) !== false){
			$timestamp = $_POST['timestamp'];
		}
	}

	$results = _getallquery("SELECT * FROM tbl_overwatch_results WHERE query_time > '".date("Y-m-d H:i:s",$timestamp)."'");

	return $results;
}




