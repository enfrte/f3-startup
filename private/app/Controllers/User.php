<?php

namespace Controllers;

use Models\Users\UserFormValidation;
use Models\Users\UserData;
use Classes\ToastException;
use Classes\Authority;
use Exception;
use Template;
use Base;

class User  
{
	public function loginForm(Base $f3)
	{
		$f3->set('loginTypeName', 'User');
		$f3->set('loginType', 'userLogin');
		echo \Template::instance()->render('views/components/user/login-form.php');
	}

	public function login(Base $f3)
	{
		try {
			UserFormValidation::validateLoginForm($f3);
			$userData = new UserData();
			$user = $userData->singleUserSearch('credentials', ['email' => $_POST['email'], 'password' => $_POST['password']]);				

			if ( empty($user['id']) ) {
				throw new Exception("Invalid credentials");
			}
			
			$f3->set('SESSION.user.id', $user['id']);
			echo \Template::instance()->render('views/index.php');
		}
		catch (\Exception $e) {
			new ToastException($e);
		}
	}

	public function logout(Base $f3)
	{
		if ( !empty($f3->get('SESSION.user')) ) {
			$f3->clear('SESSION');
		}

		$f3->reroute('/');
	}

	public function create(Base $f3)
	{
		$f3->set('formType', 'Register');
		echo Template::instance()->render('views/components/user/user-creator-editor.php');
	}

	public function edit(Base $f3, $args)
	{
		try {
			$userData = new UserData();
			$user = $userData->singleUserSearch('userId', $args);
			$f3->set('user', $user);
		} catch (\Exception $e) {
			$f3->set('error', $e->getMessage());
		}
		finally {
			$f3->set('formType', 'Edit');
			echo Template::instance()->render('views/components/user/user-creator-editor.php');
		}
	}

	// Allows logged in user (or admin) to modify their own details (see userAuthority).
	public function update(Base $f3)
    {
		try {
			UserFormValidation::validateUpdateForm($f3);
			Authority::userAuthority($f3, $_POST['id']);
			$userData = new UserData();
			$userData->updateUser();
			$f3->reroute('/');
		} 
		catch (Exception $e) {
			new ToastException($e);
		}
	}

	public function save(Base $f3)
    {
		try {
			UserFormValidation::validateNewForm();
			$userData = new UserData();
			$f3->set('SESSION.user.id', $userData->saveNewUser());
			$f3->reroute('/');
		} 
		catch (Exception $e) {
			new ToastException($e);
		}
    }

    public function deleteOwnUser(Base $f3, $args)
    {
        try {
			Authority::userAuthority($f3, $args['id']);
			$userData = new UserData();
			$userData->deleteUser($args['id']);
			$f3->clear('SESSION');
			$f3->reroute('/');
		} 
		catch (Exception $e) {
			new ToastException($e);
		}
    }

	public function deleteUser(Base $f3, $args)
    {
        try {
			Authority::userAuthority($f3, $args['id']);
			$userData = new UserData();
			$userData->deleteUser($args['id']);
			$this->userList($f3);
		} 
		catch (Exception $e) {
			new ToastException($e);
		}
    }

	public function userList(Base $f3) {
		try {
			Authority::adminAuthority($f3);
			$userData = new UserData();
			$f3->set('users', $userData->getUserList());
			echo Template::instance()->render('views/components/user/user-list.php');
		} 
		catch (Exception $e) {
			new ToastException($e);
		}
	}
}
