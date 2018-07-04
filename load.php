<?php
/**
 * Created by Averin Ilya.
 * Date: 22.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */

defined('OVERWATCH') or die();

include 'config.php';

error_reporting(E_ERROR);
date_default_timezone_set('UTC');

include 'libs/phpquery/phpQuery-onefile.php';
include 'classes/Parser.php';
include 'classes/Weblancer.php';
include 'classes/Freelancehunt.php';
include 'classes/Freelansim.php';
include 'classes/Freelance.php';
include 'classes/Fl.php';
include 'classes/DB.php';
include 'functions.php';