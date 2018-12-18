<?php
namespace App\Service\Admin;

use App\Service\BaseService;
use Core\Service\CurdSv;

class RoleSv extends BaseService {
	
	use CurdSv;

	public function create($data) {

		$newRole = [

			'role_name' => $data['role_name'],
			'auth' => $data['auth'],
			'role_desc' => $data['role_desc'],
			'state' => 1,
			'created_at' => date('Y-m-d H:i:s')

		];

		return $this->add($newRole);

	}

	public function edit($data) {

		$updateData = [];

		if (isset($data['auth'])) {

			$updateData['auth'] = $data['auth'];

		}
		if (isset($data['state'])) {

			$updateData['state'] = $data['state'];

		}
		if (isset($data['role_desc'])) {

			$updateData['role_desc'] = $data['role_desc'];

		}

		return $this->update($data['id'], $updateData);

	}

	public function getDetail($data) {

		return $this->findOne($data['id']);

	}

	public function getAll($data) {

		$query = [];

		if ($data['role_name']) {

			$query['role_name'] = $data['role_name'];

		}

		return $this->all($query, $data['order'], $data['fields']);

	}

	public function getList($data) {

		$query = [];

		if ($data['role_name']) {

			$query['role_name'] = $data['role_name'];

		}

		return $this->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size']);

	}

}