<?php
namespace App\Model;

class VShopList extends BaseModel {

  protected $_queryOptionRule = [
  
    'created_at' => 'range',

    'shop_name' => 'like'
  
  ];


}
