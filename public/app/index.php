<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$APPNAME = 'pendula';

require "../../private/vendor/autoload.php";

$f3 = \Base::instance();
$f3->mset([
	'DEBUG' => 3,
	'CACHE' => '../../private/var/tmp/',
	'AUTOLOAD' => '../../private/app/',
	'INSTALL_FOLDER' => $APPNAME,
	'APPNAME' => $APPNAME,
	//'ABSOLUTE_PRIVATE_APP_PATH' => "/home/codinginthecold/$APPNAME/",
	//'UI' => "/home/codinginthecold/$APPNAME/private",
	'ABSOLUTE_PRIVATE_APP_PATH' => "/opt/lampp/htdocs/$APPNAME/private/", //XAMPP path
	'UI' => "/opt/lampp/htdocs/$APPNAME/private/",
	'VERSION' => '0.0.1', // (major version . feature update . bugfix)
	'UPDATE_COMMIT_MSG' => 'Migrated from Laravel to F3.',
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

// User 

$f3->route('GET /userLogin','Controllers\User->loginForm'); 
$f3->route('POST /userLogin','Controllers\User->login'); 
$f3->route('GET /userEdit/@id','Controllers\User->edit'); 
$f3->route('GET /registerNewUser','Controllers\User->create'); 
$f3->route('POST /updateUser','Controllers\User->update'); 
$f3->route('POST /saveNewUser','Controllers\User->save'); 
$f3->route('GET /deleteUser/@id','Controllers\User->deleteUser'); 
$f3->route('GET /deleteOwnUser/@id','Controllers\User->deleteOwnUser'); 
$f3->route('GET /userList','Controllers\User->userList'); 
$f3->route('GET /logout','Controllers\User->logout'); 

// Project

$f3->route('GET /projectList','Controllers\Project->projectList');
$f3->route('GET /saveNewProject','Controllers\Project->save');
$f3->route('GET /editProject','Controllers\Project->edit');
$f3->route('GET /deleteProject/@id','Controllers\Project->delete');

// Admin

$f3->route('GET /adminLogin','Controllers\Admin->loginForm'); 
$f3->route('POST /adminLogin','Controllers\Admin->login'); 

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
