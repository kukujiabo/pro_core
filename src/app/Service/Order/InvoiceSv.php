<?php
namespace App\Service\Order;

use App\Library\Http;

class InvoiceSv {
	
	protected $_api = "http://58.247.168.34:8008/api/u8/interface/GetPurBillVouchList";


	public function getList($data) {

		$query = [];

		if ($data['pv_code']) {

			$query['cPBVCode'] = $data['pv_code'];

		}

   	if ($data['begin_date']) {

  		$query['BegindPODate'] = $data['begin_date'];

  	}

   	if ($data['end_date']) {

  		$query['EnddPODate'] = $data['end_date'];

  	}

   	if ($data['ven_code']) {

  		$query['cVenCode'] = $data['ven_code'];

  	}

   	if ($data['dep_code']) {

  		$query['cDepCode'] = $data['dep_code'];

  	}

		if ($data['person_code']) {

			$query['cPersonCode'] = $data['person_code'];

		}

   	if ($data['page']) {

  		$query['StartIndex'] = ($data['page'] - 1) * $data['page_size'];

  	}

    if ($data['page_size']) {

  		$query['LimitIndex'] = $data['page_size'];

  	}

  	$header = array( 'Content-Type:application/x-www-form-urlencoded;charset=utf-8' );

  	$response = Http::httpPost($this->_api, $query, $header);

  	return json_decode($response);

	}

	public function getDetail($data) {

		$query = [];

		if ($data['pv_code']) {

			$query['cPBVCode'] = $data['pv_code'];

		}

  	$header = array( 'Content-Type:application/x-www-form-urlencoded;charset=utf-8' );

  	$response = Http::httpPost($this->_api, $query, $header);

  	return json_decode($response);

	}

}