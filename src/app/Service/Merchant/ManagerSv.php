<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

class ManagerSv extends BaseService {

  use CurdSv;

  public function getList($data) {
  
    $query = [];

    if ($data['pid']) {
    
      $query['pid'] = $data['pid'];
    
    }

    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  public function getDetail($data) {
  
    return $this->findOne($data['id']);
  
  }

  public function edit($data) {
  
    $updateData = [];

    if ($data['name']) {
    
      $updateData['name'] = $data['name'];
    
    }
    if ($data['phone']) {
    
      $updateData['phone'] = $data['phone'];
    
    }
    if ($data['status']) {
    
      $updateData['status'] = $data['status'];
    
    }

    return $this->update($data['id'], $updateData);
  
  }

}
