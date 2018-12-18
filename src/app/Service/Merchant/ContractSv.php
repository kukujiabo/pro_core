<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

class ContractSv extends BaseService {

	use CurdSv;
	
	public function create($data) {

		$newData = [

			'mid' => $data['mid'],

			'type' => $data['type'],

			'title' => $data['title'],

			'code' => $data['code'],

			'brief' => $data['brief'],

			'created_at' => date('Y-m-d H:i:s')

		];

		$msv = new MerchantSv();

		$msv->update($data['mid'], [ 'type' => $data['type'] ]);

		return $this->add($newData);

	}


	public function listQuery($data) {

		$query = [];

		$or = '';

		if ($data['keywords']) {

			$keywords = $data['keywords'];

			$or = " title like '%{$keywords}%' or code like '%{$keywords}%' or mname like '%{$keywords}%' or brief like '%{$keywords}%' ";

		}

		if (isset($data['type'])) {

      $query['type'] = $data['type'];

		}

    if (isset($data['start_date'])) {
    
      $query['created_at'] = "eg|{$data['start_date']};el|{$data['end_date']}"; 
    
    }

		$csv = new VContractInfoSv();

		return $csv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size'], $or);

	}

  public function getDetail($data) {
  
    return $this->findOne($data['id']);
  
  }

  public function edit($data) {
  
    $updateData = [];

    if ($data['title']) {
    
      $updateData['title'] = $data['title'];
    
    }
    if ($data['brief']) {
    
      $updateData['brief'] = $data['brief'];
    
    }
    if ($data['type']) {
    
      $updateData['type'] = $data['type'];
    
    }
    if ($data['mid']) {
    
      $updateData['mid'] = $data['mid'];
    
    }
    if ($data['code']) {
    
      $updateData['code'] = $data['code'];
    
    }
  
    return $this->update($data['id'], $updateData);
  
  }

}
