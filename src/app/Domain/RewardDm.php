<?php
namespace App\Domain;

use App\Service\Commodity\RewardSv;
use App\Service\Commodity\MemberRewardSv;
use App\Service\Commodity\ProjectStepSv;

class RewardDm {

  protected $rwdSv;

  public function __construct() {
  
    $this->rwdSv = new RewardSv();
  
  }

  public function create($data) {
  
    return $this->rwdSv->create($data); 
  
  }

  public function edit($data) {
  
    return $this->rwdSv->edit($data);
  
  }


  public function listQuery($data) {
  
    return $this->rwdSv->listQuery($data);
  
  }

  public function getDetail($data) {
  
    $detail = $this->rwdSv->getDetail($data);

    return $detail;

  }

  public function changeStep($data) {

    $this->rwdSv->update($data['id'], [ 'status' => $data['status'] ]);

    $pssv = new ProjectStepSv();

    return $pssv->add([ 'pid' => $data['id'], 'status' => $data['status'], 'created_at' => date('Y-m-d H:i:s'), 'opid' => $data['opid'] ]);
  
  }

}
