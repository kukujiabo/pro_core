<?php
namespace App\Api;

/**
 * 系统配置项接口
 *
 */
class SystemConfig extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'wechatCensorStatus' => []
    
    ]); 
  
  }

  /**
   * 微信审核状态接口
   * @desc 微信审核状态接口
   *
   * @return int num
   */
  public function wechatCensorStatus() {
  
    return $this->dm->wechatCensorStatus($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
