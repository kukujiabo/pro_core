<?php
namespace App\Domain;

use App\Service\Merchant\SalesBindSv;

class SalesBindDm {
	
  protected $_sbsv;

  public function __construct() {
  
    $this->_sbsv = new SalesBindSv();
  
  }

	public function getAll() {

		return $this->_sbsv->getAll();

	}

}