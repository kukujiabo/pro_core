<?php
namespace App\Domain;

use App\Service\Crm\GetGiftLocationSv;

class GetGiftLocationDm {

  protected $_gglSv;

  public function __construct() {
  
    $this->_gglSv = new GetGiftLocation();
  
  }

  public function create($data) {
  
    return $this->_gglSv->create($data); 
  
  }

}
