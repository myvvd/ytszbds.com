<?php
/*
 * @Description: 专家分组管理
 * @Author: sxg
 * @Date: 2020-04-20 15:30:44
 * @Last Editor: sxg
 * @LastEditTime: 2020-05-09 11:04:42
 */

namespace app\sysman\controller;

use app\common\model\ExpertGroup as Model;
use think\facade\Request;
use think\Validate;
use think\Db;


class ExpertGroup extends AdminBase
{
  public function initialize()
  {
    parent::initialize();
    if ($this->rolecode !== 'admin') {
      $this->error('无权访问');
    }
    $this->model = new Model();
  }

  public function index()
  {
    if (Request::isAjax()) {
      $list = $this->model->order('id desc')->select();
      foreach ($list as $key => $value) {
         foreach ($value['works_category'] as $k => $v) {
            $workcate[$key][] = Db::name('cate')->where('id','=',$v)->value('title');
            // $list[$key]['works_category'] = $workcate['title'];
         }
         $list[$key]['works_category'] = $workcate[$key];

      }

        foreach ($list as $key => $value1) {
            if ($value1['city_group'] != NULL) {
                $city_arr = explode(',',$value1['city_group']);
                foreach ($city_arr as $k => $val) {
                    $city[$key][] = Db::name('cate')->where('id','=',$val)->value('title');
                    // $list[$key]['works_category'] = $workcate['title'];
                }
                $list[$key]['city'] = $city[$key];
            }
        }

      $this->result($list);
    }

    return view();
  }

  public function edit()
  {
    $info = null;
    $id = input('get.id');
    $group = Db::name('cate')->where('cateid = 9')->select();
    if (!empty($id)) {
      
      $info = $this->model->field('id,name,works_category,city_group')->find($id);
      // var_dump($info);exit;
        $info['city_group'] = explode(',',$info['city_group']);
    }


    $city = Db::name('cate')->where('cateid = 7')->field('id,title')->select();
    $city = empty($city)? NULL :$city;

    $this->assign('info', json_encode($info));
    $this->assign('group', $group);
    $this->assign('city',$city);

    return $this->fetch();
  }

  public function save1()
  {
    $data = input('post.');
      $this->model->isUpdate(!empty($data['id']))->allowField(true)->save($data);
    $this->success('1', null, $this->model);
  }

  public function save(){
      $data = input('post.');
      $name = $data['name'];
      $works_category = implode(',',$data['works_category']);
      $city_group = empty($data['city_group'])?'':implode(',',$data['city_group']);
      $time = time();

      if ($data['id'] != ""){
          $sql = "update gc_expert_group set name = '$name',works_category = '$works_category',city_group = '$city_group',update_time = $time where id = ".$data['id'] ;
      }else{
          $sql = "insert into gc_expert_group set name = '$name',works_category = '$works_category',city_group = '$city_group',create_time = $time,update_time = $time" ;
      }
      Db::name('expert_group')->query($sql);
      $this->success('1', null, $this->model);
}

  public function del( $id=0)
  {
    if(empty($id)) {
      $this->error('传入参数错误');
    }
    $this->model->where('id',$id)->delete();
    $this->success();
  }
}
