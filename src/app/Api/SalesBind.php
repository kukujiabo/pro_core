<?php
namespace App\Api;

/**
 * 销售接口
 */
class SalesBind extends BaseApi {
	
	public function getRules() {

		return $this->rules([

			'getAll' => [


			]

		]);

	}

	/**
	 * 查询全部销售
	 * @desc 查询全部销售
	 *
	 * @return array list
	 */
	public function getAll() {

		return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));

	}

}