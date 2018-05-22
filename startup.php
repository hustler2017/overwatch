<?php
/**
 * Created by Averin Ilya.
 * Date: 22.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
error_reporting(E_ERROR);

include 'config.php';
if(MAINTANCE) die('...технические работы...');


include 'libs/phpquery/phpQuery-onefile.php';
include 'classes/Parser.php';
include 'classes/Weblancer.php';
include 'classes/Freelancehunt.php';
include 'classes/Freelansim.php';
include 'classes/Freelance.php';
include 'classes/Fl.php';
include 'functions.php';

$GLOBALS['current_time'] = time();
$GLOBALS['diag'] = [];