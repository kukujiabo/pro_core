<?php
namespace App\Api;

/**
 * 用户提示记录
 *
 */
class TipLog extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|true||会员id',

        'ttype' => 'ttype|int|true||提示类型'
      
      ],

      'checkMemberTip' => [
      
        'member_id' => 'member_id|int|true||会员id',

        'ttype' => 'ttype|int|true||提示类型'
      
      ]
    
    ]);
  
  }

  /**
   * 新增提醒记录
   * @desc 新增提醒记录
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 检查用户提醒记录
   * @desc 检查用户提醒记录
   *
   * @return boolean true/false
   */
  public function checkMemberTip() {
  
    return $this->dm->checkMemberTip($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
