<?php
namespace App\Domain;

use \App\Service\Merchant\TrackSv;

class TrackDm {

  protected $_merchant;

  public function __construct() {
  
    $this->_tksv = new TrackSv();


  }

	public function create($data) {

		return $this->_tksv->create($data);

	}	


	public function listQuery($data) {

		return $this->_tksv->listQuery($data);

	}


}