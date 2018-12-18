<?php
namespace App\Domain;

use App\Service\Merchant\MerchantAdviseSv;

class MerchantAdviseDm {

  protected $_masv;

  public function __construct() {
  
    $this->_masv = new MerchantAdviseSv();
  
  }

  public function create($data) {
  
    return $this->_masv->create($data);
  
  }

  public function getList($data) {
  
    return $this->_masv->getList($data);
  
  }

}
