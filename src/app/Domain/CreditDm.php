<?php
namespace App\Domain;

use App\Service\Merchant\CreditSv;

class CreditDm {

  protected $_csv;

  public function __construct() {
  
    $this->_csv = new CreditSv();
  
  }
	
	public function create($data) {

		return $this->_csv->create($data);	

	}

	public function listQuery($data) {

		return $this->_csv->listQuery($data);

	}


}