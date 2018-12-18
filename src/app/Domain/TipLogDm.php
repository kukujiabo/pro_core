<?php
namespace App\Domain;

use App\Service\Crm\TipLogSv;

class TipLogDm {

  protected $_tlSv;

  public function __construct() {
  
    $this->_tlSv = new TipLogSv();
  
  }

  public function create($data) {
  
    return $this->_tlSv->create($data);
  
  }

  public function checkMemberTip($data) {
  
    return $this->_tlSv->checkMemberTip($data);
  
  }

}
