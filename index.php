<?php

include 'libs/phpquery/phpQuery-onefile.php';
include 'include/weblancer.php';
include 'include/fl.php';
include 'include/freelansim.php';
include 'include/freelancehunt.php';



if(isset($_POST['update'])){

    $function = $_POST['update'];
    $url = isset($_POST['url']) ? $_POST['url'] : '';
	$items = [];

    switch($function){
        case 'weblancer':
	        $html = file_get_contents($url);
	        $items = parseWeblancer($html);
            break;
	    case 'freelancehunt':
		    $html = file_get_contents($url);
		    $items = parseFreelancehunt($html);
		    break;
	    case 'freelansim':
		    $html = file_get_contents($url);
		    $items = parseFreelansim($html);
		    break;
	    case 'FL.ru':
		    ini_set("user_agent","Opera/9.80 (Windows NT 6.1; U; Edition Campaign 21; en-GB) Presto/2.7.62 Version/11.00");
		    $html = file_get_contents($url);
		    $items = parseFl($html);
		    break;
    }


	header("Access-Control-Allow-Origin: http://overwatch.onequiz.ru");

    echo json_encode(['ok' => true, 'list' => $items]);
    exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            background-color: #f2fdff;
        }
        ul{
            list-style: none;
        }
        li{
            display: block;
            border-radius: 3px;
            padding: 4px;
            background-color: #f99b3a;
            transition: all 10s ease;
            color: black;
            margin-bottom: 1px;
        }
        li a{
            text-decoration: none;
            color: black;
            font-weight:500;
            font-size:15px;
            font-family: "Segoe UI";
        }
        li.new{
            background-color: rgba(34, 156, 156, 0.21176470588235294);
            transition: all 15s ease;
        }
        .cols{
            display: flex;
        }
        .cols > *{
            flex-grow: 1;
            flex-basis: 100%;
            border-radius: 10px;
            border: 1px solid #1876b8;
            margin: 10px;
            overflow: hidden;
        }
        .cols  .content{
            height: 500px;
            overflow-y: scroll;
        }
        .head{
            height: 30px;
            color: white;
            background-color: #1876b8;
            text-align: center;
            padding-top: 4px;
        }
    </style>
</head>
<body>
<div style="
    text-align:  center;
    font-family: Segoe UI;
    font-size: 35px;
    margin: 20px;
    color: #00ceff;
    text-shadow: 1px 1px 2px black, 0 0 1em #53bfd8; /* Параметры тени */
">OverWatch</div>
<div class="cols">
    <div class="weblancer">
        <div class="head">
            WebLancer
        </div>
        <div class="content">
            <ul class="list">

            </ul>
        </div>
    </div>
    <div class="freelansim">
        <div class="head">
            freelansim
        </div>
        <div class="content">
            <ul class="list">

            </ul>
        </div>
    </div>
    <div class="freelancehunt">
        <div class="head">
            freelancehunt
        </div>
        <div class="content">
            <ul class="list">

            </ul>
        </div>
    </div>
    <div class="fl">
        <div class="head">
            FL.ru
        </div>
        <div class="content">
            <ul class="list">

            </ul>
        </div>
    </div>

</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
<script src="js/overwatch.js"></script>
<script>
    $('.weblancer > .content').overwatchWeblancer();
    $('.freelansim > .content').overwatchFreelansim();
    $('.fl > .content').overwatchFL();
    $('.freelancehunt > .content').overwatchFreelancehunt();
</script>
</body>
</html>