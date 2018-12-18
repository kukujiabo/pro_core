<?php
namespace App\Service\Crm;

use App\Service\BaseService;
use Core\Service\CurdSv;
use App\Service\System\ConfigSv;
use App\Service\Merchant\MerchantSv;

class MessageSv extends BaseService {

  use CurdSv;
	
  public function addTmp($data) {

    $newData = [

      'tp_name' => $data['tp_name'],

      'tp_code' => $data['tp_code'],

      'created_at' => date('Y-m-d H:i:s')

    ];

    return $this->add($newData);

  }

  public function tmpList($data) {

    $query = [];

    if ($data['tp_name']) {

      $query['tp_name'] = $data['tp_name'];

    }

    return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);

  }

  public function sendMsg($data) {

    $cfsv = new ConfigSv();

    $message_configs = array(

      'appid' => $cfsv->getConfig('submail_sms_appid'),

      'appkey' => $cfsv->getConfig('submail_sms_appkey'),

      'sign_type' => 'normal'

    );

    $submail = new \MESSAGEXsend($message_configs);

    $msv = new MerchantSv();

    $client = $msv->findOne($data['mid']);

    $submail->setTo($client['phone']);

    $submail->SetProject($data['tp_code']);

    if ($data['params']) {

      $vars = explode(',', $data['params']);

      foreach($vars as $var) {

        $varArr = explode('=', $var);

        $submail->AddVar($varArr[0], $varArr[1]); 
    
      }

    }

    return $submail->xsend();

  }
 
  public function sendList($data) {

    $cfsv = new ConfigSv();

    $message_configs = array(

      'appid' => $cfsv->getConfig('submail_sms_appid'),

      'appkey' => $cfsv->getConfig('submail_sms_appkey'),

      'sign_type' => 'normal'

    );

    $submail = new \MESSAGELog($message_configs);

    if ($data['page']) {

      $submail->setOffset($data['page'] * $data['page_size']);

      $submail->setRows($data['page_size']);

    }

    $submail->setStartDate($data['start']);

    $submail->setEndDate($data['end']);

    return $submail->log();


  }

  public function batchSend($data) {



  }

  public function getAll($data) {

    return $this->all([]);

  }

}