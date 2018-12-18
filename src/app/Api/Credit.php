<?php
namespace App\Api;

/**
 * 信用额度接口
 *
 */
class Credit extends BaseApi {
	
  public function getRules() {

  	return $this->rules([

  		'create' => [

				'mid' => 'mid|int|true||客户id',
				'credit' => 'credit|float|true||信用额度',
				'start_date' => 'start_date|string|true||有效期开始时间',
				'end_date' => 'end_date|string|true||有效期结束时间'

  		],

  		'listQuery' => [

				'mid' => 'mid|int|false||客户id',
				'fields' => 'fields|string|false||字段',
				'order' => 'order|string|false||',
        'page' => 'page|int|false||页码',
        'page_size' => 'page_size|int|false||每页条数'


  		]

  	]);

  }

  /**
   * 新增额度
   * @desc 新建额度列表
   *
   * @return int id
   */
  public function create() {

  	return $this->dm->create($this->retriveRuleParams(__FUNCTION__));

  }

  /**
   * 查询额度列表
   * @desc 查询额度列表
   *
   * @return array list
   */
  public function listQuery() {

  	return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));

  }

}