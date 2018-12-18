<?php
namespace App\Api;

/**
 * D-1 项目接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-03
 */
class Reward extends BaseApi {

  public function getRules() {
  
    return $this->rules([

      'create' => [
      
        'mid' => 'mid|int|true||客户id',
        'reward_name' => 'reward_name|string|true||项目名称',
        'brief' => 'brief|string|true||项目简介',
        'status' => 'status|int|false||状态',
        'opid' => 'opid|int|false||操作员id',
        'start_time' => 'start_time|string|false||项目有效期开始'
      
      ],

      'edit' => [
      
        'id' => 'id|string|true||项目id',
        'mid' => 'mid|int|false||客户id',
        'opid' => 'opid|int|false||操作员id',
        'reward_name' => 'reward_name|string|false||项目名称',
        'brief' => 'brief|string|false||项目简介',
        'status' => 'status|int|false||状态',
        'start_time' => 'start_time|string|false||项目有效期开始'

      ],

      'changeStep' => [
      
        'id' => 'id|int|true||项目id',
        'status' => 'status|int|true||项目状态',
        'opid' => 'opid|int|false||操作员id'
      
      ],

      'listQuery' => [
      
        'keywords' => 'keywords|string|false||项目名称',
        'fields' => 'fields|string|false||查询字段',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|true||项目id'
      
      ]
    
    ]);
  
  }

  /**
   * 新建项目
   * @desc 新建项目
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 更新项目信息
   * @desc 更新项目信息
   *
   * @return int num
   */
  public function edit() {
  
    return $this->dm->edit($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询列表
   * @desc 查询列表
   *
   * @return array list
   */
  public function listQuery() {
  
    return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询详情
   * @desc 查询详情
   *
   * @return array data
   */
  public function getDetail() {
  
    return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 修改项目进度状态
   * @desc 修改项目进度状态
   *
   * @return int num
   */
  public function changeStep() {
  
    return $this->dm->changeStep($this->retriveRuleParams(__FUNCTION__));
  
  }

}
