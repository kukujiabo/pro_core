<?php
namespace App\Domain;

use App\Service\Order\SalesOrderSv;

class SalesOrderDm {

  protected $_sosv;

  public function __construct() {
  
    $this->_sosv = new SalesOrderSv();
  
  }

  public function getList($data) {
  
    return $this->_sosv->getList($data);
  
  }

  public function getDetail($data) {

  	return $this->_sosv->getDetail($data);

  }

  public function updateOrder($data) {

    return $this->_sosv->updateOrder($data);

  }

}
