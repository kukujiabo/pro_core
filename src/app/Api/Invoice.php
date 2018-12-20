<?php
namespace App\Api;

/**
 * 结算单接口
 *
 */
class Invoice extends BaseApi {
	
	public function getRules() {

		return $this->rules([

			'getList' => [

        'pv_code' => 'pv_code|string|false||单号',
        'begin_date' => 'begin_date|string|false||下单开始时间',
        'end_date' => 'end_date|string|false||下单结束时间',
        'ven_code' => 'ven_code|string|false||供应商编码',
        'dep_code' => 'dep_code|string|false||部门编码',
        'person_code' => 'person_code|string|false||业务员编码',
        'page' => 'page|int|false|1|页码',
        'page_size' => 'page_size|int|false|20|每页条数'

			],

			'getDetail' => [

				'pv_code' => 'pv_code|string|false||单号'

			]

		]);

	}

	/**
	 * 查询列表
	 * @desc 查询列表
	 *
	 * @return array list
	 */
	public function getList() {

		return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 查询详情
	 * @desc 查询详情
	 *
	 * @return array data
	 */
	public function getDetail() {

		return $this->dm->getDetail($this->retriveRuleParams(__FUNCTION__));

	}

}