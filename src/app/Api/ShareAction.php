<?php
namespace App\Api;

/**
 * 分享动作接口
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class ShareAction extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'share_code' => 'share_code|string|true||分享码',
        'type' => 'type|int|true||分享类型：1.分享怎平，2.分享小程序',
        'relat_id' => 'relat_id|int|false||分享id',
        'page_path' => 'page_path|string|true||分享所在页面'
      
      ],

      'listQuery' => [
      
        'shop_id' => 'shop_id|int|false||商铺id',
        'member_id' => 'member_id|int|false||会员id',
        'member_name' => 'member_name|string|false||会员名称',
        'reward_name' => 'reward_name|string|false||赠品名称',
        'share_code' => 'share_code|string|false||分享码',
        'fields' => 'fields|string|false||字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|50|每页条数'
      
      ], 

      'getGift' => [
      
        'member_id' => 'member_id|int|true||被赠送人id',
        'share_code' => 'share_code|string|true||分享编号',
        'form_id' => 'form_id|string|true||formId'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|false||分享id',
        'member_id' => 'member_id|int|false||会员id',
        'share_code' => 'share_code|string|false||分享编码'
      
      ],

      'checkShareAction' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'share_code' => 'share_code|string|false||分享编码'
      
      ],

      'shareActionCode' => [
      
        'share_code' => 'share_code|string|true||分享码' 
      
      ]
    
    ]);
  
  }

  /**
   * 创建分享动作
   * @desc 创建分享动作
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 会员分享动作列表
   * @desc 会员分享动作列表
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 领取赠品
   * @desc 领取赠品
   *
   * @return int id
   */
  public function getGift() {
  
    return $this->dm->getGift($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询分享赠品详情
   * @desc 查询分享赠品详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 校验分享动作
   * @desc 校验分享动作
   *
   * @return boolean true/false
   */
  public function checkShareAction() {
  
    return $this->dm->checkShareAction($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 分享二维码
   * @desc 分享二维码
   *
   * @return string stream
   */
  public function shareActionCode() {
  
    return $this->dm->shareActionCode($this->retriveRuleParams(__FUNCTION__));
  
  }

}
