<?php
namespace app\common\controller;

use think\Request;
use think\Validate;
use think\Exception;

class BaseValidate extends Validate
{

    public function goCheck($params)
    {
        // $request = Request::instance();
        // $params = $request->param();
        $result = $this->check($params);
        if (!$result) {
             throw new Exception("Error Processing Request", 1);

        }
    }

}
