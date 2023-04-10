<?php

namespace app\common\model;

use think\Db;
use think\Model;

class ExpertGroup extends Model
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

  /**
   * 分组相应的类别名
   *
   * @return void
   */
  public function getWorksCategoryAttr($value)
  {
    return explode(',', $value);
  }

  public function setWorksCategoryAttr($value)
  {
    return implode(',', $value);
  }
}
