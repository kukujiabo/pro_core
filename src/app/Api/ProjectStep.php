<?php
namespace App\Api;

/**
 * 项目阶段日志接口
 *
 *
 */
class ProjectStep extends BaseApi {

  public function getRules() {
  
    return $this->rules([
    
      'getAll' => [
      
        'pid' => 'pid|int|false||项目id'
      
      ]
    
    ]);
  
  }

  /**
   * 根据条件查询全部阶段修改日志
   * @desc 根据条件查询全部阶段修改日志
   *
   * @return array data
   */
  public function getAll() {
  
    return $this->dm->getAll($this->retriveRuleParams(__FUNCTION__)); 
  
  }

}
