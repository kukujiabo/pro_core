<?php
namespace App\Api;

/**
 * 短信相关接口 
 */
class Message extends BaseApi {
	
	public function getRules() {

		return $this->rules([

			'addTmp' => [

				'tp_name' => 'tp_name|string|true||模版名称',

				'tp_code' => 'tp_code|string|true||模版编码'

			],

			'tmpList' => [

				'tp_name' => 'tp_name|string|false||模版名称',

				'fields' => 'fields|string|false||字段',

				'order' => 'order|string|false||排序',

				'page' => 'page|int|false|1|页码',

				'page_size' => 'page_size|int|false|20|每页条数'

			],

			'sendMsg' => [

				'tp_code' => 'tp_code|string|true||模版编码',

				'mid' => 'mid|int|true||客户id',

				'params' => 'params|string|false||参数'

			],

			'batchSend' => [

				'mobiles' => 'mobiles|string|true||手机号码',

				'mid' => 'mid|int|true||客户id',

				'params' => 'params|string|false||参数'

			],

			'sendList' => [

				'start' => 'start|string|true||起始时间',
				'end' => 'end|string|true||结束时间',
				'page' => 'page|int|true|1|页码',
				'page_size' => 'page|int|true|20|每页条数'

			],

			'getAll' => [



      ],

      'remove' => [
      
        'id' => 'id|int|true||模版id'
      
      ]

		]);

	}

	/**
	 * 添加模版
	 * @desc 添加模版
	 *
	 * @return int id
	 */
	public function addTmp() {

		return $this->dm->addTmp($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 模版列表
	 * @desc 模版列表
	 *
	 * @return array list
	 */
	public function tmpList() {

		return $this->dm->tmpList($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 发送短信
	 * @desc 发送短信
	 *
	 * @return int num
	 */
	public function sendMsg() {

		return $this->dm->sendMsg($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 批量发送短信
	 * @desc 批量发送短信
	 *
	 * @return int num
	 */
	public function batchSend() {

		return $this->dm->batchSend($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 查询发送短信列表
	 * @查询发送短信列表
	 * 
	 * @return array list
	 */
	public function sendList() {

		return $this->dm->sendList($this->retriveRuleParams(__FUNCTION__));

	}

	/**
	 * 查询全部短信
	 * @desc 查询全部短信
   *
   * @return array list
	 */
	public function getAll() {

		return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__));

	}

  /**
   * 删除短信 
   * @desc 删除短信
   *
   * @return int id
   */
  public function remove() {
  
    return $this->dm->remove($this->retriveRuleParams(__FUNCTION__));
  
  }

}
