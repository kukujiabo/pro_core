<?php
namespace App\Domain;

use \App\Service\Merchant\ContractSv;

class ContractDm {

  protected $_contractSv;

  public function __construct() {
  
    $this->_contractSv = new ContractSv();
  
  }

	
	public function create($data) {

		return $this->_contractSv->create($data);

	}	

	public function listQuery($data) {

		return $this->_contractSv->listQuery($data);

	}

  public function getDetail($data) {
  
    return $this->_contractSv->getDetail($data);
  
  }

  public function remove($data) {
  
    return $this->_contractSv->remove($data['id']);
  
  }

  public function edit($data) {
   
    return $this->_contractSv->edit($data);
  
  }

}
