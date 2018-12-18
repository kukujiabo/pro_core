<?php
namespace App\Domain;

use App\Service\Merchant\ManagerSv;

class ManagerDm {

  protected $_mmsv;

  public function __construct() {
  
    $this->_mmsv = new ManagerSv();

  }

  public function add($data) {

    $data['created_at'] = date('Y-m-d H:i:s');
  
    return $this->_mmsv->add($data);
  
  }

  public function getList($data) {
  
    return $this->_mmsv->getList($data);
  
  }

  public function remove($data) {
  
    return $this->_mmsv->remove($data['id']);
  
  }

  public function getDetail($data) {
  
    return $this->_mmsv->getDetail($data);
  
  }

  public function edit($data) {
  
    return $this->_mmsv->edit($data);
  
  }

}
