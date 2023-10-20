<?php 

namespace Models\Users;

use Exception;
use Classes\FormValidation;

class UserFormValidation 
{
	/**
	 * Validates a form based on custom attribute configuration.
	 *
	 * @return void
	 * @throws Exception
	 */
	public static function validateNewForm()
	{
		try {
			$validate = new FormValidation();
			$validate->setFieldsToProcess(['name', 'email', 'password']); 
			$validate->setRequired(['email', 'password']);
			$validate->setIsText(['name', 'email', 'password']);
			$validate->doValidate();
		} 
		catch (Exception $e) {
			throw new Exception('Form validation failed. ' . $e->getMessage());
		}	
	}

	/**
	 * Validates a form based on custom attribute configuration.
	 *
	 * @return void
	 * @throws Exception
	 */
	public static function validateUpdateForm()
	{
		try {
			$validate = new FormValidation();
			$validate->setFieldsToProcess(['id', 'name', 'email', 'password']); 
			$validate->setRequired(['id', 'email', 'password']);
			$validate->setIsText(['name', 'email', 'password']);
			$validate->setIsNumeric(['id']);
			$validate->doValidate();
		} 
		catch (Exception $e) {
			throw new Exception('Form validation failed. ' . $e->getMessage());
		}	
	}

	/**
	 * Validates a form based on custom attribute configuration.
	 *
	 * @return void
	 * @throws Exception
	 */
	public static function validateLoginForm()
	{
		try {
			$validate = new FormValidation();
			$validate->setFieldsToProcess(['name', 'email', 'password']); 
			$validate->setRequired(['email', 'password']);
			$validate->setIsText(['name', 'email', 'password']);
			$validate->doValidate();
		} 
		catch (Exception $e) {
			throw new Exception('Form validation failed. ' . $e->getMessage());
		}	
	}
}