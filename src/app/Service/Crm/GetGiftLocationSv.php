<?php
namespace App\Service\Crm;

/**
 * 商品领取地理位置
 *
 */
class GetGiftLocationSv extends BaseService {

  public function create($data) {
  
    $newLocation = [
    
      'member_id' => $data['member_id'],

      'reward_id' => $data['reward_id'],

      'share_code' => $data['share_code'],

      'longitude' => $data['longitude'],

      'latitude' => $data['latitude'],

      'created_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->add($newLocation);
  
  }

}
