<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

class SalesChangeSv extends BaseService {
	
	use CurdSv;

	public function getList($data) {

		$query = [];

		if ($data['mid']) {

			$query['mid'] = $data['mid'];

		}

		if ($data['sales_id']) {

			$query['sales_id'] = $data['sales_id'];

		}

		if (isset($data['mname'])) {

			$query['mname'] = $data['mname'];

		}

		$svlsv = new VSalesChangeLogSv();

		return $svlsv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);

	}

}
