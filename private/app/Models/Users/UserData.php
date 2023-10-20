<?php 

namespace Models\Users;

use DB;
use Base;
use Exception;
use Models\BaseModel;
use Classes\FormValidation;
use Models\Users\UserQueries;

class UserData
{
	// 
	public function singleUserSearch(string $searchType, array $args = []): array
	{
		$userQueries = new UserQueries();
		$result = $userQueries->doUserSearch($searchType, $args);
		return !empty($result) ? $result[0] : [];
	}


	public function saveNewUser(): int
	{
		$userQueries = new UserQueries();
		return $userQueries->doSaveNewUser();
	}

	public function updateUser()
	{
		$userQueries = new UserQueries();
		$userQueries->doUpdateUser();
	}

	public function deleteUser(int $id)
	{
		$userQueries = new UserQueries();
		return $userQueries->doDeleteUser($id);
	}


	public function getUserList(): array
	{
		$userQueries = new UserQueries();
		return $userQueries->doGetUserList();
	}

}
