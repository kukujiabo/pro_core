<?php
namespace App\Domain;

use App\Service\System\ConfigSv;

class SystemConfigDm {

  protected $_csv;

  public function __construct() {
  
    $this->_csv = new ConfigSv(); 
  
  }

  public function wechatCensorStatus() {
  
   return $this->_csv->getConfig('wx_censor');
  
  }

}
