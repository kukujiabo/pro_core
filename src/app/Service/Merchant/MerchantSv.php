<?php
namespace App\Service\Merchant;

use Core\Service\CurdSv;
use App\Service\BaseService;
use App\Service\Components\Qiniu\QiniuSv;
use App\Service\Components\Wechat\WechatAppSv;
use App\Service\Resource\ImageSv;

/**
 * 客户服务类
 *
 * @author Meroc Chen <398515393@qq.com> 2018-04-28
 */
class MerchantSv extends BaseService {

  use CurdSv;


  /**
   * 添加商户
   *
   * @param array data
   *
   * @return int id
   */
  public function create($data) {

    /**
     * 新增商家数据
     */
    $newData = [
      'mcode' => $data['mcode'],
      'mname' => $data['mname'],
      'phone' => $data['phone'],
      'brief' => $data['brief'],
      'sales_id' => $data['sales_id'],
      'ext_1' => $data['ext_1'],
      'status' => $data['status'],
      'type' => 1,
      'created_at' => date('Y-m-d H:i:s')
    ];

    return $this->add($newData);
  
  }

  /**
   * 更新商户
   *
   * @param int id
   * @param array data
   *
   * @return int num
   */
  public function edit($id, $data) {

    $editData = [];

    if (isset($data['mname'])) {
    
      $editData['mname'] = $data['mname'];
    
    }
    if (isset($data['phone'])) {
    
      $editData['phone'] = $data['phone'];
    
    }
    if (isset($data['ext_1'])) {
    
      $editData['ext_1'] = $data['ext_1'];
    
    }
    if (isset($data['status'])) {
    
      $editData['status'] = $data['status'];
    
    }
    if (isset($data['sales_id'])) {
    
      $editData['sales_id'] = $data['sales_id'];
    
    }

    return $this->update($id, $editData);
  
  }

  /**
   * 查询全部商户
   *
   * @param
   *
   * @return array list
   */
  public function getAll($query, $order, $fields) {
  
    return $this->all($query, $order, $fields);
  
  }

  public function listQuery($data) {

    $page = $data['page'];

    $pageSize = $data['page_size'];

    $order = $data['order'];

    $query = [];

    $or = '';

    if ($data['keywords']) {

      $keywords = $data['keywords'];

      $or = " real_name like '%{$keywords}%' or sales_phone like '%{$keywords}%' or phone like '%{$keywords}%' or mname like '%{$keywords}%' or ext_1 like '%{$keywords}%' ";

    }

    if (isset($data['cType'])) {
    
      $query['type'] = $data['cType'];
    
    }

    if (isset($data['status'])) {
    
      $query['status'] = $data['status'];
    
    }

    if ($data['start_date']) {
    
      $query['created_at'] = "eg|{$data['start_date']};el|{$data['end_date']}";
    
    }

    $vmsv = new VSalesMerchantSv();

    return $vmsv->queryList($query, $fields, $order, $page, $pageSize, $or);

  }
 
  /**
   * 商户详情
   *
   * @param int id
   *
   * @return 
   */
  public function getDetail($id) {
  
    return $this->findOne($id); 

  }

}
