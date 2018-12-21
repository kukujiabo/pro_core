<?php
namespace App\Api;

/**
 * 采购订单接口
 *
 *
 */
class SalesOrder extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'getList' => [
      
        'p_oid' => 'p_oid|string|false||采购订单号',
        'begin_date' => 'begin_date|string|false||下单开始时间',
        'end_date' => 'end_date|string|false||下单结束时间',
        'ven_code' => 'ven_code|string|false||供应商编码',
        'dep_code' => 'dep_code|string|false||部门编码',
        'person_code' => 'person_code|string|false||业务员编码',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'

      ],

      'getDetail' => [

        'p_oid' => 'p_oid|string|true||采购订单号',

      ],

      'updateOrder' => [

        'p_oid' => 'p_oid|string|true||采购订单号',
        'execution_step' => 'execution_step|string|true||订单'

      ],
    
    ]); 
  
  }

  /**
   * 查询列表
   * @desc 查询列表
   *
   * @return array data
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询订单详情
   * @desc 查询订单详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 更新订单
   * @desc 更新订单
   *
   * @return array data
   */
  public function updateOrder() {

    return $this->dm->updateOrder($this->retriveRuleParams(__FUNCTION__));

  }


}
