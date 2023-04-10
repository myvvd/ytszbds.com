<?php
/*
 * @Description: 专家分组管理
 * @Author: sxg
 * @Date: 2020-04-20 15:30:44
 * @Last Editor: sxg
 * @LastEditTime: 2020-05-09 11:04:42
 */

namespace app\sysman\controller;

use app\common\model\Systems as Model;
use think\facade\Request;
use think\Validate;
use think\Db;

class Systems extends AdminBase
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
	 $info = null;
	 $id = 1;
     $arr = $this->model->find($id);
	 $info[$arr['en_name']] =  $arr['value'];
	 $info['id'] = 1;
	 $arr2 = $this->model->find(2);
	 $info['is_pdf'] =  $arr2['value'];
	 $this->assign('info', json_encode($info));
    return view();
  }

  public function edit()
  {
	  exit;
	  
	Db::name('systems')->insert(['name'=>'是否开启申报书','en_name'=>'is_pdf','value'=>0]);  exit;
    $info = null;
    $id = input('get.id');
    if (!empty($id)) {
      $info = $this->model->field('id,name,works_category')->find($id);
    }
    $this->assign('info', json_encode($info));
    return $this->fetch();
  }

  public function save()
  {
	
    $data = input('post.');
	
	if(empty($data['is_open'])){
		$value = 0;
	}else{
		$value = 1;
	}
	
	if(empty($data['is_pdf'])){
		$value2 = 0;
	}else{
		$value2 = 1;
	}
	
	//var_dump($data);
    $this->model->isUpdate(!empty($data['id']))->allowField(true)->save(['id'=>$data['id'],'value'=>$value]);
	
    Db::name('systems')->where("id=2")->update(['value'=>$value2]);
	//var_dump($this->model->getlastsql());exit;
    $this->success('1', null, $this->model);
  }

  public function del(int $id=0)
  {
    if(empty($id)) {
      $this->error('传入参数错误');
    }
    $this->model->where('id',$id)->delete();
    $this->success();
  }
}
