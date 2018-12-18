<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\service\CurdSv;

/**
 * 
 *
 */
class CreditSv extends BaseService {
	
	use CurdSv;

	public function create($data) {

		$newCredit = [

			'mid' => $data['mid'],
			'credit' => $data['credit'],
			'rest' => $data['credit'],
			'start_date' => $data['start_date'],
			'end_date' => $data['end_date'],
			'created_at' => date('Y-m-d H:i:s')

		];

		return $this->add($newCredit);

	}

	public function listQuery($data) {

		$query = [];

		if ($data['mid']) {

			$query['mid'] = $data['mid'];

		}

		$vcsv = new VCreditInfoSv();

		return $vcsv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);

	}

}