<?php
namespace App\Domain;

use App\Service\Commodity\ProjectStepSv;

class ProjectStepDm {

  protected $_pssv;

  public function __construct() {
  
    $this->_pssv = new ProjectStepSv();
  
  }

  public function getAll($data) {

    $query = [];

    if ($data['pid']) {
    
      $query['pid'] = $data['pid'];
    
    }
  
    return $this->_pssv->all($query);
  
  }

}
