<?php

namespace app\common\model;

use think\Model;

class ModelBase extends Model
{
  protected $cacheName = '';

  public function initialzie()
  {
    $this->cacheName = get_class();
  }
}
