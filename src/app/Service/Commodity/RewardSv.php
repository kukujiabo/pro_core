<?php
namespace App\Service\Commodity;

use App\Service\BaseService;
use Core\Service\CurdSv;
use App\Service\Resource\ImageSv;
use App\Service\Components\Map\TXMapSv;
use App\Service\System\CommonRegionSv;
use App\Service\CMS\SearchHistorySv;
use App\Service\Merchant\ShopSv;
use App\Service\Components\Wechat\WechatAppSv;

/**
 * 赠品服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-03
 */
class RewardSv extends BaseService {

  use CurdSv;

  /**
   * 新增赠品
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {

      $newReward = [

        'mid' => $data['mid'],

        'reward_name' => $data['reward_name'],

        'brief' => $data['brief'],

        'start_time' => $data['start_time'],

        'status' => $data['status'],

        'created_at' => date('Y-m-d H:i:s')

      ];
 
      $id = $this->add($newReward);

      $pssv = new ProjectStepSv();

      $pssv->add([ 'pid' => $id, 'status' => $data['status'], 'created_at' => date('Y-m-d H:i:s'), 'opid' => $data['opid']]);

      return $id;

  }

  /**
   * 更新赠品数据
   * @decs 更新赠品数据
   *
   * @param array data
   *
   * @return int num
   */
  public function edit($data) {

    $id = $data['id'];

    $updateData = [];

    if (isset($data['reward_name'])) {

      $updateData['reward_name'] = $data['reward_name'];
    
    }

    if (isset($data['brief'])) {

      $updateData['brief'] = $data['brief'];
    
    }

    if (isset($data['status'])) {

      $updateData['status'] = $data['status'];

      $pssv = new ProjectStepSv();

      $pssv->add([ 'pid' => $id, 'status' => $data['status'], 'created_at' => date('Y-m-d H:i:s'), 'opid' => $data['opid']]);
    
    }

    if (isset($data['start_time'])) {

      $updateData['start_time'] = date('Y-m-d H:i:s', $data['start_time']);
    
    }

    return $this->update($id, $updateData);
  
  }


  /**
   * 查询列表
   * @desc 查询列表
   * 
   * @param array query
   */
  public function listQuery($data) {

    $query = array();
  
    if (isset($data['keywords'])) {
    
      $query['keywords'] = $data['keywords'];
    
    }


    $vrsSv = new VRewardInfoSv();
  
    return $vrsSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  /**
   * 查询详情
   *
   * @param array data
   *
   * @return array data
   */
  public function getDetail($data) {

    $id = $data['id'];
  
    $reward = $this->findOne($id);

    return $reward;
  
  }

}
