<?php
namespace App\Domain;

use App\Service\Merchant\SalesChangeSv;

class SalesChangeDm {
	
  protected $_scsv;

  public function __construct() {
  
   	$this->_scsv = new SalesChangeSv();
 
  }

	public function getList($data) {

		return $this->_scsv->getList($data);

	}

}
