<?php
namespace App\Domain;

use App\Service\Crm\ShareActionSv;

class ShareActionDm {

  protected $_sasv;

  public function __construct() {
  
    $this->_sasv = new ShareActionSv();
  
  }

  public function create($data) {
  
    return $this->_sasv->create($data); 
  
  }

  public function listQuery($data) {
  
    return $this->_sasv->listQuery($data);  
  
  }

  public function getGift($data) {
  
    return $this->_sasv->getGift($data); 

  }

  public function getDetail($params) {
  
    return $this->_sasv->getDetail($params);
  
  }

  public function checkShareAction($params) {
  
    return $this->_sasv->checkShareAction($params);
  
  }

  public function rewardShareCode($params) {
  
    return $this->_sasv->rewardShareCode($params);
  
  }

  public function shareActionCode($params) {

    return $this->_sasv->shareActionCode($params);
  
  }

}
