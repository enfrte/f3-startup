<?php 

namespace Models\Users;

use DB;
use Base;
use Exception;
use PDO;
use Classes\FormValidation;
use Models\BaseModel;

class UserQueries 
{
	public $f3;

	public function __construct() {
		$this->f3 = Base::instance();
	}

	public function doUserSearch(string $queryType = '', array $args = []) 
	{
		switch ($queryType) {
			case 'userId':
				$queryCondition = " id = :id ";
				$queryConditionData = [ ':id' => $args['id'] ];
				break;
			case 'credentials':
				$queryCondition = " email = :email AND password= :password ";
				$queryConditionData = [
					':email' => $args['email'],
					':password' => $args['password']
				];
				break;
			default:
				$queryCondition = '';
				$queryConditionData = [];
				break;
		}

		$rows = $this->f3->DB->exec(
			"SELECT * 
			FROM users 
			WHERE $queryCondition", 
			$queryConditionData
		);

		return $rows;
	}


	public function doSaveNewUser(): int
	{
		$this->f3->DB->exec(
			"INSERT INTO users 
			(name, password, email) 
			VALUES 
			(:name, :password, :email);",
			[
				':name' => $_POST['name'], 
				':email' => $_POST['email'], 
				':password' => $_POST['password'],
			]
		);

		// Get the ID of the last inserted row in SQLite
		return $this->f3->DB->lastInsertId();
	}


	public function doUpdateUser() 
	{
		$this->f3->DB->exec(
			"UPDATE users 
			SET 
			name = :name, 
			password = :password,
			email = :email
			WHERE id = :id", 
			[
				':id' => $_POST['id'], 
				':name' => $_POST['name'], 
				':email' => $_POST['email'], 
				':password' => $_POST['password'],
			]
		);
	}

	public function doDeleteUser(int $id) {
		$this->f3->DB->exec(
			"DELETE 
			FROM users
			WHERE id = :id", 
			[ 'id' => $id ]
		);
	}


	public function doGetUserList() {
		return $this->f3->DB->exec(
			"SELECT *  
			FROM users"
		);
	}

}