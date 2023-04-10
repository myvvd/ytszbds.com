<?php
namespace app\sysman\controller;

use app\common\model\User as UserModel;
use think\Db;

class User extends AdminBase
{
    //会员列表
    public function index()
    {
        if (request()->isPost()) {
            $key = input('post.key');
            $page = input('page') ? input('page') : 1;
            $pageSize = input('limit') ? input('limit') : config('pageSize');
            $startdate = input('post.startdate');
            $enddate = input('post.enddate');
            $iscorp =input('post.is_corp');
            $map=[];
            if (!empty($key)) {
              $map[] = ['u.username', 'like', "%" . $key . "%"];
            }
            $time = input('time');//在后台首页点击传入today
            if ($time && $time ==='today') {
              $map[] = ['reg_time', '>', date('Y-m-d 00:00:00')];
            }
            if (!empty($startdate)) {
              $map[] = ['reg_time', '>', $startdate ];
            }
            if (!empty($enddate)) {
              $map[] = ['reg_time', '<', $enddate.' 23:59:59'];
            }
            if(isset($iscorp) && $iscorp != '-1'){
              $map[] = ['is_corp', '=',$iscorp];
            }
            $list = Db::name('user')->alias('u')
                ->join('corp c','c.userid=u.id','LEFT')
                ->where($map)
                ->order('u.id desc')
                ->field('u.id,username,is_corp,u.province,u.city,c.id as corpid,corpname,u.reg_time,u.is_lock,sex,mobile,u.is_vip')
                ->paginate(array('list_rows' => $pageSize, 'page' => $page))
                ->toArray();
            return ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
        }
        return $this->fetch();
    }

    //设置会员状态
    public function usersState()
    {
        $id = input('post.id');
        $is_lock = input('post.is_lock');
        if (db('user')->where('id=' . $id)->update(['is_lock' => $is_lock]) !== false) {
            return ['status' => 1, 'msg' => '设置成功!'];
        } else {
            return ['status' => 0, 'msg' => '设置失败!'];
        }
    }

    //设置用户vip权限
    public function setVip()
    {
        $id = input('post.id');
        $is_vip = input('post.is_vip');

        $map[]= ['userid','in',$id];
        if ( $is_vip == 1) {
            Db::name('user')->where('id',$id)->update(['is_vip' => 1]);
            //修改该用户下数据权重(产品，供求)
            Db::name('product')->where($map)->update(['index_recommend_weigh' => 1000]);
            Db::name('gq')->where($map)->update(['index_recommend_weigh' => 1000]);
            return ['status' => 1, 'msg' => '设置成功!'];
        } else {
            Db::name('user')->where('id',$id)->update(['is_vip' => 0]);
            //修改该用户下数据权重(产品，供求)
            Db::name('product')->where($map)->update(['index_recommend_weigh' => 0]);
            Db::name('gq')->where($map)->update(['index_recommend_weigh' => 0]);
            return ['status' => 1, 'msg' => '设置成功!'];
        }
            return ['status' => 0, 'msg' => '设置失败!'];
    }

    public function edit($id = '')
    {
        if (request()->isPost()) {
            $user = db('user');
            $data = input('post.');
            $level = explode(':', $data['level']);
            $data['level'] = $level[1];
            $province = explode(':', $data['province']);
            $data['province'] = isset($province[1]) ? $province[1] : '';
            $city = explode(':', $data['city']);
            $data['city'] = isset($city[1]) ? $city[1] : '';
            $district = explode(':', $data['district']);
            $data['district'] = isset($district[1]) ? $district[1] : '';
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = md5($data['password']);
            }
            if ($user->update($data) !== false) {
                $result['msg'] = '会员修改成功!';
                $result['url'] = url('index');
                $result['code'] = 1;
            } else {
                $result['msg'] = '会员修改失败!';
                $result['code'] = 0;
            }
            return $result;
        } else {
            $province = db('Region')->where(array('pid' => 1))->select();
            $user_level = db('user_level')->order('sort')->select();
            $info = UserModel::get($id);
            $this->assign('info', json_encode($info, true));
            $this->assign('title', lang('edit') . lang('user'));
            $this->assign('province', json_encode($province, true));
            $this->assign('user_level', json_encode($user_level, true));

            $city = db('Region')->where(array('pid' => $info['province']))->select();
            $this->assign('city', json_encode($city, true));
            $district = db('Region')->where(array('pid' => $info['city']))->select();
            $this->assign('district', json_encode($district, true));
            return $this->fetch();
        }
    }

    public function del()
    {
        $id = input('id');
        Db::name('user')->delete(['id' =>$id ]);
        Db::name('corp')->delete(['userid' => $id] );
        Db::name('gq')->delete(['userid' => $id]);
        Db::name('product')->delete(['userid' => $id]);
        Db::name('user_fav')->delete(['userid' => $id]);
        Db::name('user_dial_log')->delete(['userid' => $id]);
        Db::name('search_history')->delete(['userid' => $id]);
        $result['msg'] = '删除成功！';
        $result['code'] = 1;
        $result['url'] = url('index');
        return $result;
    }

    public function delall()
    {
        $map[] = array('id', 'IN', input('param.ids/a'));
        $set[] = array('userid','IN',input('param.ids/a'));
        Db::name('user')->where($map)->delete();
        Db::name('corp')->where($set)->delete();
        Db::name('gq')->where($set)->delete();
        Db::name('product')->where($set)->delete();
        Db::name('user_fav')->where($set)->delete();
        Db::name('user_dial_log')->where($set)->delete();
        Db::name('search_history')->where($set)->delete();
        $result['msg'] = '删除成功！';
        $result['code'] = 1;
        $result['url'] = url('index');
        return $result;
    }

}
