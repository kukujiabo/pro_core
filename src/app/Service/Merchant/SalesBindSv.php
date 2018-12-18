<?php
namespace App\Service\Merchant;

use App\Service\BaseService;
use Core\Service\CurdSv;

class SalesBindSv extends BaseService {

	use CurdSv;

	public function getAll() {

		return $this->all([]);

	}


}