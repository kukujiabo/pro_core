<?php
namespace App\Service\Commodity;

use App\Service\BaseService;
use Core\Service\CurdSv;

class MemberRewardRecentCheckedSv extends BaseService {

  use CurdSv;

  public function updateRecentChecked($memberId, $rewardId, $instId) {
  
    $rewardSv = new RewardSv();

    $reward = $rewardSv->findOne($rewardId);
  
    $data = $this->findOne([ 'member_id' => $memberId, 'reward_id' => $rewardId ]);

    if (!$data) {

      $newData = [

        'member_id' => $memberId,
      
        'reward_id' => $rewardId,

        'shop_id' => $reward['shop_id'],

        'inst_id' => $instId,

        'created_at' => date('Y-m-d H:i:s')
      
      ];
    
      $newId = $this->add($newData);
    
    }

    $batchQuery = [ 'member_id' => $memberId, 'shop_id' => $reward['shop_id'] ];

    $this->batchUpdate($batchQuery, [ 'checked_at' => date('Y-m-d H:i:s') ]);
  
  }

}
