<?php
namespace App\Domain;

use App\Service\Commodity\MemberRewardSv;

class MemberRewardDm {

  protected $_mrs;

  public function __construct() {
  
    $this->_mrs= new MemberRewardSv();
  
  }

  /**
   * 新建对象
   */
  public function create($data) {
  
    return $this->_mrs->create($data);
  
  }

  /**
   * 编辑对象
   */
  public function edit($data) {
  
    return $this->_mrs->edit($data);
  
  }

  /**
   * 查询列表
   */
  public function getList($data) {
  
    return $this->_mrs->getList($data);
  
  }

  /**
   * 
   */
  public function getInsList($data) {
  
    return $this->_mrs->getInsList($data); 
  
  }

  public function getEmptyInsList($data) {
  
    return $this->_mrs->getEmptyInsList($data);
  
  }

  /**
   * 核销
   */
  public function checkout($data) {
  
    return $this->_mrs->checkout($data);
  
  }

  /**
   * 查询原始赠品
   */
  public function getOriginReward($data) {
  
    return $this->_mrs->getOriginReward($data);
  
  }

  public function getMemberRewardsByRewardId($data) {
  
    return $this->_mrs->getMemberRewardsByRewardId($data); 
  
  }

  public function getMemberCheckedMoneySum($data) {
  
    return $this->_mrs->getMemberCheckedMoneySum($data);
  
  }

  public function getDetail($data) {
  
    return $this->_mrs->getDetail($data);
  
  }

  public function censusCheck($data) {
  
    return $this->_mrs->censusCheck($data);
  
  }

  public function censusShop($data) {
  
    return $this->_mrs->censusShop($data);
  
  }

  public function checkMemberExistUsedReward($data) {
  
    return $this->_mrs->checkMemberExistUsedReward($data); 
     
  }

  public function countUnusedByMemberId($data) {
  
    return $this->_mrs->countUnusedByMemberId($data);
  
  }

}
