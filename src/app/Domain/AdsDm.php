<?php
namespace App\Domain;

use App\Service\CMS\AdsSv;

class AdsDm {

  protected $_asv;

  public function __construct() {
  
    $this->_ads = new AdsSv();
  
  }

  public function checkDisplay($data) {
  
    return $this->_ads->checkDisplay($data);
  
  }

}
