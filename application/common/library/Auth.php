<?php

namespace app\common\library;

use app\common\model\User;
use think\Config;
use think\Db;
use think\Hook;
use think\Request;

class Auth
{

    protected static $instance = null;
    protected $_error = '';
    protected $_logined = FALSE;
    protected $_user = NULL;
    protected $_token = '';
    //Token默认有效时长
    protected $keeptime = 2592000;
    protected $requestUri = '';
    protected $rules = [];
    //默认配置
    protected $config = [];
    protected $options = [];
    protected $allowFields = ['id', 'username', 'mobile'];

    public function __construct($options = [])
    {
        if ($config = Config::get('user'))
        {
            $this->config = array_merge($this->config, $config);
        }
        $this->options = array_merge($this->config, $options);
    }

    /**
     *
     * @param array $options 参数
     * @return Auth
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance))
        {
            self::$instance = new static($options);
        }

        return self::$instance;
    }

    /**
     * 获取User模型
     * @return User
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * 兼容调用user模型的属性
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->_user ? $this->_user->$name : NULL;
    }

    /**
     * 根据Token初始化
     *
     * @param string       $token    Token
     * @return boolean
     */
    public function init($token)
    {
        if ($this->_logined)
        {
            return TRUE;
        }
        if ($this->_error)
            return FALSE;
        $data = Token::get($token);
        if (!$data)
        {
            return FALSE;
        }
        $user_id = intval($data['user_id']);
        if ($user_id > 0)
        {
            $user = User::get($user_id);
            if (!$user)
            {
                $this->setError('Account not exist');
                return FALSE;
            }
            if ($user['status'] != 'normal')
            {
                $this->setError('Account is locked');
                return FALSE;
            }
            $this->_user = $user;
            $this->_logined = TRUE;
            $this->_token = $token;

            //初始化成功的事件
            Hook::listen("user_init_successed", $this->_user);

            return TRUE;
        }
        else
        {
            $this->setError('You are not logged in');
            return FALSE;
        }
    }


    /**
     * 检测是否是否有对应权限
     * @param string $path      控制器/方法
     * @param string $module    模块 默认为当前模块
     * @return boolean
     */
    public function check($path = NULL, $module = NULL)
    {
        if (!$this->_logined)
            return false;

        $ruleList = $this->getRuleList();
        $rules = [];
        foreach ($ruleList as $k => $v)
        {
            $rules[] = $v['name'];
        }
        $url = ($module ? $module : request()->module()) . '/' . (is_null($path) ? $this->getRequestUri() : $path);
        $url = strtolower(str_replace('.', '/', $url));
        return in_array($url, $rules) ? TRUE : FALSE;
    }

    /**
     * 判断是否登录
     * @return boolean
     */
    public function isLogin()
    {
        if ($this->_logined)
        {
            return true;
        }
        return false;
    }

    /**
     * 获取当前Token
     * @return string
     */
    public function getToken()
    {
        return $this->_token;
    }

    /**
     * 获取会员基本信息
     */
    public function getUserinfo()
    {
        $data = $this->_user->toArray();
        $allowFields = $this->getAllowFields();
        $userinfo = array_intersect_key($data, array_flip($allowFields));
        $userinfo = array_merge($userinfo, Token::get($this->_token));
        return $userinfo;
    }


    /**
     * 获取当前请求的URI
     * @return string
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * 设置当前请求的URI
     * @param string $uri
     */
    public function setRequestUri($uri)
    {
        $this->requestUri = $uri;
    }

    /**
     * 获取允许输出的字段
     * @return array
     */
    public function getAllowFields()
    {
        return $this->allowFields;
    }

    /**
     * 设置允许输出的字段
     * @param array $fields
     */
    public function setAllowFields($fields)
    {
        $this->allowFields = $fields;
    }

    /**
     * 删除一个指定会员
     * @param int $user_id 会员ID
     * @return boolean
     */
    public function delete($user_id)
    {
        $user = User::get($user_id);
        if (!$user)
        {
            return FALSE;
        }

        // 调用事务删除账号
        $result = Db::transaction(function($db) use($user_id) {
                    // 删除会员
                    User::destroy($user_id);
                    // 删除会员指定的所有Token
                    Token::clear($user_id);
                    return TRUE;
                });
        if ($result)
        {
            Hook::listen("user_delete_successed", $user);
        }
        return $result ? TRUE : FALSE;
    }

    /**
     * 获取密码加密后的字符串
     * @param string $password  密码
     * @param string $salt      密码盐
     * @return string
     */
    public function getEncryptPassword($password, $salt = '')
    {
        return md5(md5($password) . $salt);
    }

    /**
     * 检测当前控制器和方法是否匹配传递的数组
     *
     * @param array $arr 需要验证权限的数组
     * @return boolean
     */
    public function match($arr = [])
    {
        $request = Request::instance();
        $arr = is_array($arr) ? $arr : explode(',', $arr);
        if (!$arr)
        {
            return FALSE;
        }
        $arr = array_map('strtolower', $arr);
        // 是否存在
        if (in_array(strtolower($request->action()), $arr) || in_array('*', $arr))
        {
            return TRUE;
        }

        // 没找到匹配
        return FALSE;
    }

    /**
     * 设置会话有效时间
     * @param int $keeptime 默认为永久
     */
    public function keeptime($keeptime = 0)
    {
        $this->keeptime = $keeptime;
    }

    /**
     * 渲染用户数据
     * @param array     $datalist   二维数组
     * @param mixed     $fields     加载的字段列表
     * @param string    $fieldkey   渲染的字段
     * @param string    $renderkey  结果字段
     * @return array
     */
    public function render(&$datalist, $fields = [], $fieldkey = 'user_id', $renderkey = 'userinfo')
    {
        $fields = !$fields ? ['id', 'username'] : (is_array($fields) ? $fields : explode(',', $fields));
        $ids = [];
        foreach ($datalist as $k => $v)
        {
            if (!isset($v[$fieldkey]))
                continue;
            $ids[] = $v[$fieldkey];
        }
        $list = [];
        if ($ids)
        {
            if (!in_array('id', $fields))
            {
                $fields[] = 'id';
            }
            $ids = array_unique($ids);
            $selectlist = User::where('id', 'in', $ids)->column($fields);
            foreach ($selectlist as $k => $v)
            {
                $list[$v['id']] = $v;
            }
        }
        foreach ($datalist as $k => &$v)
        {
            $v[$renderkey] = isset($list[$v[$fieldkey]]) ? $list[$v[$fieldkey]] : NULL;
        }
        unset($v);
        return $datalist;
    }

    /**
     * 设置错误信息
     *
     * @param $error 错误信息
     * @return Auth
     */
    public function setError($error)
    {
        $this->_error = $error;
        return $this;
    }

    /**
     * 获取错误信息
     * @return string
     */
    public function getError()
    {
        return $this->_error ? $this->_error : '';
    }

}
