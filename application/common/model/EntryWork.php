<?php

namespace app\common\model;

use think\Model;

class EntryWork extends Model
{
  protected $autoWriteTimestamp = true;

  public function getCreateTimeAttr($value)
  {
    return date('Y-m-d H:i', $value);
  }

  public function getCompletionDateAttr($value)
  {
    return date('Y-m-d', $value);
  }

  public function setCompletionDateAttr($value)
  {
    return strtotime($value);
  }

  public function getCityAttr($value)
  {
    $arr = ['01' => '青岛', '02' => '济南', '03' => '烟台', '04' => '潍坊', '05' => '临沂', '06' => '济宁', '07' => '淄博', '08' => '菏泽', '09' => '德州', '10' => '威海', '11' => '东营', '12' => '泰安', '13' => '滨州', '14' => '聊城', '15' => '日照', '16' => '枣庄',];
    if (isset($arr[$value])) {
      return $arr[$value];
    } else {
      return '未填写';
    }
  }

  /**
   * 申报组别，产品组or概念组
   */
  public function getDeclarationGroupAttr($value)
  {
    $arr = ['C' => '产品组', 'G' => '概念组'];
    if (isset($arr[$value])) {
      return $arr[$value];
    } else {
      return '未填写';
    }
  }


  /**
   * 申报组别，产品组or概念组
   */
  public function getWorksCategoryAttr($value)
  {
    $arr = ['A' => '机械装备', 'B' => '交通工具', 'C' => '五金制品', 'D' => '智能机器人', 'E' => '智能终端', 'F' => '电子信息及通讯产品', 'G' => '家用电器', 'H' => '家居与家具', 'I' => '办公用品', 'J' => '特殊人群和特种领域用品', 'K' => '医疗健康和应急防护产品', 'L' => '纺织服饰', 'M' => '新材料及新工艺', 'N' => '包装', 'O' => '城市公共设施', 'P' => '旅游文创', 'Q' => '农业及海洋产业', 'R' => '食品', 'S' => '乡村振兴', 'T' => '信息化大数据平台',];
    if (isset($arr[$value])) {
      return $arr[$value];
    } else {
      return '未填写';
    }
  }

  /**
   * 参赛对象
   */
  public function getContestantsAttr($value)
  {
    $arr = ['1' => '企业工业设计中心', '2' => '高等院校', '3' => '企事业单位', '4' => '设计机构', '5' => '社会团体', '6' => '个人'];
    if (isset($arr[$value])) {
      return $arr[$value];
    } else {
      return '未填写';
    }
  }

  /**
   * 初审状态
   */
  public function getCheckstatus1Attr($value)
  {
    $arr = [0 => '待审', 1 => '已通过', -1 => '被驳回'];
    return $arr[$value];
  }

  //初评阶段汇总得分
  public function gradeChusai()
  {
    return $this->hasMany('Grade', 'work_id');
  }
  //复评阶段汇总得分
  public function gradeFusai()
  {
    return $this->hasMany('GradeFusai', 'work_id');
  }
  //终评阶段汇总得分
  public function gradeFinal()
  {
    return $this->hasMany('GradeFinal', 'work_id');
  }
}
