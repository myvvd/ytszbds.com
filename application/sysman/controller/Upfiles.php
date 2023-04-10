<?php

namespace app\sysman\controller;

use think\facade\Env;

class Upfiles extends AdminBase
{
  protected $img_validate_options = [
    'size' => 2097152,
    'ext' => 'jpg,gif,png,bmp,jpeg,JPG,PNG',
  ];

  /**
   * 公用上传文件
   */
  private function getUploadResult($dir = '')
  {
    $fileKey = array_keys(request()->file());
    $file = request()->file($fileKey['0']);

    // 移动路径
    $upload_path = 'uploads/' . $dir;
    $info = $file->validate($this->img_validate_options)->move($upload_path);
    return $info;
  }

  public function uploadimg($dir = '')
  {
    $info = $this->getUploadResult($dir);
    if ($info) {
      $path = str_replace('\\', '/', $info->getSaveName());
      $url = '/uploads/' . $path;
      $rtn = [
        'data' => ['src' => $url],
        'code' => 0,
        'msg' => '上传成功',
      ];
    } else {
      $rtn = ['code' => 1, 'msg' => '上传失败',];
    }
    echo json_encode($path);
    return $rtn;
  }


  /**
   * 后台：wangEditor.
   *
   * @return \think\response\Json
   */
  public function editUpload()
  {
    $info = $this->getUploadResult();
    if ($info) {
      $path = str_replace('\\', '/', $info->getSaveName());
      $result = ['errno' => 0, 'data' => ['/uploads/' . $path]];
    } else {
      $result = ['errno' => 1];
    }
    return json($result);
  }

  //多图上传
  public function upImages()
  {
    $fileKey = array_keys(request()->file());
    // 获取表单上传文件
    $file = request()->file($fileKey['0']);
    // 移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->validate(['ext' => 'jpg,png,gif,jpeg'])->move(Env::get('root_path') . 'public/uploads');
    if ($info) {
      $result['code'] = 0;
      $result['msg'] = '图片上传成功!';
      $path = str_replace('\\', '/', $info->getSaveName());
      $result['src'] = '/uploads/' . $path;

      return $result;
    } else {
      // 上传失败获取错误信息
      $result['code'] = 1;
      $result['msg'] = '图片上传失败!';

      return $result;
    }
  }

  /**
   * 后台：NKeditor.
   *
   * @return \think\response\Json
   */
  public function editimg()
  {
    $allowExtesions = array(
      'image' => 'gif,jpg,jpeg,png,bmp',
      'flash' => 'swf,flv',
      'media' => 'swf,flv,mp3,wav,wma,wmv,mid,avi,mpg,asf,rm,rmvb',
      'file' => 'doc,docx,xls,xlsx,ppt,htm,html,txt,zip,rar,gz,bz2,pdf',
    );
    // 获取上传文件表单字段名
    $fileKey = array_keys(request()->file());
    // 获取表单上传文件
    $file = request()->file($fileKey['0']);
    // 移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->validate(['ext' => $allowExtesions[input('fileType')]])->move('./uploads/news');
    if ($info) {
      $path = str_replace('\\', '/', $info->getSaveName());
      $url = '/uploads/news/' . $path;
      $result['code'] = '000';
      $result['message'] = '图片上传成功!';
      $result['data'] = ['url' => $url];

      return json($result);
    } else {
      // 上传失败获取错误信息
      $result['code'] = 001;
      $result['message'] = $file->getError();

      return json($result);
    }
  }
}
