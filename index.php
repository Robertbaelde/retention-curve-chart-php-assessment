<?php 
/*
Name: Retention curve PHP Assessment
URI: 
Description: 
Version: 1.0
Author: Giuseppe Maccario
Author URI: 
License: GPL2
*/

use \Services\Dispatcher;

define( 'RTT_ENV', 'dev' );

if( RTT_ENV == 'dev' )
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

function init()
{
    /* PSR-4: Autoloader - PHP-FIG */
    require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
    
    $dispatcher = new Dispatcher();
    $dispatcher->dispatch(__DIR__);
}

/*
 * GO!
 */
init();