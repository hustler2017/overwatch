<?php

include 'libs/phpquery/phpQuery-onefile.php';
include 'include/weblancer.php';
include 'include/fl.php';
include 'include/freelansim.php';
include 'include/freelancehunt.php';
include 'include/freelanceru.php';

//header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Origin: http://overwatch.onequiz.ru");

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
        case 'freelanceru':
		    $html = file_get_contents($url);
		    $items = parseFreelanceru($html);
		    break;

    }

    echo json_encode(['ok' => true, 'list' => $items]);
    exit;
}
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
            background-color: #f2fdff;
        }
        ul{
            list-style: none;
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
        }
        .cols > *{
            flex-grow: 1;
            flex-basis: 100%;
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
            height: 30px;
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
<div style="
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
    $('.all > .content').overwatchWeblancer();
    $('.all > .content').overwatchFreelansim();
    $('.all > .content').overwatchFreelanceru();
    $('.all > .content').overwatchFreelancehunt();
</script>
</body>
</html>