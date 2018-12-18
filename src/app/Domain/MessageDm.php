<?php
namespace App\Domain;

use App\Service\Crm\MessageSv;

class MessageDm {

  	protected $_msgSv;

  	public function __construct() {
  
    	$this->_msgSv = new MessageSv();
  
  	}
	
	public function addTmp($data) {

		return $this->_msgSv->addTmp($data);

	}

	public function tmpList($data) {

		return $this->_msgSv->tmpList($data);

	}

	public function sendMsg($data) {

		return $this->_msgSv->sendMsg($data);

	}

	public function batchSend($data) {

		return $this->_msgSv->batchSend($data);

	}

	public function getAll($data) {

		return $this->_msgSv->getAll($data);

	}

	public function sendList($data) {

		return $this->_msgSv->sendList($data);

	}

  public function remove($data) {
  
    return $this->_msgSv->remove($data['id']);
  
  }

}
