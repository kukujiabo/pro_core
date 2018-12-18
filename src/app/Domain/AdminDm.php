<?php
namespace App\Domain;

use App\Service\Admin\AdminSv;
use App\Service\Admin\RoleSv;

/**
 * 管理员处理域
 *
 * @author Meroc Chen <398515393@qq.com> 2018-03-02
 */
class AdminDm {

  protected $_asv;

  public function __construct() {
  
    $this->_asv = new AdminSv();
  
  }

  /**
   * 管理员登录
   */
  public function login($params) {
  
    return $this->_asv->login($params['account'], $params['password']);
  
  }

  /**
   * 获取当前会话管理员信息
   */
  public function sessionAdminInfo($params) {

    $id = $params['id'];
  
    $info = $this->_asv->findOne($id);

    if (empty($info)) {
    
      return NULL;
    
    } else {

      $rsv = new RoleSv();

      $role = $rsv->findOne($info['role']);
    
      $adminInfo = [
      
        'name' => $info['admin_name'],

        'avatar' => $info['avatar'],

        'roles' => ['admin'],

        'auth' => $role['auth']
      
      ];

      return $adminInfo;
    
    }
  
  }

  public function addAcct($params) {

    return $this->_asv->addAcct($params);

  }

  public function listQuery($params) {

    return $this->_asv->listQuery($params);

  }

  public function getDetail($params) {

    return $this->_asv->getDetail($params);

  }

  public function editAcct($params) {

    return $this->_asv->editAcct($params);

  }

}
