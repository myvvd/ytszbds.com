<?php

namespace app\home\controller;

use app\common\controller\HomeBase;
use app\common\model\EntryWork;
use think\Image;
use think\Db;

/**
 * 申报入口.
 */
class Enroll extends HomeBase
{
    protected function initialize()
    {
        parent::initialize();
    }

    /**
     * 申报首页.
     */
    public function index()
    {   
      $cate = Db::name('category')
          ->order('sort ASC')
          ->field('id,title,create_time,ftitle')
          ->select();
            // var_dump($cate);die;
            $this->assign('cate', $cate);
        //查询城市种类
        $city = Db::name('cate')
          ->where('cateid = 7 and status = 0')
          ->order('sort ASC')
          ->select();

        $this->assign('city', $city);
        //查询申报种类
        $shenb = Db::name('cate')
          ->where('cateid = 9 and status = 0')
          ->order('sort ASC')
          ->select();

        $this->assign('shenb', $shenb);

        //查询申报种类
        $duix = Db::name('cate')
          ->where('cateid = 8 and status = 0')
          ->order('sort ASC')
          ->select();

        $this->assign('duix', $duix);

        //查询申报组别
        $zubie = Db::name('cate')
          ->where('cateid = 6 and status = 0')
          ->order('sort ASC')
          ->select();

        $this->assign('zubie', $zubie);

        $listcate = Db::name('cate')
            ->where('status = 0')
            ->select();
            
        $this->assign('listcate', $listcate);
        if (empty($this->uid)) {
           
            $this->redirect('/reg');
            
        }
        
        return $this->fetch();
    }

    /**
     * 保存申报登记.
     */
    public function save($data = [])
    {
        // $this->error('抱歉，当前日期已过提交作品阶段，无法提交新作品');
        if (false === $this->request->isPost()) {
            $this->error('非法请求');
        }

        $model = new EntryWork();
        $data['submitto'] = input('submitto/d');



        // 获取编号,新提交且无编号时新生成编号
        if ($data['submitto'] == 1 && empty($data['workcode'])) {

         
            //查询地区的别名
            $city = Db::name('cate')->where('id',$data['city'])->field('ftitle')->find();
            $city = $city['ftitle'];
            //查询参数对象别名
            $contestants = Db::name('cate')->where('id',$data['contestants'])->field('ftitle')->find();
            $contestants = $contestants['ftitle'];
            //查询申报组别别名
            $declaration_group = Db::name('cate')->where('id',$data['declaration_group'])->field('ftitle')->find();
            $declaration_group = $declaration_group['ftitle'];
            //查询作品类别别名
            $works_category = Db::name('cate')->where('id',$data['works_category'])->field('ftitle')->find();
            $worksCategory = $works_category['ftitle'];
            //将id转换成拼接字符
            
            $res = $model->where('works_category', '=', $works_category['id'])->where('submitto', '=', 1)->count();
            $orderNo = str_pad($res + 1, 3, '0', STR_PAD_LEFT);
            $data['workcode'] = $worksCategory.$declaration_group.$city.$contestants.$orderNo;

        }
        

        if (isset(($data['id'])) && !empty($data['id'])) {


            unset($data['uid']);
            $submitto = $model->where('id', $data['id'])->field('submitto,checkstatus1')->find()->getData();
            if ($submitto['submitto'] == 1) {
                // 提交后再次选择暂存了的重新生成申报书
                // unset($data['submitto']); 提交后又暂存的改变submitto的值
                unset($data['workcode']);
            }
            if ($submitto['checkstatus1'] == -1) {
                $data['checkstatus1'] = 0;
            }
            $result = $model->allowField(true)->isUpdate(true)->save($data, ['id' => $data['id']]);
        } else {
            $result = $model->allowField(true)->isUpdate(false)->save($data);
        }

        if (false === $result) {
            $this->error($model->getError());
        }
        $this->success('提交成功', null, $model);
    }

    /**
     * 生成申报书.
     */
    public function generateDeclaration()
    {
        $id = input('id/d');

        if (empty($id)) {
            $this->error('参数错误');
        }
        pdf($id);
        $this->success('生成成功', null);
    }

    /**
     * 获取申报记录.
     */
    public function detail()
    {
        if (false === $this->request->isAjax()) {
            $this->error();
        }
        $id = input('id/d');
        if (empty($id)) {
            $id = 0;
        }

        $map = [];
        $map[] = ['id', '=', $id];
        if ($this->uid != 1) {
            $map[] = ['uid', '=', $this->uid];
        }

        $model = new EntryWork();
        $result = $model->where($map)->field('checkstatus1,check1_time,zj_audit1,zj_audit1_time,zj_audit2,zj_audit2_time,zj_audit3,zj_audit3_time', true)->find();
        if (!$result) {
            $this->success('ok', null);
        }

        $result = $result->getData();
        $result['completion_date'] = date('Y-m-d', $result['completion_date']);
        $this->success('ok', null, $result);
    }

    /**
     * 删除图片(清除本地图片).
     */
    public function delImg($data = [])
    {
        $path = (env('root_path').'public'.$data['url']);
        if (is_file($path)) {
          @unlink($path);
        }
        $thumbPath = get_thumb($path);
        if (is_file($thumbPath)) {
            @unlink($thumbPath);
        }
        if ($data['id']) {
            $model = new EntryWork();
            $field = $data['name'];
            $result = $model->where('id', $data['id'])->update([$field => '']);
            if ($result == 1) {
              $this->success('ok', null, $model);
            }
        }
    }

    /**
     * 承诺书.
     */
    public function agreement()
    {
      $cate = Db::name('category')
          ->order('sort ASC')
          ->field('id,title,create_time,ftitle')
          ->select();
            // var_dump($cate);die;
            $this->assign('cate', $cate);
        //查询城市种类
        $city = Db::name('cate')
          ->where('cateid = 7 and status = 0')
          ->order('sort ASC')
          ->select();

        $this->assign('city', $city);
        //查询申报种类
        $shenb = Db::name('cate')
          ->where('cateid = 9 and status = 0')
          ->order('sort ASC')
          ->select();

        $this->assign('shenb', $shenb);

        //查询申报种类
        $duix = Db::name('cate')
          ->where('cateid = 8 and status = 0')
          ->order('sort ASC')
          ->select();

        $this->assign('duix', $duix);

        //查询申报组别
        $zubie = Db::name('cate')
          ->where('cateid = 6 and status = 0')
          ->order('sort ASC')
          ->select();

        $this->assign('zubie', $zubie);

        $listcate = Db::name('cate')
            ->where('status = 0')
            ->select();
            
        $this->assign('listcate', $listcate);
        return $this->fetch();
    }

    /**
     * 公用保存上传图片.
     *
     * @param bool $createThumb 是否生成缩略图
     * @param int  $thumbWidth  缩略图宽度
     * @param int  $thumbHeight 缩略图高度
     */
    public function uploadImg($fileInputName = '', $createThumb = true, $thumbWidth = 400, $thumbHeight = 400)
    {
        if (false === $this->request->isPost()) {
            $this->error('请选择上传文件');
        }

        if (!empty($fileInputName)) {
            $file = $this->request->file($fileInputName);
        } else {
            $reqFiles = $this->request->file();
            if (is_null($reqFiles)) {
                $this->error('请选择上传文件');
            }
            $fileKey = array_keys($reqFiles);
            if (count($fileKey) < 1) {
                $this->error('请选择上传文件');
            }
            $file = $this->request->file($fileKey[0]);
        }
        if (cookie('uid') == 1) {
            $upload_path = 'extdata/';
        } else {
            $upload_path = 'uploads/';
        }
        $upload_path .= date('Ymd').'/';

        $fileInfo = $file->getInfo();
        $md5filename = md5_file($fileInfo['tmp_name']);
        $suffix = strtolower(pathinfo($fileInfo['name'], PATHINFO_EXTENSION));
        $specSaveName = $md5filename .'.'.$suffix;

        $allowExts = 'jpg,jpeg,png,pdf,ppt,pptx';
        $info = $file->validate(['ext' => $allowExts])->move($upload_path,$specSaveName);

        if (!$info) {
          return $this->result($file->getError(),500);
        }

        $filename = $upload_path.$info->getSaveName();
        $ext = substr($filename, strrpos($filename, '.'));

        if (!in_array($ext, ['.pdf', '.ppt', '.pptx']) && $createThumb) {
          $image = \think\Image::open($filename);
          $thumbName = \substr($filename, 0, strrpos($filename, '.')).'_s'.$ext;
          $image->thumb($thumbWidth, $thumbHeight)->save($thumbName);
        }

        $path = '/'.str_replace('\\', '/', $filename);
        $this->result($path);
    }

    /**
     * 生成参赛证
     *
     * @return void
     */
    public function createCertificate()
    {
      $id = input('id/d');
      if(!$id) {
        $this->error();
      }

      $model = new EntryWork();
      $result = $model->where('id',$id)->field('workcode,certificate_cards')->find();

      if(!$result['workcode']) {
        $this->error();
      }

      if(empty($result['certificate_cards'])){
        $image = Image::open('./static/images/cert-bg.jpg');
        $font = './static/simhei.ttf';
        $image->text($result['workcode'],$font,22,$color = '#00000000',$locate = Image::WATER_NORTHWEST, $offset = [795,100])->save('./certificate-cards/gc-'. $result['workcode'] .'.jpg');
        $model->where('id',$id)->update(['certificate_cards' => '/certificate-cards/gc-'. $result['workcode'] .'.jpg']);
      }

      $certificate_cards = $model->where('id',$id)->value('certificate_cards');
      $this->success('生成成功', null, $certificate_cards);
    }
}
