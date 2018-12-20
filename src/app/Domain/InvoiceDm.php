<?php
namespace App\Domain;

use App\Service\Order\InvoiceSv;

class InvoiceDm {

	protected $_isv;

	public function __construct() {

		$this->_isv = new InvoiceSv();

	}
	
	public function getList($data) {

		return $this->_isv->getList($data);

	}

	public function getDetail($data) {

		return $this->_isv->getDetail($data);

	}

}