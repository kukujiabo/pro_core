<?php
namespace App\Api;

/**
 * 品牌接口
 * @desc 品牌接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-04-29
 */
class Merchant extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => array(
      
        'mcode' => 'mcode|string|true||客户编码',
        'mname' => 'mname|string|true||客户名称',
        'phone' => 'phone|string|true||联系电话',
        'ext_1' => 'ext_1|string|true||联系人',
        'sales_id' => 'sales_id|int|true||销售id',
        'status' => 'status|int|true||状态',
        'brief' => 'brief|string|false||客户描述'
      
      ),

      'listQuery' => array(
      
        'keywords' => 'keywords|string|false||关键字',
        'status' => 'status|int|false||状态',
        'cType' => 'cType|int|false||客户类型',
        'start_date' => 'start_date|string|false||开始时间',
        'end_date' => 'end_date|string|false||结束时间',
        'status' => 'status|int|false||客户状态',
        'fields' => 'fields|string|false||字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'
      
      ),

      'edit' => array(

        'id' => 'id|int|true||客户id',
        'ext_1' => 'ext_1|string|false||联系人姓名',
        'phone' => 'phone|string|false||联系电话',
        'sales_id' => 'sales_id|int|false||销售id',
        'status' => 'status|int|false||客户状态'

      ),

      'getDetail' => array(

        'id' => 'id|int|true||客户id',
        'fields' => 'fields|string|false||字段'

      ),

      'getAll' => array(


      ),

      'remove' => array(
      
        'id' => 'id|int|true||客户id'
      
      )
    
    ]);
  
  }

  /**
   * 添加品牌
   * @desc 添加品牌
   *
   * @param array data
   *
   * @return int id
   */
  public function create() {

    $data = $this->retriveRuleParams(__FUNCTION__);
  
    return $this->dm->create($data);
  
  }

  /**
   * 品牌列表
   * @desc 品牌列表
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 获取全部品牌
   * @desc 获取全部品牌
   *
   * @return array list
   */
  public function getAll() {
  
    return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询详情接口
   * @desc 查询详情接口
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 编辑品牌
   * @desc 编辑品牌
   *
   * @return int num
   */
  public function edit() {
  
    return $this->dm->edit($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 删除客户
   * @desc 删除客户
   *
   * @return int num
   */
  public function remove() {
  
    return $this->dm->remove($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
