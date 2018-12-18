<?php
namespace App\Domain;

use App\Service\Admin\RoleSv;

class RoleDm {

	protected $_rsv;

  public function __construct() {
  
    $this->_rsv = new RoleSv();
  
  }
	
	public function create($data) {

		return $this->_rsv->create($data);
	
	}

	public function getList($data) {

		return $this->_rsv->getList($data);

	}

	public function getAll($data) {

		return $this->_rsv->getAll($data);

	}

	public function edit($data) {

		return $this->_rsv->edit($data);

	}

	public function getDetail($data) {

		return $this->_rsv->getDetail($data);

	}

}