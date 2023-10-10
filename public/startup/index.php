<?php

require '../../startup/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$f3 = \Base::instance();
$f3->mset([
	'DEBUG' => 3,
	'CACHE' => '../../startup/var/tmp/',
	'AUTOLOAD' => '../../startup/app/',
	'INSTALL_FOLDER' => 'startup',
	'APPNAME' => 'startup',
	//'ABSOLUTE_PRIVATE_APP_PATH' => '/home/codinginthecold/startup/',
	//'UI' => '/home/codinginthecold/startup/',
	'ABSOLUTE_PRIVATE_APP_PATH' => '/opt/lampp/htdocs/f3-startup/startup/', //XAMPP path
	'UI' => '/opt/lampp/htdocs/f3-startup/startup/',
	'VERSION' => '0.3.2', // (major version . feature update . bugfix)
	'UPDATE_COMMIT_MSG' => 'Fixed lesson tutorial rendering literal html tags, and db install redirect.',
]);

$f3->set('DB', new DB\SQL('sqlite:'.$f3->ABSOLUTE_PRIVATE_APP_PATH.'data/'.$f3->APPNAME.'_db.sqlite'));

$f3->DB->exec([
	// SQLite config needs to be run on each connection
	"PRAGMA STRICT = ON;",
	"PRAGMA foreign_keys = ON;",
	"PRAGMA auto_vacuum = FULL;",
	"PRAGMA ignore_check_constraints = FALSE;",
]);

$f3->route('GET /landing','Controllers\Home->landing'); 

// User (also covers admin)

$f3->route('GET /logout','Controllers\User->logout'); 

// Admin

$f3->route('GET /admin','Controllers\Admin->index'); 
$f3->route('POST /login','Controllers\Admin->login'); 

// Home 

$f3->route('GET /','Controllers\Home->index');

/* $f3->route('GET /', function($f3) {	
	echo '<pre>Hello: '.__DIR__. ' - ';
	echo $f3->ABSOLUTE_PRIVATE_APP_PATH.'views/index.php';
	//print_r($f3->hive());
});   */


// Dev helper

/* 
$f3->route('GET /hive',
    function($f3) {	
		echo '<pre>';
    	print_r($f3->hive());
    }
);
*/

/*
$f3->route('GET /view',
    function($f3) {
		$f3->set('name','Template!');
		echo \Template::instance()->render('views/template.htm');
    }
);
*/

// Install (database)

$f3->route(['GET /install', 'POST /install'], 'Controllers\Install->index');

// Finally

$f3->run();
