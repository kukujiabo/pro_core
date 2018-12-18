<?php namespace App\Service\Merchant; 

use App\Service\BaseService;
use Core\Service\CurdSv;
use App\Service\Resource\ImageSv;
use App\Service\Components\Map\TXMapSv; 
use App\Service\Components\Wechat\WechatAppSv;
use App\Service\System\CommonRegionSv;

/**
 * 门店服务类
 *
 * @author Meroc Chen <398515393@qq.com> 2018-04-29
 */
class ShopSv extends BaseService {

  use CurdSv;

  /** 添加门店
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {
  
    /**
     * 新增门店数据
     */
    $newData = [
      'mid' => $data['mid'],
      'shop_code' => $data['shop_code'],
      'shop_name' => $data['shop_name'],
      'phone' => $data['phone'],
      'open_time' => $data['open_time'],
      'thumbnail' => $data['thumbnail'],
      'account' => $data['account'],
      'password' => $data['password'],
      'words' => $data['words'],
      'brief' => $data['brief'],
      'image_text' => $data['image_text'],
      'article_image' => $data['article_image'],
      'article_link' => $data['article_link'],
      'shop_address' => $data['shop_address'],
      'recommend_code' => $data['recommend_code'],
      'status' => $data['status'],
      'created_at' => date('Y-m-d H:i:s')
    ];

    $map = new TXMapSv();

    $titude = $map->getQqAddress($data['shop_address']);

    if($titude) {

      $newData['longtitude'] = $titude['result']['location']['lng'];
      $newData['latitude'] = $titude['result']['location']['lat'];
      $crsv = new CommonRegionSv();
      $city = $crsv->findOne([ 'name' => $titude['result']['address_components']['city'] ]);
      $district = $crsv->findOne([ 'name' => $titude['result']['address_components']['district'] ]);
      $newData['city_code'] = $city['id'];
      $newData['dist_code'] = $district['id'];
    
    }

    $shopId = $this->add($newData);

    /**
     * 新增门店轮播图
     */
    $carousel = json_decode($data['carousel'], true);

    if (!empty($carousel)) {
    
      $imgSv = new ImageSv();

      $imgSv->batchCreate($carousel, 4, $shopId);
    
    }

    return $shopId;
  
  }

  /**
   * 更新门店
   *
   * @param int id
   * @param array data
   *
   * @return int num
   */
  public function updateShop($id, $data) {
  
    $updateData = [];

    if (isset($data['mid'])) {
    
      $updateData['mid'] = $data['mid'];
    
    }
    if (isset($data['thumbnail'])) {
    
      $updateData['thumbnail'] = $data['thumbnail'];
    
    }
    if (isset($data['shop_code'])) {
    
      $updateData['shop_code'] = $data['shop_code'];
    
    }
    if (isset($data['shop_name'])) {
    
      $updateData['shop_name'] = $data['shop_name'];
    
    }
    if (isset($data['open_time'])) {
    
      $updateData['open_time'] = $data['open_time'];
    
    }
    if (isset($data['phone'])) {
    
      $updateData['phone'] = $data['phone'];
    
    }
    if (isset($data['account'])) {
    
      $updateData['account'] = $data['account'];
    
    }
    if (isset($data['password'])) {
    
      $updateData['password'] = $data['password'];
    
    }
    if (isset($data['recommend_code'])) {
    
      $updateData['recommend_code'] = $data['recommend_code'];
    
    }
    if (isset($data['brief'])) {
    
      $updateData['brief'] = $data['brief'];
    
    }
    if (isset($data['image_text'])) {
    
      $updateData['image_text'] = $data['image_text'];
    
    }
    if (isset($data['shop_address'])) {
    
      $updateData['shop_address'] = $data['shop_address'];
    
    }
    if (isset($data['status'])) {
    
      $updateData['status'] = $data['status'];
    
    }
    if (isset($data['article_link'])) {
    
      $updateData['article_link'] = $data['article_link'];
    
    }
    if (isset($data['article_image'])) {
    
      $updateData['article_image'] = $data['article_image'];
    
    }
    if (isset($data['words'])) {
    
      $updateData['words'] = $data['words'];
    
    }

    if ($data['carousel']) {

      $isv = new ImageSv();
    
      $carousel = json_decode($data['carousel'], true);

      $isv->batchDelete(4, $id);

      $isv->batchCreate($carousel, 4, $id);
    
    }

    $map = new TXMapSv();

    $titude = $map->getQqAddress($data['shop_address']);

    if($titude) {

      $updateData['longtitude'] = $titude['result']['location']['lng'];
      $updateData['latitude'] = $titude['result']['location']['lat'];
    
      $crsv = new CommonRegionSv();
      $city = $crsv->findOne([ 'name' => $titude['result']['address_components']['city'] ]);
      $district = $crsv->findOne([ 'name' => $titude['result']['address_components']['district'] ]);
      $updateData['city_code'] = $city['id'];
      $updateData['dist_code'] = $district['id'];

    }


    if (!empty($updateData)) {

      $this->update($id, $updateData);

    }

    return true;

  }

  /**
   * 查询门店列表
   *
   * @param array query
   * @param string fields
   * @param string order
   * @param int page
   * @param int pageSize
   *
   * @return array list
   */
  public function listQuery($query, $fields = '*', $order = 'id desc', $page = 1, $pageSize = 20) {

    $listSv = new VShopListSv(); 
  
    return $listSv->queryList($query, $fields, $order, $page, $pageSize);
  
  }

  /**
   * 查询门店详情
   *
   * @param int id
   *
   * @return array data
   */
  public function getDetail($id) {

    $shop = $this->findOne($id);

    $isv = new ImageSv();

    if (!$shop) {
    
      return $shop;
    
    }

    /**
     * 门店轮播，module = 4
     */
    $images = $isv->all(array('relat_id' => $id, 'module' => 4), 'id asc');
  
    $shop['carousel'] = $images;

    return $shop;

  }

  /**
   * 查询门店全部列表
   *
   * @param array data
   *
   * @return array list
   */
  public function getAll($data) {

    $query = [];
  
    if (isset($data['shop_name'])) {
    
      $query['shop_name'] = $data['shop_name'];
    
    }
    if (isset($data['shop_code'])) {
    
      $query['shop_code'] = $data['shop_code'];
    
    }
    if (isset($data['status'])) {
    
      $query['status'] = $data['status'];
    
    }
    if (isset($data['mid'])) {
    
      $query['mid'] = $data['mid'];
    
    }

    return $this->all($query, $data['order'], $data['fields']);
  
  }

  public function login($data) {
  
    $shopInfo = $this->findOne([ 'account' => $data['account'], 'password' => $data['password'] ]);

    if ($shopInfo) {

      $isv = new ImageSv();

      $images = $isv->all(array('relat_id' => $shopInfo['id'], 'module' => 4), 'id asc');

      $returnInfo = [
      
        'shop_id' => $shopInfo['id'],

        'thumbnail' => $shopInfo['thumbnail'],

        'shop_name' => $shopInfo['shop_name'],
      
        'banner' => $images[0]
      
      ];
  
      return $returnInfo;
      
    }

    return null;
  
  }

  public function getShopByRecommendCode($data) {
  
    return $this->findOne([ 'recommend_code' => $data['recommend_code'] ]);
  
  }

  public function countData($data) {

    $today = date('Y-m-d');
  
    $todayCount = $this->queryCount([ 'created_at' => "gt|{$today}" ]);

    $totalCount = $this->queryCount([]);

    $cntDat = [
    
      'today' => $todayCount,

      'total' => $totalCount
    
    ];

    return $cntDat;
  
  }

  public function removeShop($data) {
  
    return $this->remove($data['id']);
  
  }

  public function shopShareCode($data) {
  
    $wxSv = new WechatAppSv();

    $page = 'pages/shops/list/index';

    $scene = "shp{$data['shop_id']}_{$data['code']}_{$data['relat_id']}";

    $stream = $wxSv->getMiniTempCode($scene, $page, $data['width'], $data['auto_color'], $data['line_color'], $data['hyaline']);

    echo $stream;

    exit;
  
  }

}
