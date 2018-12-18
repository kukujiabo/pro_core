<?php
namespace App\Api;

/**
 * 销售变更记录接口
 *
 *
 */
class SalesChange extends BaseApi {
	
	public function getRules() {

		return $this->rules([

			'getList' => [

				'mid' => 'mid|int|false||商户id',
				'sales_id' => 'sales_id|int|false||销售id',
				'mname' => 'mname|string|false||商户名称',
				'fields' => 'fields|string|false||查询字段',
				'order' => 'order|string|false|created_at desc|排序',
				'page' => 'page|int|false|1|页码',
				'page_size' => 'page_size|int|false|20|每页条数'

			]

		]);

	}

	/**
	 * 查询销售变更记录列表
	 * @desc 查询销售变更记录列表
	 *
	 * @return array data
	 */
	public function getList() {

		return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));

	}

}