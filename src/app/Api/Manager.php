<?php
namespace App\Api;

/**
 * 客户员工接口
 *
 */
class Manager extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'add' => [
      
        'pid' => 'pid|int|true||客户id',

        'name' => 'name|string|true||员工姓名',
        
        'phone' => 'phone|string|true||员工电话',
      
        'status' => 'status|int|false||状态'

      ],

      'edit' => [
      
        'id' => 'id|int|true||员工id',

        'name' => 'name|string|false||员工姓名',
        
        'phone' => 'phone|string|false||员工电话',
      
        'status' => 'status|int|false||状态'
      
      ],

      'getList' => [
      
        'pid' => 'pid|int|false||客户id',

        'name' => 'name|int|false||员工姓名',

        'phone' => 'phone|int|false||客户电话',

        'order' => 'order|string|false||排序',

        'page' => 'page|int|false||页码',

        'page_size' => 'page_size|int|false|20|每页条数'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|true||员工id'
      
      ],

      'remove' => [
      
        'id' => 'id|int|true||员工id'
      
      ]
    
    ]);
  
  }

  /**
   * 新增员工
   * @desc 新增员工
   *
   * @return int id
   */
  public function add() {
  
    return $this->dm->add($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询员工列表
   * @desc 查询员工列表
   *
   * @return array list
   */
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 删除员工
   * @desc 删除员工
   *
   * @return int id
   */
  public function remove() {
  
    return $this->dm->remove($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询员工详情
   * @desc 查询员工详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 编辑员工
   * @desc 编辑员工
   *
   * @return int num
   */
  public function edit() {
  
    return $this->dm->edit($this->retriveRuleParams(__FUNCTION__));
  
  }

}
