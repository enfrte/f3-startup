<?php

namespace Controllers;

use Models\Users\UserFormValidation;
use Base; 
use Exception;
use Classes\ToastException;

class Admin
{
	private $adminStore = []; 

	public function __construct(\Base $f3) 
	{
		$installPath = $f3->ABSOLUTE_PRIVATE_APP_PATH;
		$envFileContents = file_get_contents($installPath.'.env', true);
		$this->adminStore = json_decode($envFileContents);
	}

	public function loginForm(Base $f3)
	{
		$f3->set('loginTypeName', 'Admin');
		$f3->set('loginType', 'adminLogin');
		echo \Template::instance()->render('views/components/user/login-form.php');
	}

	public function login(Base $f3)
	{
		try {
			UserFormValidation::validateLoginForm($f3);

			if ( empty($f3->get('SESSION.user.admin')) ) {
				$adminStore = $this->adminStore;

				foreach ($adminStore->admin as $admin) {
					if ($admin->email === $_POST['email'] && $admin->password === $_POST['password'] ) {
						$f3->set('SESSION.user.admin',1);
						echo \Template::instance()->render('views/index.php');
						return;
					}
				}

				throw new Exception("Invalid credentials");
			}
		}
		catch (\Exception $e) {
			new ToastException($e);
		}
	}

	public function userList() {
		
	}

	public function backup(Base $f3)
	{
		if ( empty($f3->get('SESSION.user.admin')) ) { 
			$this->login($f3);
		}

		if (empty($_POST['backup'])) {
			echo \Template::instance()->render('views/components/admin/backup.php');
			return;
		}

		$date = date('Y-m-d-H:i');
		
		$path = $f3->ABSOLUTE_PRIVATE_APP_PATH.'data/';
		$extension = '.sqlite';
		$original_file = $path . $f3->APPNAME.'_db'.$extension;
		$copy_file = $path . $original_file . $date . $extension;

		// make a copy of the original file
		if (!copy($original_file, $copy_file)) {
			echo "Failed to copy $original_file...\n";
			exit;
		}
		
		echo 'Copied: '.$copy_file;
	}

}
