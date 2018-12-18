<?php
namespace App\Service\CMS;

use App\Service\BaseService;
use Core\Service\CurdSv;
use App\Service\Commodity\MemberRewardSv;

/**
 * 广告配置
 *
 */
class AdsSv extends BaseService {

  use CurdSv;

  public function checkDisplay($data) {
  
    $ads = $this->findOne([ 'ad_code' => $data['ad_code'] ]);    
   
    if ($ads['check_type'] == 1) {

      $mrsv = new MemberRewardSv();
    
      $count = $mrsv->queryCount([ 'member_id' => $data['member_id'] ]);

      return $count < $ads['num'];
    
    }
  
  }

}
