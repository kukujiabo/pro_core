<?php
namespace App\Api;

/**
 * 会员赠品接口
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-07
 */
class MemberReward extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'create' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'reward_id' => 'reward_id|int|true||赠品id',
        'reference' => 'reference|string|true||赠品来源',
        'form_id' => 'form_id|string|false||表单id',
        'share_code' => 'share_code|string|false||分享编码',
        'origin' => 'origin|int|true||是否原始赠品',
        'type' => 'type|int|true||赠品类型',
        'start_time' => 'start_time|string|false||有效起始时间',
        'end_time' => 'end_time|string|false||有效结束时间'
      
      ],

      'edit' => [
      
        'id' => 'id|int|true||会员赠品id',
        'checked' => 'checked|int|false||核销状态'
      
      ],

      'getList' => [
      
        'shop_id' => 'shop_id|int|false||店铺id',
        'member_id' => 'member_id|int|false||会员id',
        'reward_id' => 'reward_id|int|false||赠品id',
        'member_name' => 'member_name|string|false||会员名称',
        'reward_name' => 'reward_name|string|false||赠品名称',
        'checked' => 'checked|int|false||核销状态',
        'origin' => 'origin|int|false||是否原始赠品',
        'in_date' => 'in_date|int|false||核销状态',
        'reference' => 'reference|int|false||赠品来源',
        'type' => 'type|int|false||赠品类型',
        'fields' => 'fields|string|false||字段',
        'order' => 'order|string|false|created_at desc|排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],


      'getEmptyInsList' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'reward_id' => 'reward_id|int|false||赠品id',
        'keywords' => 'keywords|string|false||关键字',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'getInsList' => [
      
        'member_id' => 'member_id|int|false||会员id',
        'reward_id' => 'reward_id|int|false||赠品id',
        'keywords' => 'keywords|string|false||关键字',
        'order' => 'order|string|false||排序',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'
      
      ],

      'checkout' => [
      
        'reward_id' => 'reward_id|int|true||赠品id',
        'code' => 'code|string|true||赠品核销码'
      
      ],

      'getOriginReward' => [
      
        'member_id' => 'member_id|int|true||会员id',
        'reward_id' => 'reward_id|int|true||赠品id',
        'checked' => 'checked|int|false|0|核销状态'
      
      ],

      'getMemberRewardsByRewardId' => [
      
        'reward_id' => 'reward_id|int|true||赠品id'
      
      ],

      'getMemberCheckedMoneySum' => [
      
        'member_id' => 'member_id|int|true||用户id'
      
      ],

      'getDetail' => [
      
        'id' => 'id|int|true||查询详情'
      
      ],

      'censusCheck' => [
      
        'reward_id' => 'reward_id|int|true||赠品id'
      
      ],

      'censusShop' => [
      
        'shop_id' => 'shop_id|int|true||店铺id'
      
      ],

      'checkMemberExistUsedReward' => [
      
        'member_id' => 'member_id|int|true||会员id'
      
      ],

      'countUnusedByMemberId' => [
      
        'member_id' => 'member_id|int|true||会员id'
      
      ]

    ]);
  
  }

  /**
   * 新建赠品
   * @desc 新建赠品
   *
   * @return int id
   */
  public function create() {
  
    return $this->dm->create($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 编辑赠品
   * @desc 编辑赠品
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
  public function getList() {
  
    return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 会员赠品计数实例列表
   * @desc 会员赠品计数实例列表
   *
   * @return array list
   */
  public function getInsList() {
  
    return $this->dm->getInsList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 会员兑换完成的增平实例列表
   * @desc 会员兑换完成的增平实例列表
   *
   * @return array list
   */
  public function getEmptyInsList() {
  
    return $this->dm->getEmptyInsList($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 核销赠品
   * @desc 核销赠品
   *
   * @return int num
   */
  public function checkout() {
  
    return $this->dm->checkout($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询原始赠品
   * @desc 查询原始赠品
   *
   * @return array data
   */
  public function getOriginReward() {
  
    return $this->dm->getOriginReward($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询赠品兑换记录
   * @desc 查询赠品兑换记录
   *
   * @return array list
   */
  public function getMemberRewardsByRewardId() {
  
    return $this->dm->getMemberRewardsByRewardId($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询用户兑换赠品总价值
   * @desc 查询用户兑换赠品总价值
   *
   * @return array data
   */
  public function getMemberCheckedMoneySum() {
  
    return $this->dm->getMemberCheckedMoneySum($this->retriveRuleParams(__FUNCTION__));
  
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
   * 查询赠品统计数据
   * @desc 查询赠品统计数据
   *
   * @return array data
   */
  public function censusCheck() {
  
    return $this->dm->censusCheck($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询店铺统计数据
   * @desc 查询店铺统计数据
   *
   * @return array data
   */
  public function censusShop() {
  
    return $this->dm->censusShop($this->retriveRuleParams(__FUNCTION__));
  
  }

  /**
   * 查询用户是否有已核销赠品记录
   * @desc 查询用户是否有已核销赠品记录
   *
   * @return boolean true/false 
   */
  public function checkMemberExistUsedReward() {
  
    return $this->dm->checkMemberExistUsedReward($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 查询用户可用赠品数量
   * @desc 查询用户可用赠品数量
   *
   * @return int num
   */
  public function countUnusedByMemberId() {

    return $this->dm->countUnusedByMemberId($this->retriveRuleParams(__FUNCTION__));
  
  }

}
