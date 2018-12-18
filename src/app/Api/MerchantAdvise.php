<?php
namespace App\Api;

/**
 * 商户建议接口
 * @desc 商户建议接口
 *
 *
 */
class MerchantAdvise extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'content' => 'content|string|true||建议内容',

        'shop_id' => 'shop_id|int|true||店铺id'
      
      ],

      'getList' => [
      
        'shop_name' => 'shop_name|string|false||店铺名称',

        'page' => 'page|int|false|1|页码',

        'page_size' => 'page_size|int|false|20|每页条数'
      
      ]
    
    ]);
  
  }

  /**
   * 新建商户建议
   * @desc 新建商户建议
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 获取商户建议列表
   * @desc 获取商户建议列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

}
