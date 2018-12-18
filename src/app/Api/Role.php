<?php
namespace App\Api;

/**
 * 角色接口
 *
 */
class Role extends BaseApi {
	
	public function getRules() {

		return $this->rules([

			'getDetail' => [

				'id' => 'id|int|true||查询角色详情'

			],

			'getList' => [

				'role_name' => 'role_name|string|false||角色名称',
				'fields' => 'fields|string|false||字段',
				'order' => 'order|string|false||排序',
				'page' => 'page|int|false|1|页码',
				'page_size' => 'page_size|int|false|20|每页条数'

			],

			'edit' => [

				'role_name' => 'role_name|string|false||角色名称',
				'auth' => 'auth|string|false||权限编码',
				'state' => 'state|int|false||角色状态'

			],

			'create' => [

				'role_name' => 'role_name|string|true||角色名称',
				'auth' => 'auth|string|true||权限编码',
				'role_desc' => 'role_desc|string|false||角色说明'

			],

			'getAll' => [

				'role_name' => 'role_name|string|false||角色名称',
				'fields' => 'fields|string|false||字段',
				'order' => 'order|string|false||排序'

			]

		]);

	}

	/**
	 * 创建角色
	 * @desc 创建角色
	 *
	 * @return int id
	 */
	public function create() {

		return $this->dm->create($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 查询角色列表
	 * @desc 查询角色列表
	 *
	 * @return array list
	 */
	public function getList() {

		return $this->dm->getList($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 编辑角色
	 * @desc 编辑角色
	 *
	 * @return int num
	 */
	public function edit() {

		return $this->dm->edit($this->retriveRuleParams(__FUCNTION__));

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

	/**
	 * 查询全部角色
	 * @desc 查询全部角色
	 *
	 * @return array list
	 */
	public function getAll() {
		
		return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));

	}

}