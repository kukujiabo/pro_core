<?php
namespace App\Service\Commodity;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 会员最新赠品记录
 *
 */
class MemberRewardNewestSv extends BaseService {

  use CurdSv;

  public function updateNewest($memberId, $rewardId, $insId) {
  
    $newest = $this->findOne([ 'member_id' => $memberId, 'reward_id' => $rewardId ]);

    if ($newest) {

      $batchUpdateQuery = [
      
        'shop_id' => $newest['shop_id'],
      
        'member_id' => $memberId
      
      ];
    
      $this->update($newest['id'], [ 'inst_id' => $insId ]);

      return $this->batchUpdate($batchUpdateQuery, [ 'newest_time' => date('Y-m-d H:i:s') ]);
    
    } else {

      $rsv = new RewardSv();

      $reward = $rsv->findOne($rewardId);
    
      $newest = [

        'inst_id' => $insId,
      
        'member_id' => $memberId,

        'reward_id' => $rewardId,

        'shop_id' => $reward['shop_id'],

        'newest_time' => date('Y-m-d H:i:s')
      
      ];

      return $this->add($newest);
    
    }
  
  }

}
