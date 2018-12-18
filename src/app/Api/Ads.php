<?php
namespace App\Api;

/**
 * 广告服务接口
 *
 */
class Ads extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'checkDisplay' => [
      
        'member_id' => 'member_id|int|true||会员id',

        'ad_code' => 'ad_code|string|true||广告代码'
      
      ]
    
    ]);
  
  }

  /**
   * 校验显示条件
   * @desc 校验显示条件
   *
   * @return boolean true/false
   */
  public function checkDisplay() {
  
    return $this->dm->checkDisplay($this->retriveRuleParams(__FUNCTION__));  
  
  }

}
