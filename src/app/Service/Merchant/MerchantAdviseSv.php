<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

class MerchantAdviseSv extends BaseService {

  use CurdSv;

  public function create($data) {
  
    $newAdvise = [
    
      'shop_id' => $data['shop_id'],
      'content' => $data['content'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->add($newAdvise);
  
  }

  public function getList($data) {
  
    $query = [];
  
    if ($data['shop_name']) {
    
      $query['shop_name'] = $data['shop_name'];
    
    }

    $vmsSv = new VMerchantAdviseShopSv();

    return $vmsSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
