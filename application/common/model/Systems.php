<?php

namespace app\common\model;

use think\Db;
use think\Model;

class Systems extends Model
{
  protected $autoWriteTimestamp = true;

  /**
   * 根据角色英文编码显示对应中文角色名，分省级管理员，专家
   */
  public function getStatusAttr($value)
  
  {
    $arr = [0 => '禁用', 1 => '启用'];
    return $arr[$value];
  }
	
  
 
}
