<?php
namespace App\Service\Commodity;

use \Core\Service\CurdSv;
use App\Service\BaseService;
use App\Service\Merchant\MemberFavoriteShopSv;
use App\Service\Merchant\ShopSv;
use App\Service\Components\Wechat\WechatAppSv;
use App\Service\Crm\MemberSv;

/**
 * 会员赠品服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-06-07
 */
class MemberRewardSv extends BaseService {

  use CurdSv;

  /**
   * 新建赠品实例
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {

    /**
     * 查询赠品详情
     */
    $rsv = new RewardSv();

    $reward = $rsv->findOne($data['reward_id']);

    /**
     * 判断是否原始赠品
     */
    if ($data['origin'] == 1) {

      $inst = $this->findOne([ 'origin' => 1, 'member_id' => $data['member_id'], 'reward_id' => $data['reward_id'] ]);

      if ($inst) {
      
        $this->throwError($this->_err->ORIGINREWARDEXISTMSG, $this->_err->ORIGINREWARDEXISTCODE);
      
      }

      /**
       * 获取原始赠品需要关注商家
       */
      
      $mfsSv = new MemberFavoriteShopSv();

      $mfsSv->create([ 'member_id' => $data['member_id'], 'shop_id' => $reward['shop_id'], 'mid' => $reward['mid'] ]);

    }

    $code = '';

    do {
    
      $code = $this->generateRewardCode();
    
      $exist = $this->findOne(['code' => $code]);
    
    } while($exist);
  
    $newReward = [
    
      'mid' => $reward['mid'],  // 品牌id
      'm_exclude' => $reward['m_exclude'], // 赠品互斥类型
      'reward_code' => $reward['reward_code'], // 赠品编码
      'member_id' => $data['member_id'],
      'reward_id' => $data['reward_id'],
      'share_code' => $data['share_code'] ? $data['share_code'] : 0,
      'origin' => $data['origin'],
      'code' => $code,  // 实例编号
      'reference' => $data['reference'] ? $data['reference'] : 0,
      'type' => $data['type'],
      'checked' => 0,
      'start_time' => $data['start_time'],
      'end_time' => $data['end_time'],
      'created_at' => date('Y-m-d H:i:s')
    
    ];
 
    /**
     * 新增会员赠品
     */
    $id = $this->add($newReward);

    $newsv = new MemberRewardNewestSv();

    $newsv->updateNewest($data['member_id'], $data['reward_id'], $id);


    /**
     * 领取原始赠品时下发通知
     */
    if ($data['origin'] == 1) {

      $msv = new MemberSv();

      $shopSv = new ShopSv();

      $member = $msv->findOne($data['member_id']);

      $shop = $shopSv->findOne($reward['shop_id']);

      if ($data['reference']) {
      
        $recommender = $msv->findOne($data['reference']);
      
      }

      $wxappSv = new WechatAppSv();

      $templateId = 'V5AKGB-ZeY__doH5KLYQ4V3vx29ScxXIrijEfmDi8mA';

      $page = "pages/shops/list/index?reward_id={$data['reward_id']}";

      $postData = [
      
        'keyword1' => [ 'value' => $reward['reward_name'], 'color' => '#4A25A4' ],

        'keyword2' => [ 'value' => $data['reference'] ? $recommender['member_name'] : $shop['shop_name'] ],

        'keyword3' => [ 'value' => $reward['price'] . '元' ],

        'keyword4' => [ 'value' => date('Y-m-d', strtotime($reward['end_time'])) ],

        'keyword5' => [ 'value' => '请在有效时间内使用' ]
      
      ];

      $emphasis = 'keyword1.DATA';

      $wxappSv->miniMsg($member['wx_mnopenid'], $templateId, $data['form_id'], $page, $postData, $emphasis, $id, 1);

    }

    // todo end transcation

    return $id;
  
  }

  /**
   * 更新赠品信息
   *
   * @param array 
   *
   * @return 
   */
  public function edit($data) {
  
    $id = $data['id'];

    $updateData = [];

    if ($data['checkd']) {
    
      $updateData['checked'] = 1;

      $updateData['checked_at'] = date('Y-m-d H:i:s');
    
    }
  
  }

  /**
   * 生成券码
   *
   * @return string code
   */
  protected function generateRewardCode() {
  
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXVZ0123456798';

    $code = '';

    for($i = 0; $i < 10; $i++) {
    
      $code .= $str[rand(0, 35)];
    
    }
      
    return $code;
  
  }

  /**
   * 查询列表
   *
   * @param array $data
   *
   * @return array list
   */
  public function getList($data) {

    $query = [];

    if (isset($data['member_id'])) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if (isset($data['reward_id'])) {
    
      $query['reward_id'] = $data['reward_id'];
    
    }
    if (isset($data['member_name'])) {
    
      $query['member_name'] = $data['member_name'];
    
    }

    if (isset($data['reward_name'])) {
    
      $query['reward_name'] = $data['reward_name'];
    
    }
  
    if (isset($data['checked'])) {
    
      $query['checked'] = $data['checked'];
    
    }
  
    if (isset($data['reference'])) {
    
      $query['reference'] = $data['reference'];
    
    }

    if (isset($data['shop_id'])) {
    
      $query['shop_id'] = $data['shop_id'];
    
    }
    if (isset($data['type'])) {
    
      $query['type'] = $data['type'];
    
    }
    if (isset($data['origin'])) {
    
      $query['origin'] = $data['origin'];
    
    }

    if ($data['in_date'] == 1) {

      $today = date('Y-m-d');
    
      $query['checked_at'] = "gt|{$today}";
    
    }

    $order = $data['order'] ? $data['order'] : 'created_at desc';

    $view = new VMemberRewardsSv();

    return $view->queryList($query, $data['fields'], $order, $data['page'], $data['page_size']);

  }

  /**
   * 查询空白列表
   *
   * @param array $data
   *
   * @return array list
   */
  public function getEmptyInsList($data) {
  
    $query = [];

    if (isset($data['member_id'])) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if (isset($data['reward_id'])) {
    
      $query['member_id'] = $data['reward_id'];
    
    }
    if (isset($data['keywords'])) {
    
      $or = "shop_name like '%{$data['keywords']}%' or reward_name like '%{$data['keywords']}%' ";
    
    }

    $mcrsSv = new VMemberEmptyCntRewardShopSv();

    $rewards = $mcrsSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size'], $or);
  
    foreach($rewards['list'] as $key => $reward) {

      if ($reward['end_time']) {
    
        $rewards['list'][intval($key)]['end_time'] = date('Y-m-d', strtotime($reward['end_time']));

      }
    
    }

    return $rewards;
  
  }

  /**
   * 会员有效计数赠品列表
   *
   * @param array data
   *
   * @return array list
   */
  public function getInsList($data) {
  
    $query = [];

    if (isset($data['member_id'])) {
    
      $query['member_id'] = $data['member_id'];
    
    }
    if (isset($data['reward_id'])) {
    
      $query['reward_id'] = $data['reward_id'];
    
    }
    if (isset($data['keywords'])) {
    
      $or = "shop_name like '%{$data['keywords']}%' or reward_name like '%{$data['keywords']}%' ";
    
    }

    $mcrsSv = new VMemberCntRewardShopSv();

    $rewards = $mcrsSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size'], $or);

    foreach($rewards['list'] as $key => $reward) {

      if ($reward['end_time']) {
    
        $rewards['list'][intval($key)]['end_time'] = date('Y-m-d', strtotime($reward['end_time']));

      }
    
    }

    return $rewards;
  
  }

  /**
   * 查询用户是否领取过原始赠品
   */
  public function checkExist($memberId, $rewardCode, $mid = NULL, $type = NULL) {

    if ($type == 1) { // 1: 判断同品牌互斥赠品

      return $this->findOne([

        'member_id' => $memberId,

        'reward_code' => $rewardCode,

        'mid' => $mid,

        'origin' => 1
      
      ]);

    } else { // 判断普通单店赠品
  
      return $this->findOne([

        'member_id' => $memberId,
        
        'reward_code' => $rewardCode,
      
        'origin' => 1
      
      ]);

    }
  
  }

  /**
   * 核销赠品
   *
   * @param array data
   *
   * @return int num
   */
  public function checkout($data) {
  
    $query = [
    
      'id' => $data['reward_id'],

      'checked' => 0,
    
    ];

    $reward = $this->findOne($query);

    if (!$reward) {

      /**
       * 未查询到赠品
       */
    
      $this->throwError($this->_err->CHECKINVALIDREWARDMSG, $this->_err->CHECKINVALIDREWARDCODE);
    
    }

    $rsv = new RewardSv();

    $rinst = $rsv->findOne($reward['reward_id']);

    if ($rinst['check_code'] != $data['code']) {

      /**
       * 核销码错误
       */
    
      $this->throwError($this->_err->CHECKCODEINVALIDMSG, $this->_err->CHECKCODEINVALIDCODE);
    
    }

    // todo start transaction
    
    /**
     * 更新赠品状态
     */
    $checkRes = $this->update($reward['id'], [ 'checked' => 1, 'checked_at' => date('Y-m-d H:i:s') ]);

    if ($checkRes) {

      /**
       * 将更新结果加入排序
       */
      $mrrcSv = new MemberRewardRecentCheckedSv();

      $mrrcSv->updateRecentChecked($reward['member_id'], $reward['reward_id'], $reward['id']);

      if ($reward['origin'] == 1 && $reward['reference'] > 0) {

        /**
         * 裂变赠送赠品
         */
        $this->feedbackReward($reward['id']);
      
      }

    }

    // todo end transaction

    return $checkRes;
  
  }

  /**
   * 送出礼物
   *
   * @param int id
   *
   * @return int id
   */
  public function feedbackReward($id) {
  
    $mreward = $this->findOne($id);

    /**
     * 查询用户已获得的奖励数量
     */
    $rsv = new RewardSv();

    $reward = $rsv->findOne($mreward['reward_id']);

    /**
     * 当奖励险恶大于0，则需要判定是否可以继续赠送 
     */
    if ($reward['max_fetched'] > 0) {
    
      $mcount = $this->queryCount([ 'member_id' => $mreward['member_id'], 'origin' => 0 ]);

      /**
       * 赠品达到最大数量后不再赠送
       */

      if ($mcount == $reward['max_fetched']) {
      
        return 0;
      
      }
    
    }

    $newReward = [
    
      'member_id' => $mreward['reference'],
      'reward_id' => $mreward['reward_id'],
      'reference' => $mreward['member_id'],
      'origin' => 0,
      'type' => 3
    
    ];

    $newId = $this->create($newReward);

    /**
     * 发送赠品获取通知
     */
    $msv = new MemberSv();

    $wxAppSv = new WechatAppSv();

    $member = $msv->findOne($mreward['reference']);

    $msgData = [
    
      'keyword1' => [ 'value' => $reward['reward_name'] ]
    
    ];
  
    $wxAppSv->miniMsg($member['wx_mnopenid'], '', '', 'pages/wallet/list/list', $msgData, '', $newId, 2); 

    return $newId;
  
  }

  /**
   * 查询用户获取的原始赠品
   *
   * @param $data
   *
   * @return array data
   */
  public function getOriginReward($data) {

    /**
     * 判断赠品类型
     */
    $rsv = new RewardSv();

    $reward = $rsv->findOne($data['reward_id']);

    $query = [];

    $query['member_id'] = $data['member_id'];

    $query['reward_code'] = $reward['reward_code'];

    $query['checked'] = $data['checked'];
    
    $query['origin'] = 1;

    if (!$reward['m_exclude']) { // 非互斥赠品需要判断门店
      
      $query['shop_id'] = $reward['shop_id'];
    
    }

    $view = new VMemberRewardsSv();
  
    return $view->findOne($query);
  
  }

  public function getMemberRewardsByRewardId($data) {
  
    $query = [];

    $query['reward_id'] = $data['reward_id'];

    $query['checked'] = 1;

    $vmSv = new VMemberRewardsSv();

    return $vmSv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);
  
  }

  public function getMemberCheckedMoneySum($data) {
  
    $mcmsSv = new VMemberCheckedMoneySumSv();
  
    return $mcmsSv->findOne([ 'member_id' => $data['member_id'] ]);

  }

  /**
   * 查询赠品实例详情
   */
  public function getDetail($data) {
  
    $vmrSv = new VMemberRewardsSv();
  
    return $vmrSv->findOne( ['id' => $data['id']] );
  
  } 

  public function censusCheck($data) {

    $vmrSv = new VMemberRewardsSv();
  
    $checkedRewards = $vmrSv->all([ 'reward_id' => $data['reward_id'], 'checked' => 1 ]);

    $todayIncome = 0;

    $todayChecked = 0;

    $totalIncome = 0;

    $totalChecked = 0;

    $today = strtotime(date('Y-m-d'));

    foreach($checkedRewards as $checkedReward) {
    
      $checkedAt = strtotime($checkedReward['checked_at']);

      if ($checkedAt > $today) {
      
        $todayIncome += $checkedReward['at_least'];

        $todayChecked += 1;
      
      }
    
      $totalIncome += $checkedReward['at_least'];

      $totalChecked += 1;
      
    }

    $data = [
    
      'today_income' => $todayIncome,
      'today_checked' => $todayChecked,
      'total_income' => $totalIncome,
      'total_checked' => $totalChecked
    
    ];

    return $data;

  }

  /**
   * 统计店铺总营收
   *
   */
  public function censusShop($data) {
  
    $cscSv = new VCensusShopCheckedRewardsSv();

    return $cscSv->findOne(['shop_id' => $data['shop_id']]);
  
  }

  public function checkMemberExistUsedReward($data) {

    $query = [
    
      'member_id' => $data['member_id'],

      'checked' => 1
    
    ];
  
    $num = $this->queryCount($query);

    return $num ? true : false; 
  
  }

  public function countUnusedByMemberId($data) {
  
    $query = [
    
      'member_id' => $data['member_id'],

      'checked' => 0
    
    ];
  
    return $this->queryCount($query);
  
  }

}
