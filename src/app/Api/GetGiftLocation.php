<?php
namespace App\Api;

/**
 * 用户领取赠品地理位置
 *
 */
class GetGiftLocation extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [

        'member_id' => 'member_id|int|true||会员id',
        'reward_id' => 'reward_id|int|true||赠品id',
        'inst_id' => 'inst_id|int|true||实例id',
        'share_code' => 'share_code|string|false||会员id',
        'latitude' => 'latitude|string|false||纬度',
        'longitude' => 'longitude|string|false||经度'
      
      ]
    
    ]);
  
  }

  /**
   * 创建领取坐标
   * @desc 创建领取坐标
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
