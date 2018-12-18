<?php
namespace App\Api;

/**
 *  合同接口
 *
 */
class Contract extends BaseApi {
	
	public function getRules() {

		return $this->rules([

      'getDetail' => [
      
        'id' => 'id|int|true||合同id' 
      
      ],

      'remove' => [

        'id' => 'id|int|true||合同id' 

      ],

      'edit' => [
      
				'id' => 'id|int|true||合同ID',

				'type' => 'type|int|false||合同类型',

				'mid' => 'mid|int|false||客户id',

				'code' => 'code|string|false||合同编号',

				'title' => 'title|string|false||合同标题',

				'brief'  => 'brief|string|false||说明',
      
      ],

			'create' => [

				'type' => 'type|int|true||合同类型',

				'mid' => 'mid|int|true||客户id',

				'code' => 'code|string|true||合同编号',

				'title' => 'title|string|true||合同标题',

				'brief'  => 'brief|string|false||说明',

			],

			'listQuery' => [

				'keywords' => 'keywords|string|false||关键字',

				'type' => 'type|int|false||分类',
        
				'start_date' => 'start_date|string|false||开始时间',
        
				'end_date' => 'end_date|string|false||结束时间',

				'fields' => 'fields|string|false||字段',

				'order' => 'order|string|false||排序',

				'page' => 'page|int|false||页码',

				'page_size' => 'page_size|int|false||每页条数'

			]

		]);

	}


	/**
	 * 添加合同
	 * @desc 添加合同
	 *
	 * @return int id
	 */
	public function create() {

		return $this->dm->create($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 查询合同列表
	 * @desc 查询合同列表
	 *
	 * @return array list
	 */
	public function listQuery() {

		return $this->dm->listQuery($this->retriveRuleParams(__FUNCTION__));

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
   * 删除合同
   * @desc 删除合同
   *
   * @return int num
   */
  public function remove() {
  
    return $this->dm->remove($this->retriveRuleParams(__FUNCTION__)); 
  
  }

  /**
   * 编辑合同
   * @desc 编辑合同
   *
   * @return int num
   */
  public function edit() {
  
    return $this->dm->edit($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
