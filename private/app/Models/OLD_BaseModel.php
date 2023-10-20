<?php 

namespace Models;

use DB;
use Base;
use Exception;
use Classes\FormValidation;

class BaseModel
{
	/**
	 * F3 Mapper object
	 *
	 * @var Mapper
	 */
	protected $object;
	protected $isAdmin;

	public function __construct(Base $f3, string $tableName) {
		$this->isAdmin = $f3->get('SESSION.user.admin');
		$this->object = new DB\SQL\Mapper($f3->DB, $tableName);
	}

	// Load things by searching with query parameters
	public function querySearch(array $searchParams)
	{
		$object = $this->getObject();
		$object->load($searchParams);

		if ( $object->dry() ) {
			throw new Exception("Not found.");
		}

		$this->setObject($object);
	}

	// Load things with ids
	public function searchById(Base $f3, int $id)
	{
		$object = $this->getObject();
		$object->load( ['id=?', $id] );

		if ($object->dry()) {
			throw new Exception("Not found.");	
		}

		$this->setObject($object);
	}


	public function erase()
	{
		$this->getObject()->erase();
	}

	public function cast()
	{
		return $this->getObject()->cast();
	}

	public function copyFrom($identifier)
	{
		return $this->getObject()->copyFrom($identifier);
	}
	
	/**
	 * Get the value of user
	 */ 
	public function getObject()
	{
		return $this->object;
	}


	/**
	 * Set the value of user
	 *
	 * @return  self
	 */ 
	public function setObject($object)
	{
		$this->object = $object;
		return $this;
	}


	public function errorHandler(\Throwable $error)
	{
		if ( $this->isAdmin || $error instanceof \Exception ) {
			return $error->getMessage();
		} 
		else {
			return 'There was an error';
		}
	}
	
}
