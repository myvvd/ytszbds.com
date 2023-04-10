<?php

namespace app\sysman\controller;

use think\Db;
use think\Request;

class Webset extends AdminBase
{
	public function initialize()
  {
    parent::initialize();
  }


  /**
   * 显示编辑页面
   *
   * @param string $id
   */
  public function edit($id = 1)
  {
    $record = null;

    if (!empty($id)) {
      $record = Db::name('web_set')->find($id);
    }	$this->assign('info', json_encode($record));	return $this->fetch();
  }

  /**
   * 执行保存
   */
  public function save()
  {
  		$data = input('post.');	
		
		unset($data['file']);
		Db::name('web_set')->update($data);		
		
		$this->success('保存成功','webset/edit');			
  }

  //删除
  

  //图片上传
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
       
		$upload_path = 'uploads/';
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

}