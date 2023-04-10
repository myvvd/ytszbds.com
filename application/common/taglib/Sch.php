<?php

namespace app\common\taglib;

use think\template\TagLib;

/**
 * 自定义标签
 */
class Sch extends TagLib
{
  protected $tags = array(
    // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
    'close' => ['attr' => 'time,format', 'close' => 0], //闭合标签，默认为不闭合
    'open' => ['attr' => 'name,type', 'close' => 1],
  );

  /**
   * 这是一个闭合标签的简单演示
   */
  public function tagClose($tag)
  {
    $format = empty($tag['format']) ? 'Y-m-d H:i:s' : $tag['format'];
    $time = empty($tag['time']) ? time() : $tag['time'];
    $parse = '<?php ';
    $parse .= 'echo date("' . $format . '",' . $time . ');';
    $parse .= ' ?>';
    return $parse;
  }

  /**
   * 这是一个非闭合标签的简单演示
   */
  public function tagOpen($tag, $content)
  {
    $type = empty($tag['type']) ? 0 : 1; // 这个type目的是为了区分类型，一般来源是数据库
    $name = $tag['name']; // name是必填项，这里不做判断了
    $parse = '<?php ';
    $parse .= '$test_arr=[[1,3,5,7,9],[2,4,6,8,10]];'; // 这里是模拟数据
    $parse .= '$__LIST__ = $test_arr[' . $type . '];';
    $parse .= ' ?>';
    $parse .= '{volist name="__LIST__" id="' . $name . '"}';
    $parse .= $content;
    $parse .= '{/volist}';
    return $parse;
  }

  /**
   * 根据条件查询字段
   * @param $tag
   * @return string
   */
  public function tagTfield($tag)
  {
    $db = $tag['db']; //要查询的数据表
    $where = isset($tag['where']) ? $tag['where'] : ''; //查询条件
    $name = $tag['name'];
    $str = '<?php ';
    $str .= 'echo db("' . $db . '")->where("' . $where . '")->value("' . $name . '");';
    $str .= '?>';
    return $str;
  }

  /**
   * 根据条件查询一条数据
   * @param $attr
   * @param $content
   * @return string
   */
  public function tagTinfo($attr, $content)
  {
    $db = $attr['db']; //要查询的数据表
    $where = isset($attr['where']) ? $attr['where'] : ''; //查询条件
    $id = $attr['id'];
    $str = '<?php ';
    $str .= '$' . $id . ' =db("' . $db . '")->where("' . $where . '")->find();';
    $str .= '?>';
    $str .= $content;
    return $str;
  }
}
