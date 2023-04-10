<?php

namespace app\common\controller;

use think\Config;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\Image;
use think\Loader;
use think\Request;
use think\Response;

/**
 * API控制器基类.
 */
class Api
{
    /**
     * @var Request Request 实例
     */
    protected $request;

    /**
     * @var bool 验证失败是否抛出异常
     */
    protected $failException = false;

    /**
     * @var bool 是否批量验证
     */
    protected $batchValidate = false;

    /**
     * @var array 前置操作方法列表
     */
    protected $beforeActionList = [];

    /**
     * 无需登录的方法,同时也就不需要鉴权了.
     *
     * @var array
     */
    protected $noNeedLogin = [];

    /**
     * 无需鉴权的方法,但需要登录.
     *
     * @var array
     */
    protected $noNeedRight = [];

    /**
     * 默认响应输出类型,支持json/xml.
     *
     * @var string
     */
    protected $responseType = 'json';

    protected $clientInfo;
    protected $uid = 0;

    /**
     * 是否是后台提交的数据.
     */
    protected $isFromBackManagementSys = false;

    /**
     * 是否WEB前端提交.
     */
    protected $isFromFrontWeb = false;
    /**
     * 移动端访问
     */
    protected $isMobile = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected $isWxMini = false;

    /**
     * 构造方法.
     *
     * @param Request $request Request 对象
     */
    public function __construct(Request $request = null)
    {
        $this->request = is_null($request) ? Request::instance() : $request;

        // 20190613增加前台PC端用户普通验证
        if ('1' == $this->request->param('front')) {
            $this->uid = cookie('userid');
            $this->isFromFrontWeb = true;
            return;
        }
        //移动访问
        if ('1' == $this->request->param('mobile')) {
          $this->uid = cookie('userid');
          $this->isMobile = true;
          return;
        }
        //后台提交
        if ('1' == $this->request->param('frommgt')) {
            $this->isFromBackManagementSys = true;
            $this->uid = $this->request->param('userid');
            if (empty($this->uid)) {
                $this->uid = 1;
            }
        } else {
            //小程序访问
            $this->isFromBackManagementSys = false;
            $this->isWxMini = true;
            // 控制器初始化
            $this->_initialize();
            $this->uid = $this->clientInfo['id']; //id 即为uid
        }

        // 前置操作方法
        if ($this->beforeActionList) {
            foreach ($this->beforeActionList as $method => $options) {
                is_numeric($method) ?
                $this->beforeAction($options) :
                $this->beforeAction($method, $options);
            }
        }
    }

    /**
     * 初始化操作.
     */
    protected function _initialize()
    {
        //移除HTML标签
        $this->request->filter('strip_tags');

        $controllername = strtolower($this->request->controller());
        $actionname = strtolower($this->request->action());

        $path = str_replace('.', '/', $controllername) . '/' . $actionname;

        if (false === ($this->isFromBackManagementSys) && !in_array($path, config('allow_method'))) {
            //授权处理
            $oauth = app('app\api\controller\Oauth'); //tp5.1容器，直接绑定类到容器进行实例化
            return $this->clientInfo = $oauth->authenticate();
        }
    }

    /**
     * 操作成功返回的数据.
     *
     * @param string $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为1
     * @param string $url    返回url
     * @param string $type   输出类型
     * @param array  $header 发送的 Header 信息
     */
    protected function success($data = null, $msg = 'success', $code = 1,$type = null, array $header = [])
    {
        $this->result($msg, $data, $code, $type, $header);
    }

    /**
     * 操作失败返回的数据.
     *
     * @param string $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为0
     * @param string $type   输出类型
     * @param array  $header 发送的 Header 信息
     */
    protected function error($msg = 'error', $data = null, $code = 0, $type = null, array $header = [])
    {
        $this->result($msg, $data, $code, $type, $header);
    }

    /**
     * 返回封装后的 API 数据到客户端.
     *
     * @param mixed  $msg    提示信息
     * @param mixed  $data   要返回的数据
     * @param int    $code   错误码，默认为0
     * @param string $type   输出类型，支持json/xml/jsonp
     * @param array  $header 发送的 Header 信息
     *
     * @throws HttpResponseException
     */
    protected function result($msg, $data = null, $code = 0,$type = null, array $header = [])
    {
        $result = [
            'code' => $code,
            'msg' => $msg,
            'time' => $this->request->server('REQUEST_TIME'),
            'data' => $data,
        ];
        // 如果未设置类型则自动判断
        $type = $type ? $type : ($this->request->param(config('var_jsonp_handler')) ? 'jsonp' : $this->responseType);

        if (isset($header['statuscode'])) {
            $code = $header['statuscode'];
            unset($header['statuscode']);
        } else {
            //未设置状态码,根据code值判断
            $code = $code >= 1000 || $code < 200 ? 200 : $code;
        }
        $response = Response::create($result, $type, $code)->header($header);
        throw new HttpResponseException($response);
    }

    /**
     * 前置操作.
     *
     * @param string $method  前置操作方法名
     * @param array  $options 调用参数 ['only'=>[...]] 或者 ['except'=>[...]]
     */
    protected function beforeAction($method, $options = [])
    {
        if (isset($options['only'])) {
            if (is_string($options['only'])) {
                $options['only'] = explode(',', $options['only']);
            }

            if (!in_array($this->request->action(), $options['only'])) {
                return;
            }
        } elseif (isset($options['except'])) {
            if (is_string($options['except'])) {
                $options['except'] = explode(',', $options['except']);
            }

            if (in_array($this->request->action(), $options['except'])) {
                return;
            }
        }

        call_user_func([$this, $method]);
    }

    /**
     * 设置验证失败后是否抛出异常.
     *
     * @param bool $fail 是否抛出异常
     *
     * @return $this
     */
    protected function validateFailException($fail = true)
    {
        $this->failException = $fail;

        return $this;
    }

    /**
     * 验证数据.
     *
     * @param array        $data     数据
     * @param string|array $validate 验证器名或者验证规则数组
     * @param array        $message  提示信息
     * @param bool         $batch    是否批量验证
     * @param mixed        $callback 回调方法（闭包）
     *
     * @return array|string|true
     *
     * @throws ValidateException
     */
    protected function validate($data, $validate, $message = [], $batch = false, $callback = null)
    {
        if (is_array($validate)) {
            $v = Loader::validate();
            $v->rule($validate);
        } else {
            // 支持场景
            if (strpos($validate, '.')) {
                list($validate, $scene) = explode('.', $validate);
            }

            $v = Loader::validate($validate);

            !empty($scene) && $v->scene($scene);
        }

        // 批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }
        // 设置错误信息
        if (is_array($message)) {
            $v->message($message);
        }
        // 使用回调验证
        if ($callback && is_callable($callback)) {
            call_user_func_array($callback, [$v, &$data]);
        }

        if (!$v->check($data)) {
            if ($this->failException) {
                throw new ValidateException($v->getError());
            }

            return $v->getError();
        }

        return true;
    }

    /**
     * 加载模板输出
     * @access protected
     * @param  string $template 模板文件名
     * @param  array  $vars     模板输出变量
     * @param  array  $config   模板参数
     * @return mixed
     */
    protected function fetch($template = '', $vars = [], $config = [])
    {
        return $this->view->fetch($template, $vars, $config);
    }
    
    /**
     * 公用保存上传图片.
     *
     * @param bool $createThumb 是否生成缩略图
     * @param int  $thumbWidth  缩略图宽度
     * @param int  $thumbHeight 缩略图高度
     */
    protected function uploadImg($fileInputName = 'photos', $createThumb = true, $thumbWidth = 200, $thumbHeight = 200)
    {
        $photos = [];

        if (!empty($fileInputName)) {
            $files = $this->request->file($fileInputName);
        } else {
            $reqFiles = $this->request->file();
            $fileKey = array_keys($reqFiles);
            $files = $this->request->file($fileKey[0]);
        }
        if (!$files) {
            return $photos;
        }

        $upload_path = 'uploads/';

        if ('object' == gettype($files)) {
            $files = [$files];
        }
        foreach ($files as $key => $file) {
            $info = $file->validate(['ext' => 'jpg,png,gif,jpeg'])->move($upload_path);

            if ($info) {
                $filename = $upload_path . $info->getSaveName();
                $path = '/' . str_replace('\\', '/', $filename);
                array_push($photos, $path);

                if ($createThumb) {
                    $image = Image::open($filename);
                    $ext = substr($filename, strrpos($filename, '.'));
                    $thumbName = \substr($filename, 0, strrpos($filename, '.')) . '_s' . $ext;

                    //压缩图片
                    $image->thumb($thumbWidth, $thumbHeight)->save($thumbName);
                }
            }
        }

        return $photos;
    }
}
