<?php
namespace App\Service\Admin;

use App\Service\BaseService;
use App\Common\Traits\AuthTrait;
use App\Exception\LogException;
use App\Exception\ErrorCode;
use Core\Service\CurdSv;
use App\Library\RedisClient;

/**
 * 管理员服务
 *
 * @author Meroc Chen <398515393@qq.com> 2018-02-08
 */
class AdminSv extends BaseService {

  use CurdSv;

  use AuthTrait;

  protected $_acctName = 'account';

  protected $_secret = 'password';

  protected $_auth = 'auth_token';


  /**
   * 管理员登录
   *
   * @param string $account
   * @param string $password
   *
   * @return 
   */
  public function login($account, $password) {

    /**
     * 校验账号密码
     */
    $auth = $this->acctCheck($account, $password);
  
    if ($auth) {

      /**
       * 校验通过
       */
      $admin = $this->findOne(array($this->_acctName => $account));

      $roleSv = new RoleSv();

      $role = $roleSv->findOne($admin['role']);

      $sessionData = $this->createSession($admin['id'], 'admin_auth');

      $sessionData['role_auth'] = $role['auth'];

      /**
       * 返回访问令牌
       */

      return $sessionData['token'];

    } elseif ($auth === FALSE) {

      /**
       * 账号密码错误
       */
    
      throw new LogException($this->_err->APMISMSG, $this->_err->APMISCODE);
    
    } elseif ($auth === NULL) {

      /**
       * 账号不存在
       */
    
      throw new LogException($this->_err->AEPTMSG, $this->_err->AEPTCODE);
    
    }
  
  }

  public function listQuery($params) {

    $query = [];

    if ($params['admin_name']) {

      $query['admin_name'] = $params['admin_name'];

    }

    return $this->queryList($query, $params['fields'], $params['order'], $params['page'], $params['page_size']);

  }

  public function getDetail($params) {

    return $this->findOne($params['id']);

  }

  public function addAcct($params) {

    $newData = [

      'admin_name' => $params['admin_name'],

      'account' => $params['account'],

      'password' => md5($params['password']),

      'role' => $params['role'],

      'state' => 1,

      'created_at' => date('Y-m-d H:i:s')

    ];

    return $this->add($newData);

  }

  public function editAcct($params) {

    $id = $params['id'];

    $updateData = [];

    if ($params['admin_name']) {

      $updateData['admin_name'] = $params['admin_name'];
 
    }
    if ($params['account']) {

      $updateData['account'] = $params['account'];

    }
    if ($params['role']) {

      $updateData['role'] = $params['role'];

    }
    if ($params['password']) {

      $updateData['password'] = md5($params['password']);

    }

    return $this->update($id, $updateData);

  }

}
