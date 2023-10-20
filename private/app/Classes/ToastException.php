<?php

namespace Classes;

use Exception;

/**
 * Returns the response in the format that can be picked up by the toast listener.
 */
class ToastException {
	private $errorMessages = [
		23000 => "User already exists.",
		// Add more error codes and messages as needed.
	];

	public function __construct(Exception $exception) 
	{
		http_response_code(400);    
		$code = $exception->getCode();
	
		if (array_key_exists($exception->getCode(), $this->errorMessages)) {
			echo $this->errorMessages[$code];
		} else {
			echo $exception->getMessage();
		}
		exit;
	}
}
