<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

/**
 * 会员关注店铺
 *
 * @author Meroc Chen <398515393@qq.com>
 */
class MemberFavoriteShopSv extends BaseService {

  use CurdSv;

  /**
   * 新建关注
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {

    /**
     * 先判断是否已经有关注记录，若有则不重复记录
     */

    $uniqueCondition = [ 

      'member_id' => $data['member_id'], 
      
      'mid' => $data['mid'], 

      'focus' => 1 

    ];

    $existNum = $this->queryCount($uniqueCondition);

    if ($existNum > 0) {
    
      return null;
    
    }

    $newFocus = [
    
      'member_id' => $data['member_id'],
      'shop_id' => $data['shop_id'],
      'mid' => $data['mid'],
      'focus' => 1,
      'created_at' => date('Y-m-d H:i:s')
    
    ];

    return $this->add($newFocus);
  
  }

  /**
   * 取消关注
   *
   * @param array data
   *
   * @return int num
   */
  public function cancelFocus($data) {

    $focus = $this->findOne($data['id']);

    $query = [
    
      'member_id' => $focus['member_id'],

      'shop_id' => $focus['shop_id']
    
    ];

    if ($foucs['mid']) {
    
      $query['mid'] = $focus['mid'];
    
    }

    $cancelData = [
    
      'focus' => 0,
      'cancel_at' => date('Y-m-d H:i:s')
    
    ];
  
    return $this->batchUpdate($query, $cancelData);
  
  }

  /**
   * 查询联合关注信息
   *
   * @param array data
   *
   * @return array list
   */
  public function getUnionInfoList($data) {
  
    $query = [];

    if (isset($data['member_id'])) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if (isset($data['shop_id'])) {
    
      $query['shop_id'] = $data['shop_id'];
    
    }
    if (isset($data['mid'])) {
    
      $query['mid'] = $data['mid'];
    
    }
    if (isset($data['focus'])) {
    
      $query['focus'] = $data['focus'];
    
    }
  
    $mfsSv = new VMemberFocusShopSv();

    return $mfsSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }


  /** 查询关注数量
   *
   * @param array data
   *
   * @return int num
   */
  public function getFocusCount($data) {
  
    $query = [];

    if (isset($data['member_id'])) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if (isset($data['shop_id'])) {
    
      $query['shop_id'] = $data['shop_id'];
    
    }
    if (isset($data['mid'])) {
    
      $query['mid'] = $data['mid'];
    
    }
    if (isset($data['focus'])) {
    
      $query['focus'] = $data['focus'];
    
    }
  
    $mfsSv = new VMemberFocusShopSv();
  
    return $mfsSv->queryCount($query);

  }

  public function getFocusByShopId($data) {
  
    $mfSv = new VMemberFavoriteSv();

    $query = [];

    $query['shop_id'] = $data['shop_id'];

    return $mfSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

}
