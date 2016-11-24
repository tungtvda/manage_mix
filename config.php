<?php

/**
 * @author vdbkpro
 * @copyright 2013
 */
define("SITE_NAME", "http://localhost/manage_mix");
define("DIR", dirname(__FILE__));
define('SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','manage_mix');
define('CACHE',false);
define('DATETIME_FORMAT',"y-m-d H:i:s");
define('PRIVATE_KEY','hoidinhnvbk');
session_start();
require_once DIR.'/common/minifi.output.php';
ob_start("minify_output");

