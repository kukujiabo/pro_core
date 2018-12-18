<?php
namespace App\Api;

/**
 * 客户跟踪接口
 *
 */
class Track extends BaseApi {
	
	public function getRules() {

		return $this->rules([

			'create' => [

				'mid' => 'mid|int|true||商户id',

				'content' => 'content|string|true||跟踪内容'

			],
 
			'listQuery' => [

				'keywords' => 'keywords|string|false||关键字',
				'fields' => 'fields|string|false||字段',
				'order' => 'order|string|false||排序',
				'page' => 'page|int|false||页码',
				'page_size' => 'page_size|int|false||每页条数'

			]

		]);

	}

	/**
	 * 新增跟踪记录
	 * @desc 新增跟踪记录
	 *
	 * @return int id
	 */
	public function create() {

		return $this->dm->create($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 查询记录列表
	 * @desc 查询记录列表
	 *
	 * @return array list
	 */
	public function listQuery() {

		return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));

	}

}