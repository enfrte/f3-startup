<?php 

namespace Models;

use Base;
use Exception;
use Throwable;

class BaseModel
{
	// Move to Error class
	public function errorHandler(Throwable $error)
	{
		if ( $this->isAdmin || $error instanceof Exception ) {
			return $error->getMessage();
		} 
		else {
			return 'There was an error';
		}
	}
	
}
