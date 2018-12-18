<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use Core\Service\CurdSv;
use App\Service\Commodity\MemberRewardSv;
use App\Service\Components\Wechat\WechatAppSv;

class ShareActionSv extends BaseService {

  use CurdSv;

  /**
   * 创建分享动作
   *
   * @param array data
   *
   * @param int id 
   */
  public function create($data) {

    $newAct = [
    
      'member_id' => $data['member_id'],
      'share_code' => $data['share_code'],
      'type' => $data['type'],
      'page_path' => $data['page_path'],
      'relat_id' => $data['relat_id'],
      'created_at' => date('Y-m-d H:i:s'),
    
    ];
  
    return $this->add($newAct);
  
  }

  /**
   * 查询会员分享列表
   *
   * @param array data
   *
   * @return 
   */
  public function listQuery($data) {
  
    $query = [];

    if ($data['member_id']) {
    
      $query['member_id'] = $data['member_id'];
    
    }

    if ($data['shop_id']) {
    
      $query['shop_id'] = $data['shop_id'];
    
    }

    if ($data['member_name']) {
    
      $query['member_name'] = $data['member_name'];
    
    }
    if ($data['reward_name']) {
    
      $query['reward_name'] = $data['reward_name'];
    
    }
    if ($data['share_code']) {
    
      $query['share_code'] = $data['share_code'];
    
    }

    $vsaSv = new VShareActionMemberSv();
  
    return $vsaSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  /**
   * 校验赠品是否已领取
   *
   * @param array data
   *
   * @return boolean true/false
   */
  public function checkShareAction($data) {
  
    $share = $this->findOne(['share_code' => $data['share_code']]);
  
    /**
     * 判断该用户是否已经领取过这一赠品
     */
    $mrSv = new MemberRewardSv();

    $rIns = $mrSv->findOne([
      
      'member_id' => $data['member_id'], 
      'reward_id' => $share['relat_id']

    ]);

    if ($rIns) {
    
      return true;
    
    } else {
    
      return false;
    
    }
  
  }

  /**
   * 领取分享礼物
   *
   * @param array data
   *
   * @return int id
   */
  public function getGift($data) {
  
    $share = $this->findOne(['share_code' => $data['share_code']]);

    /**
     * 判断该用户是否已经领取过分享人的这一赠品
     */
    $mrSv = new MemberRewardSv();

    $rIns = $mrSv->findOne(['member_id' => $data['member_id'], 'reference' => $share['member_id'], 'reward_id' => $share['relat_id']]);

    if ($rIns) {
    
      return 0;
    
    }

    /**
     * 判断是否自己分享的赠品
     */
    if ($data['member_id'] == $share['member_id']) {
    
      return 0;
    
    }

    $newRewardInst = [
    
      'form_id' => $data['form_id'],
      'member_id' => $data['member_id'],
      'reward_id' => $share['relat_id'],
      'reference' => $share['member_id'],
      'share_code' => $share['share_code'],
      'type' => 2,
      'origin' => 1

    ];

    return $mrSv->create($newRewardInst);
  
  }

  /**
   * 查询赠品详情
   *
   * @param array data
   *
   * @return array data
   */
  public function getDetail($data) {
  
    $shareInfo = null; 

    $vsaSv = new VShareActionMemberSv();

    if ($data['id']) {
    
      $shareInfo = $vsaSv->findOne($data['id']);
    
    } elseif ($data['share_code']) {
     
      $shareInfo = $vsaSv->findOne(['share_code' => $data['share_code']]); 
    
    }

    $shareInfo['end_date'] = date('Y-m-d', strtotime($shareInfo['end_time']));

    if ($data['member_id']) {
    
      if ($data['member_id'] == $shareInfo['member_id']) {
      
        $shareInfo['myself'] = 1;
      
      } else {

        $mrSv = new MemberRewardSv();

        $inst = $mrSv->findOne([ 'member_id' => $data['member_id'] ]);

        if ($inst) {
        
          $shareInfo['fetched'] = 1;
        
        }

      }
    
    }

    return $shareInfo;
  
  }

  public function shareActionCode($data) {
  
    $wxSv = new WechatAppSv();

    $page = 'pages/shops/list/index';

    $scene = "shc{$data['share_code']}";

    $stream = $wxSv->getMiniTempCode($scene, $page, $data['width'], $data['auto_color'], $data['line_color'], $data['hyaline']);

    echo $stream;

    exit;
  }

}
