<?php

namespace Classes;

use Base;
use Exception;

class Authority 
{
    // Only allow admin or logged in user matching given userId to do something
	public static function userAuthority(Base $f3, int $userId) 
	{
		$loggedInIsAdmin = $f3->get('SESSION.user.admin') ?? false;
		$loggedInUserId = $f3->get('SESSION.user.id') ?? false;

		if ( ! $loggedInIsAdmin && $loggedInUserId != $userId ) {
			throw new Exception("Authorisation request denied.");
		}
	}

	// Only allow admin 
	public static function adminAuthority(Base $f3) 
	{
		$loggedInIsAdmin = $f3->get('SESSION.user.admin') ?? false;

		if ( ! $loggedInIsAdmin ) {
			throw new Exception("Authorisation request denied.");
		}
	}

}