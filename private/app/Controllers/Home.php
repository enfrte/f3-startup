<?php

namespace Controllers;

use Base;
use Template;

class Home
{
	public function __construct() {
	}

	public function index(Base $f3)
	{
		//echo 'Home-index';
		echo Template::instance()->render('views/index.php');
	}

	public function landing()
	{
		echo \Template::instance()->render('views/components/home/landing.php');		
	}
}
