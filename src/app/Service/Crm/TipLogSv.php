<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use Core\Service\CurdSv;

class TipLogSv extends BaseService {

  use CurdSv;

  /**
   * 记录用户提示
   *
   */
  public function create($data) {
  
    $newData = [
    
      'member_id' => $data['member_id'],

      'ttype' => $data['ttype'],

      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newData);
  
  }

  /**
   * 查询用户是否已经收到某个提示
   *
   */
  public function checkMemberTip($data) {
  
    $tip = $this->findOne([ 'member_id' => $data['member_id'], 'ttype' => $data['ttype'] ]); 

    return $tip ? true : false;
  
  }


}
