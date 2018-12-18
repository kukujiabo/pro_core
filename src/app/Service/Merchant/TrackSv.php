<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

class TrackSv extends BaseService {

	use CurdSv;

	public function create($data) {

		$newData = [

			'mid' => $data['mid'],

			'content' => $data['content'],

			'created_at' => date('Y-m-d H:i:s')

		];

		return $this->add($newData);

	}


	public function listQuery($data) {

		$query = [];

		$or = '';

		if ($data['keywords']) {

			$keywords = $data['keywords'];

			$or = " content like '%{$keywords}%' or mname like '%{$keywords}%' or real_name like '%{$keywords}%' ";

		}

		$vtsv = new VTrackInfoSv();

		return $vtsv->queryList($query, $data['fields'], $data['order'], $data['page'], $data['page_size'], $or);

	}

}