<?php

use think\Db;
use think\Model;
use think\facade\Env;

require_once __DIR__ . '/../vendor/tecnickcom/tcpdf/tcpdf.php';

//文件单位换算
function byte_format($input, $dec = 0)
{
  $prefix_arr = array('B', 'KB', 'MB', 'GB', 'TB');
  $value = round($input, $dec);
  $i = 0;
  while ($value > 1024) {
    $value /= 1024;
    ++$i;
  }
  $return_str = round($value, $dec) . $prefix_arr[$i];

  return $return_str;
}

//时间日期转换
function toDate($time, $format = 'Y-m-d H:i:s')
{
  if (empty($time)) {
    return '';
  }
  $format = str_replace('#', ':', $format);

  return date($format, $time);
}

if (!function_exists('datetime')) {
  /**
   * 将时间戳转换为日期时间.
   *
   * @param int    $time   时间戳
   * @param string $format 日期时间格式
   *
   * @return string
   */
  function datetime($time = 'now', $format = 'Y-m-d H:i:s')
  {
    $time = is_numeric($time) ? $time : strtotime($time);

    return date($format, $time);
  }
}


/**
+----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合.
+----------------------------------------------------------
 * @param string $len      长度
 * @param string $type     字串类型
 *                         0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
+----------------------------------------------------------
 * @return string
+----------------------------------------------------------
 */
function rand_string($len = 6, $type = '', $addChars = '')
{
  $str = '';
  switch ($type) {
    case 0:
      $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
      break;
    case 1:
      $chars = str_repeat('0123456789', 3);
      break;
    case 2:
      $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
      break;
    case 3:
      $chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
      break;
    case 4:
      $chars = '们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借' . $addChars;
      break;
    default:
      // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
      $chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
      break;
  }
  if ($len > 10) { //位数过长重复字符串一定次数
    $chars = 1 == $type ? str_repeat($chars, $len) : str_repeat($chars, 5);
  }
  if (4 != $type) {
    $chars = str_shuffle($chars);
    $str = substr($chars, 0, $len);
  } else {
    // 中文随机字
    for ($i = 0; $i < $len; ++$i) {
      $str .= mb_substr($chars, floor(mt_rand(0, mb_strlen($chars, 'utf-8') - 1)), 1);
    }
  }

  return $str;
}


//字符串截取
function str_cut($sourcestr, $cutlength, $suffix = '...')
{
  $returnstr = '';
  $i = 0;
  $n = 0;
  $str_length = strlen($sourcestr); //字符串的字节数
  while (($n < $cutlength) and ($i <= $str_length)) {
    $temp_str = substr($sourcestr, $i, 1);
    $ascnum = ord($temp_str); //得到字符串中第$i位字符的ascii码
    if ($ascnum >= 224) { //如果ASCII位高与224，
      $returnstr = $returnstr . substr($sourcestr, $i, 3); //根据UTF-8编码规范，将3个连续的字符计为单个字符
      $i = $i + 3; //实际Byte计为3
      ++$n; //字串长度计1
    } elseif ($ascnum >= 192) { //如果ASCII位高与192，
      $returnstr = $returnstr . substr($sourcestr, $i, 2); //根据UTF-8编码规范，将2个连续的字符计为单个字符
      $i = $i + 2; //实际Byte计为2
      ++$n; //字串长度计1
    } elseif ($ascnum >= 65 && $ascnum <= 90) { //如果是大写字母，
      $returnstr = $returnstr . substr($sourcestr, $i, 1);
      $i = $i + 1; //实际的Byte数仍计1个
      ++$n; //但考虑整体美观，大写字母计成一个高位字符
    } else { //其他情况下，包括小写字母和半角标点符号，
      $returnstr = $returnstr . substr($sourcestr, $i, 1);
      $i = $i + 1; //实际的Byte数计1个
      $n = $n + 0.5; //小写字母和半角标点等与半个高位字符宽...
    }
  }
  if ($n > $cutlength) {
    $returnstr = $returnstr . $suffix; //超过长度时在尾处加上省略号
  }

  return $returnstr;
}

/**
 * 过滤数组元素前后空格 (支持多维数组).
 *
 * @param $array 要过滤的数组
 *
 * @return array|string
 */
function trim_array_element($array)
{
  if (!is_array($array)) {
    return trim($array);
  }

  return array_map('trim_array_element', $array);
}

function safe_html($html)
{
  $elements = [
    'html' => [],
    'body' => [],
    'a' => ['target', 'href', 'title', 'class', 'style'],
    'abbr' => ['title', 'class', 'style'],
    'address' => ['class', 'style'],
    'area' => ['shape', 'coords', 'href', 'alt'],
    'article' => [],
    'aside' => [],
    'audio' => ['autoplay', 'controls', 'loop', 'preload', 'src', 'class', 'style'],
    'b' => ['class', 'style'],
    'bdi' => ['dir'],
    'bdo' => ['dir'],
    'big' => [],
    'blockquote' => ['cite', 'class', 'style'],
    'br' => [],
    'caption' => ['class', 'style'],
    'center' => [],
    'cite' => [],
    'code' => ['class', 'style'],
    'col' => ['align', 'valign', 'span', 'width', 'class', 'style'],
    'colgroup' => ['align', 'valign', 'span', 'width', 'class', 'style'],
    'dd' => ['class', 'style'],
    'del' => ['datetime'],
    'details' => ['open'],
    'div' => ['class', 'style'],
    'dl' => ['class', 'style'],
    'dt' => ['class', 'style'],
    'em' => ['class', 'style'],
    'font' => ['color', 'size', 'face'],
    'footer' => [],
    'h1' => ['class', 'style'],
    'h2' => ['class', 'style'],
    'h3' => ['class', 'style'],
    'h4' => ['class', 'style'],
    'h5' => ['class', 'style'],
    'h6' => ['class', 'style'],
    'header' => [],
    'hr' => [],
    'i' => ['class', 'style'],
    'img' => ['src', 'alt', 'title', 'width', 'height', 'id', 'class'],
    'ins' => ['datetime'],
    'li' => ['class', 'style'],
    'mark' => [],
    'nav' => [],
    'ol' => ['class', 'style'],
    'p' => ['class', 'style'],
    'pre' => ['class', 'style'],
    's' => [],
    'section' => [],
    'small' => [],
    'span' => ['class', 'style'],
    'sub' => ['class', 'style'],
    'sup' => ['class', 'style'],
    'strong' => ['class', 'style'],
    'table' => ['width', 'border', 'align', 'valign', 'class', 'style'],
    'tbody' => ['align', 'valign', 'class', 'style'],
    'td' => ['width', 'rowspan', 'colspan', 'align', 'valign', 'class', 'style'],
    'tfoot' => ['align', 'valign', 'class', 'style'],
    'th' => ['width', 'rowspan', 'colspan', 'align', 'valign', 'class', 'style'],
    'thead' => ['align', 'valign', 'class', 'style'],
    'tr' => ['rowspan', 'align', 'valign', 'class', 'style'],
    'tt' => [],
    'u' => [],
    'ul' => ['class', 'style'],
    'video' => ['autoplay', 'controls', 'loop', 'preload', 'src', 'height', 'width', 'class', 'style'],
    'embed' => ['src', 'height', 'align', 'width', 'class', 'style', 'type', 'pluginspage', 'wmode', 'play', 'loop', 'menu', 'allowscriptaccess', 'allowfullscreen'],
    'source' => ['src', 'type'],
  ];
  $html = strip_tags($html, '<' . implode('><', array_keys($elements)) . '>');
  $xml = new \DOMDocument();
  libxml_use_internal_errors(true);
  if (!strlen($html)) {
    return '';
  }
  if ($xml->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $html)) {
    foreach ($xml->getElementsByTagName('*') as $element) {
      if (!isset($elements[$element->tagName])) {
        $element->parentNode->removeChild($element);
      } else {
        for ($k = $element->attributes->length - 1; $k >= 0; --$k) {
          if (!in_array($element->attributes->item($k)->nodeName, $elements[$element->tagName])) {
            $element->removeAttributeNode($element->attributes->item($k));
          } elseif (in_array($element->attributes->item($k)->nodeName, ['href', 'src', 'style', 'background', 'size'])) {
            $_keywords = ['javascript:', 'javascript.:', 'vbscript:', 'vbscript.:', ':expression'];
            $find = false;
            foreach ($_keywords as $a => $b) {
              if (false !== strpos(strtolower($element->attributes->item($k)->nodeValue), $b)) {
                $find = true;
              }
            }
            if ($find) {
              $element->removeAttributeNode($element->attributes->item($k));
            }
          }
        }
      }
    }
  }
  $html = substr($xml->saveHTML($xml->documentElement), 12, -14);
  $html = strip_tags($html, '<' . implode('><', array_keys($elements)) . '>');

  return $html;
}

/**
 * CURL请求
 *
 * @param $url 请求url地址
 * @param $method 请求方法 get post
 * @param null       $postfields post数据数组
 * @param array      $headers    请求header信息
 * @param bool|false $debug      调试开启 默认false
 *
 * @return mixed
 */
function httpRequest($url, $method, $postfields = null, $headers = array(), $debug = false)
{
  $method = strtoupper($method);
  $ci = curl_init();
  /* Curl settings */
  curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
  curl_setopt($ci, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0');
  curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 60); /* 在发起连接前等待的时间，如果设置为0，则无限等待 */
  curl_setopt($ci, CURLOPT_TIMEOUT, 7); /* 设置cURL允许执行的最长秒数 */
  curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
  switch ($method) {
    case 'POST':
      curl_setopt($ci, CURLOPT_POST, true);
      if (!empty($postfields)) {
        $tmpdatastr = is_array($postfields) ? http_build_query($postfields) : $postfields;
        curl_setopt($ci, CURLOPT_POSTFIELDS, $tmpdatastr);
      }
      break;
    default:
      curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method); /* //设置请求方式 */
      break;
  }
  $ssl = preg_match('/^https:\/\//i', $url) ? true : false;
  curl_setopt($ci, CURLOPT_URL, $url);
  if ($ssl) {
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false); // https请求 不验证证书和hosts
    curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false); // 不从证书中检查SSL加密算法是否存在
  }
  //curl_setopt($ci, CURLOPT_HEADER, true); /*启用时会将头文件的信息作为数据流输出*/
  //curl_setopt($ci, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ci, CURLOPT_MAXREDIRS, 3); /*指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的*/
  curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ci, CURLINFO_HEADER_OUT, true);
  /*curl_setopt($ci, CURLOPT_COOKIE, $Cookiestr); * *COOKIE带过去** */
  $response = curl_exec($ci);
  $requestinfo = curl_getinfo($ci);
  $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
  if ($debug) {
    echo "=====post data======\r\n";
    var_dump($postfields);
    echo "=====info===== \r\n";
    print_r($requestinfo);
    echo "=====response=====\r\n";
    print_r($response);
  }
  curl_close($ci);

  return $response;
}

function httpGet($url)
{
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_TIMEOUT, 500);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
  // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
  curl_setopt($curl, CURLOPT_URL, $url);
  $res = curl_exec($curl);
  curl_close($curl);

  return $res;
}

/**
 * 传入原图地址自动获取相应缩略图地址
 */
function get_thumb($url)
{
  if (!$url || strlen($url) < 1) {
    return '';
  }

  $dotIdx = strrpos($url, '.');
  $filename = substr($url, 0, $dotIdx);
  $fileExt = substr($url, $dotIdx);
  $url = $filename . '_s' . $fileExt;

  return $url;
}

/**
 * 替换标点符号.
 *
 * @param string $key
 */
function remove_punct(string $key)
{
  $key = preg_replace('/[[:punct:]]/i', '', $key);
  mb_regex_encoding('utf-8');
  $char = '，。、！？：；﹑•＂…‘’“”〝〞∕¦‖—　〈〉﹞﹝「」‹›〖〗】【»«』『〕〔》《﹐¸﹕︰﹔！¡？¿﹖﹌﹏﹋＇´ˊˋ―﹫︳︴¯＿￣﹢﹦﹤‐­˜﹟﹩﹠﹪﹡﹨﹍﹉﹎﹊ˇ︵︶︷︸︹︿﹀︺︽︾ˉ﹁﹂﹃﹄︻︼（）';
  $key = mb_ereg_replace('[' . $char . ']', ' ', $key, 'UTF-8');
  $key = preg_replace('/\s+/', '', $key);

  return $key;
}

/**
 * 统一错误提示.
 */
function error($msg = 'error', $data = null, $code = 0, $type = null, array $header = [])
{
  return ['msg' => $msg, 'data' => $data, 'code' => $code];
}

function success($data = null, $code = 1, $msg = 'succeed', $type = null, array $header = [])
{
  return ['msg' => $msg, 'data' => $data, 'code' => $code];
}


/**
 * 生成pdf.
 *
 * @param int    $id       作品ID
 * @param string $saveName --指定pdf保存名称
 */
function pdf($id)
{
  $work = Db::name('entry_work')->where('id', $id)->find();
  $declaration_group = Db::name('cate')->where('id',$work['declaration_group'])->find();
  $address = Db::name('cate')->where('id',$work['city'])->find();

  $pdf = new \Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  // 设置打印模式
  $pdf->SetCreator('山东网亿'); //设置创建者
  $pdf->SetAuthor('山东网亿'); //设置作者
  $pdf->SetTitle(''); //设置文件的title

  // 是否显示页眉
  $pdf->setPrintHeader(false);
  // 设置页眉显示的内容
  $pdf->SetHeaderData('', 60, '', '', array(0, 64, 255), array(0, 64, 128));
  // 设置页眉字体
  $pdf->setHeaderFont(array('stsongstdlight', '', '12'));
  // 页眉距离顶部的距离
  $pdf->SetHeaderMargin('5');

  // 是否显示页脚
  $pdf->setPrintFooter(false);
  // 设置页脚显示的内容
  $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
  // 设置页脚的字体
  $pdf->setFooterFont(array('stsongstdlight', '', '10'));
  // 设置页脚距离底部的距离
  $pdf->SetFooterMargin('10');

  // 设置默认等宽字体
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  // 设置行高
  $pdf->setCellHeightRatio(1.4);
  // 设置左、上、右的间距
  $pdf->SetMargins('0', '0', '0');
  // 设置是否自动分页  距离底部多少距离时分页
  $pdf->SetAutoPageBreak(true, '15');
  // 设置图像比例因子
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  //设置一些与语言相关的字符串
  if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once dirname(__FILE__) . '/lang/eng.php';
    $pdf->setLanguageArray($l);
  }
  //设置默认字体子集模式
  $pdf->setFontSubsetting(true);

  //禁用自动分页符
  $pdf->SetAutoPageBreak(true, 0);

  $pdf->SetFont('stsongstdlight', '', 14, '', true); //设置字体

  $pdf->AddPage(); //增加一个页面
  $pdf->Image('./static/pdf-assets/p1.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
  $pdf->SetXY(148, 39);
  $pdf->Cell(0, 30, $work['workcode'], 0, 0, 'L', 0, '', 0); //编号

  // ------ 申报单位 个人名称
  if(mb_strlen($work['name'],'utf-8')>15) {
    $pdf->SetFontSize(12);
    $pdf->MultiCell(74, 42, $work['name'], 0, 'L', false, 0, 126,155, true, $stretch=1, false, false, '', 'M',true);
  } else {
    $pdf->SetXY(120, 148);
    $pdf->Cell(0, 40, $work['name'], 0, 0, 'L', 0, '', 0); //申报单位 个人名称
  }

  $pdf->SetFontSize(14);

  $pdf->SetXY(120, 176);
  $pdf->Cell(0, 0, $work['commend_company'], 0, 0, 'L', 0, '', 0); //推荐单位

  $pdf->SetXY(90, 187);
  $pdf->Write(0, $work['title'], '', 0, 'L', true, 0, false, false, 0); //作品名称

  //申报组别
  if ($declaration_group['ftitle'] == 'C') {
    $pdf->SetXY(70, 198.5);
    $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0); //产品组
  } else {
    $pdf->SetXY(126 , 198.5);
    $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0); //概念组
  }

  // 填表日期年月日
  $pdf->SetXY(77, 209);
  $pdf->Write(0, date('Y', $work['create_time']), '', 0, 'L', true, 0, false, false, 0);
  $pdf->SetXY(117, 209);
  $pdf->Write(0, date('m', $work['create_time']), '', 0, 'L', true, 0, false, false, 0);
  $pdf->SetXY(154, 209);
  $pdf->Write(0, date('d', $work['create_time']), '', 0, 'L', true, 0, false, false, 0);

  $pdf->AddPage(); //增加一个页面
  $pdf->Image('./static/pdf-assets/p2.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

  $pdf->AddPage(); //承诺书签字盖章页面
  $pdf->Image('./static/pdf-assets/p3.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

  $pdf->AddPage(); //表1：基本情况页面
  $pdf->Image('./static/pdf-assets/p4.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
  $pdf->SetFont('stsongstdlight', '', 14, '', true); //设置字体
  $pdf->SetXY(56, 55);
  // $pdf->Write(0, getCityName($work['title']), '', 0, 'L', true, 0, false, false, 0);
   $pdf->Write(0, $work['title'], '', 0, 'L', true, 0, false, false, 0);


  $contestants = intval($work['contestants']);
  switch ($contestants) {
    case 13:
      $x = 55;
      $y = 67;
      break;
    case 14:
      $x = 101.5;
      $y = 67;
      break;
    case 18:
      $x = 101.5;
      $y = 75;
      break;
    case 47:
      $x = 142.5;
      $y = 67;
      break;
    case 48:
      $x = 55;
      $y = 75;
      break;

  }
 
  // $y = 42 + ceil($contestants / 2) * 6;

  $pdf->SetXY($x, $y);

  $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0); //申报单位类别

  if ($contestants == 6) {
    //个人信息申报栏
    $pdf->SetXY(145, 102);
    $pdf->Write(0, $work['creator_idcard'], '', 0, 'L', true, 0, false, false, 0); //身份证号
    if(mb_strlen($address,'utf-8')>16){
      $pdf->SetFontSize(10);
    } else {
      $pdf->SetFontSize(12);
    }
    // writeHtmlCell $w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true
    //MultiCell $w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false
    // $pdf->MultiCell(67, 8, $address, 0, 'L', false, 0, 130,86, true, $stretch=0, false, false, '', 'M',true);
    // $pdf->MultiCell(73, 53, $work['name'], 0, 'L', false, 0, 130,86, true, $stretch=0, false, false, '', 'M',true);
    $pdf->SetFontSize(14);
    // $pdf->SetXY(131, 95);
    // $pdf->Write(0, $work['zipcode'], '', 0, 'L', true, 0, false, false, 0); //邮编
    $pdf->SetXY(55, 163);
    $pdf->Write(0, $work['contact_person'], '', 0, 'L', true, 0, false, false, 0); //联系人姓名
    // $pdf->SetXY(131, 109);
    // $pdf->Write(0, $work['contact_tel'], '', 0, 'L', true, 0, false, false, 0); //电话/手机

    $pdf->SetXY(55, 173);
    $pdf->Write(0, $work['contact_email'], '', 0, 'L', true, 0, false, false, 0); //邮箱
  } else {
    //单位信息申报栏
    // if(mb_strlen($work['name'],'utf-8')>16){
    //   $pdf->SetFontSize(11);
    //   $y = 77.5;
    // } else {
    //   $pdf->SetFontSize(12);
    //   $y = 83;
    // }
    // $pdf->Write(0, $work['address'], '', 0, 'L', true, 1, false, false, 0); //地址
    // $pdf->MultiCell(58, 8, $work['address'], 0, 'L', false, 0, 49.5,$y, true, $stretch=0, false, false, '', 'M',true);
    // $pdf->MultiCell(78, 53, $work['name'], 0, 'L', false, 0, 49.5,$y, true, $stretch=0, false, false, '', 'M',true);
    $pdf->SetFontSize(14);
   
    $pdf->SetXY(142, 122);
    $pdf->Write(0, $work['creator_designer'], '', 0, 'L', true, 0, false, false, 0); //主创设计者
    $pdf->SetXY(142, 102);
    $pdf->Write(0, $work['creator_idcard'], '', 0, 'L', true, 0, false, false, 0); //主创身份证号
    $pdf->SetXY(142, 134);
    $pdf->Write(0, $work['creator_tel'], '', 0, 'L', true, 0, false, false, 0); //主创电话/手机
    $pdf->SetXY(142, 148);
    $pdf->Write(0, $work['creator_email'], '', 0, 'L', true, 0, false, false, 0); //主创邮箱
    // if(mb_strlen($work['team_member'],'utf-8')>28) {
    //   $pdf->SetFontSize(12);
    //   $pdf->MultiCell(140, 8, $work['team_member'], 0, 'L', false, 0, 50,122, true, $stretch=0, false, false, '', 'M',true);
    //   $pdf->SetFontSize(14);
    // } else {
    //   $pdf->SetXY(50.5, 124);
    //   $pdf->Write(0, $work['team_member'], '', 0, 'L', true, 0, false, false, 0); //团队成员
    // }
    $pdf->SetXY(55, 163);
    $pdf->Write(0, $work['contact_person'], '', 0, 'L', true, 0, false, false, 0); //联系人
    $pdf->SetXY(55, 173);
    $pdf->Write(0, $work['contact_email'], '', 0, 'L', true, 0, false, false, 0); //联系人邮箱
    $pdf->SetXY(142, 173);
    $pdf->Write(0, $work['contact_tel'], '', 0, 'L', true, 0, false, false, 0); //联系人电话/手机
	
	//$pdf->SetXY(55, 186);
   // $pdf->Write(0, $work['address'], '', 0, 'L', true, 0, false, false, 0); //地址
	$pdf->SetFontSize(10);
	$pdf->MultiCell(50, 186, preg_replace('/\n{20,}/','',$work['address']), 0, 'L', false, 0, 55,96, true, $stretch=0, false, false, '', 'M',true);
		$pdf->SetFontSize(14);
	$pdf->SetXY(142, 186);
    $pdf->Write(0, $work['zipcode'], '', 0, 'L', true, 0, false, false, 0); //邮编
    
  }

  //单位或个人简介str_replace(array("/r/n", "/r", "/n"), "", $str)
  $pdf->SetFontSize(12);
  // $pdf->MultiCell(20, 173, preg_replace('/\n{2,}/','',$work['works_profile']), 0, 'L', false, 0, 25, 204, true, $stretch=0, false, false, '', 'M');
  $pdf->MultiCell(160, 110, preg_replace('/\n{20,}/','',$work['works_profile']), 0, 'L', false, 0, 25, 204, true, $stretch=0, false, false, '', 'M');
  $pdf->SetFontSize(14);


  $pdf->AddPage(); //表2：验证材料页面
  $pdf->Image('./static/pdf-assets/p5.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
  if (!empty($work['validation_a'])) {
    $pdf->Image('.' . $work['validation_a'], 45, 72, 100, 35, '', '', '', false, 300, '', false, false, 0);
  }
  if (!empty($work['validation_b'])) {
    $pdf->Image('.' . $work['validation_b'], 32, 116, 60, 32, '', '', '', false, 100, '', false, false, 0);
  }
  if (!empty($work['validation_c'])) {
    $pdf->Image('.' . $work['validation_c'], 115, 116, 60, 32, '', '', '', false, 100, '', false, false, 0);
  }

  if (!empty($work['validation_a'])) {
    $pdf->AddPage(); //单独的营业执照页面
    $pdf->Image('./static/pdf-assets/p9.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    $pdf->Image('.' . $work['validation_a'], 30, 40, 170, 0, '', '', '', false, 300, '', false, false, 0);
  }

  if (!empty($work['validation_b'])) {
    $pdf->AddPage(); //单独的身份证页面
    $pdf->Image('./static/pdf-assets/p9.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    $pdf->Image('.' . $work['validation_b'], 30, 40, 170, 0, '', '', '', false, 300, '', false, false, 0);
  }

  if (!empty($work['validation_c'])) {
    $pdf->AddPage(); //单独的学生证页面
    $pdf->Image('./static/pdf-assets/p9.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    $pdf->Image('.' . $work['validation_c'], 30, 40, 170, 0, '', '', '', false, 300, '', false, false, 0);
  }

  $pdf->AddPage(); //表3：作品情况页面
  $pdf->Image('./static/pdf-assets/p6-profile.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
  $pdf->SetXY(58, 55);
  $pdf->Write(0, $work['title'], '', 0, 'L', true, 0, false, false, 0); //作品名称

  //作品类别
  $works_category = $work['works_category'];
  switch ($works_category) {
    case '4':
      $x = 58;
      $y = 68;
      break;
    case '35':
      $x = 108.5;
      $y = 68;
      break;
    case '5':
      $x = 58;
      $y = 74;
      break;
    case '36':
      $x = 108.5;
      $y = 74;
      break;
    case '6':
      $x = 58;
      $y = 80;
      break;
    case '37':
      $x = 108.5;
      $y = 80;
      break;
    case '29':
      $x = 58;
      $y = 86;
      break;
    case '38':
      $x = 108.5;
      $y = 86;
      break;
    case '30':
      $x = 58;
      $y = 92;
      break;
    case '39':
      $x = 108.5;
      $y = 92;
      break;
    case '31':
      $x = 58;
      $y = 98;
      break;
    case '51':
      $x = 108.5;
      $y = 98;
      break;
    case '32':
      $x = 58;
      $y = 104;
      break;
    case '52':
      $x = 108.5;
      $y = 104;
      break;
    case '33':
      $x = 58;
      $y = 109;
      break;
    case '53':
      $x = 108.5;
      $y = 109;
      break;
    case '34':
      $x = 58;
      $y = 115;
      break;
    case '54':
      $x = 108.5;
      $y = 115;
      break;
  }
   // var_dump($x,$y);exit;
  $pdf->SetXY($x, $y);
  $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0); //作品类别

  //版权登记
  if ($work['copyright'] == 0) {//是
    $pdf->SetXY(150, 126);
    $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0);
  }
  if ($work['copyright'] == 1) {
    $pdf->SetXY(162, 126);
    $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0);
  }
  //申请专利
  if ($work['patent'] == 0) {
    $pdf->SetXY(66, 126);
    $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0); //是
  }
  if ($work['patent'] == 1) {
    $pdf->SetXY(79, 126);
    $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0); //否
  }
  //所有权
  // if ($work['proprietary_rights'] == 0) {
  //   $pdf->SetXY(59, 110);
  //   $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0); //单位
  // }
  // if ($work['proprietary_rights'] == 1) {
  //   $pdf->SetXY(73, 110);
  //   $pdf->Write(0, '√', '', 0, 'L', true, 0, false, false, 0); //个人
  // }
  //上市或完成日期
  $pdf->SetXY(140, 137);
  $pdf->Write(0, date('Y', $work['completion_date']), '', 0, 'L', true, 0, false, false, 0);
  $pdf->SetXY(154, 137);
  $pdf->Write(0, date('m', $work['completion_date']), '', 0, 'L', true, 0, false, false, 0);
  $pdf->SetXY(163, 137);
  $pdf->Write(0, date('d', $work['completion_date']), '', 0, 'L', true, 0, false, false, 0);

  //作品说明
  $pdf->SetFontSize(12);
  $pdf->MultiCell(160, 110, preg_replace('/\n{2,}/','',$work['works_description']), 0, 'L', 1, 0, 26, 155, true, $stretch=0, false, false, '', 'M');
  $pdf->SetFontSize(14);

  $pdf->AddPage(); //表4：作品图片页面
  $pdf->Image('./static/pdf-assets/p7.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
  if (!empty($work['work_pic1'])) {
    $base = basename($work['work_pic1']);
    $dir = dirname($work['work_pic1']);
    $ext = substr($base, strrpos($base, '.'));
    $thumbName = \substr($base, 0, strrpos($base, '.')) . '_s' . $ext;

    if (file_exists('.' . $dir . '/' . $thumbName)) {
      $pdf->Image('.' . $dir . '/' . $thumbName, 37, 40, 50, 50, '', '', '', false, 500, '', false, false, 0);
    } else {
      $pdf->Image('.' . $work['work_pic1'], 37, 40, 50, 50, '', '', '', false, 500, '', false, false, 0);
    }
  }
  if (!empty($work['work_pic2'])) {
    $base = basename($work['work_pic2']);
    $dir = dirname($work['work_pic2']);
    $ext = substr($base, strrpos($base, '.'));
    $thumbName = \substr($base, 0, strrpos($base, '.')) . '_s' . $ext;

    if (file_exists('.' . $dir . '/' . $thumbName)) {
      $pdf->Image('.' . $dir . '/' . $thumbName, 125, 40, 50, 50, '', '', '', false, 500, '', false, false, 0);
    } else {
      $pdf->Image('.' . $work['work_pic2'], 125, 40, 50, 50, '', '', '', false, 500, '', false, false, 0);
    }
  }
  if (!empty($work['work_pic3'])) {
    $base = basename($work['work_pic3']);
    $dir = dirname($work['work_pic3']);
    $ext = substr($base, strrpos($base, '.'));
    $thumbName = \substr($base, 0, strrpos($base, '.')) . '_s' . $ext;

    if (file_exists('.' . $dir . '/' . $thumbName)) {
      $pdf->Image('.' . $dir . '/' . $thumbName, 37, 128, 50, 50, '', '', '', false, 500, '', false, false, 0);
    } else {
      $pdf->Image('.' . $work['work_pic3'], 37, 128, 50, 50, '', '', '', false, 500, '', false, false, 0);
    }
  }
  if (!empty($work['work_pic4'])) {
    $base = basename($work['work_pic4']);
    $dir = dirname($work['work_pic4']);
    $ext = substr($base, strrpos($base, '.'));
    $thumbName = \substr($base, 0, strrpos($base, '.')) . '_s' . $ext;

    if (file_exists('.' . $dir . '/' . $thumbName)) {
      $pdf->Image('.' . $dir . '/' . $thumbName, 125, 128, 50, 50, '', '', '', false, 500, '', false, false, 0);
    } else {
      $pdf->Image('.' . $work['work_pic4'], 125, 128, 50, 50, '', '', '', false, 500, '', false, false, 0);
    }
  }
  if (!empty($work['work_pic5'])) {
    $base = basename($work['work_pic5']);
    $dir = dirname($work['work_pic5']);
    $ext = substr($base, strrpos($base, '.'));
    $thumbName = \substr($base, 0, strrpos($base, '.')) . '_s' . $ext;

    if (file_exists('.' . $dir . '/' . $thumbName)) {
      $pdf->Image('.' . $dir . '/' . $thumbName, 37, 216, 50, 50, '', '', '', false, 500, '', false, false, 0);
    } else {
      $pdf->Image('.' . $work['work_pic5'], 37, 216, 50, 50, '', '', '', false, 500, '', false, false, 0);
    }
  }
  if (!empty($work['work_pic6'])) {
    $base = basename($work['work_pic6']);
    $dir = dirname($work['work_pic6']);
    $ext = substr($base, strrpos($base, '.'));
    $thumbName = \substr($base, 0, strrpos($base, '.')) . '_s' . $ext;

    if (file_exists('.' . $dir . '/' . $thumbName)) {
      $pdf->Image('.' . $dir . '/' . $thumbName, 125, 216, 50, 50, '', '', '', false, 500, '', false, false, 0);
    } else {
      $pdf->Image('.' . $work['work_pic6'], 125, 216, 50, 50, '', '', '', false, 500, '', false, false, 0);
    }
  }
  /*if (!empty($work['work_pic7'])) {
    $base = basename($work['work_pic7']);
    $dir = dirname($work['work_pic7']);
    $ext = substr($base, strrpos($base, '.'));
    $thumbName = \substr($base, 0, strrpos($base, '.')) . '_s' . $ext;

    if (file_exists('.' . $dir . '/' . $thumbName)) {
      $pdf->Image('.' . $dir . '/' . $thumbName, 30, 165, 150, 100, '', '', '', false, 300, '', false, false, 0);
    } else {
      $pdf->Image('.' . $work['work_pic7'], 30, 165, 150, 100, '', '', '', false, 300, '', false, false, 0);
    }
  }*/

  $pdf->AddPage(); //表5：作品展板图页面
  $pdf->Image('./static/pdf-assets/p8.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
  if (!empty($work['layout_pic'])) {
    $base = basename($work['layout_pic']);
    $dir = dirname($work['layout_pic']);
    $ext = substr($base, strrpos($base, '.'));
    $thumbName = \substr($base, 0, strrpos($base, '.')) . '_s' . $ext;

    if (file_exists('.' . $dir . '/' . $thumbName)) {
      $pdf->Image('.' . $dir . '/' . $thumbName, 30, 40, 152, 218, '', '', '', false, 300, '', false, false, 0);
    } else {
      $pdf->Image('.' . $work['layout_pic'], 30, 40, 152, 218, '', '', '', false, 300, '', false, false, 0);
    }
  }

  ob_clean();
  $saveName = $work['workcode'] . '-'  . $work['uid']; //. date('YmdHis') . '-'
  $saveurl = '/pdf/' . $saveName . '.pdf';
  Db::name('entry_work')->where('id', $id)->setField('pdf_upload_url', $saveurl);
  $pdf->Output(env('root_path') . 'public' . $saveurl, 'F');
}


function getCityName($value)
{
  $arr = ['01' => '青岛', '02' => '济南', '03' => '烟台', '04' => '潍坊', '05' => '临沂', '06' => '济宁', '07' => '淄博', '08' => '菏泽', '09' => '德州', '10' => '威海', '11' => '东营', '12' => '泰安', '13' => '滨州', '14' => '聊城', '15' => '日照', '16' => '枣庄',];
  if (isset($arr[$value])) {
    return $arr[$value];
  } else {
    return '未填写';
  }
}
function isMobile()
{
	if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
		return true;
	}
	if (isset($_SERVER['HTTP_VIA'])) {
		return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	}
	if (isset($_SERVER['HTTP_USER_AGENT'])) {
		$clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
		if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
			return true;
		}
	}
	if (isset($_SERVER['HTTP_ACCEPT'])) {
		if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
			return true;
		}
	}
	return false;
}

// 根据当前时间判断是在大赛的哪个阶段
function getCurrentStage()
{
  $expertAwardsPeriod = config('app.awards_period');
  $now = time();
  $currentStage = 'chusai';
  foreach ($expertAwardsPeriod as $key => $period) {
    if ($now > strtotime($period[0]) && $now < strtotime($period[0])) {
      $currentStage = $key;
      break;
    }
  }
  return $currentStage;
}



if (!function_exists('collection')) {
  /**
   * 数组转换为数据集对象
   *
   * @param array $resultSet 数据集数组
   *
   * @return \think\model\Collection|\think\Collection
   */
  function collection($resultSet)
  {
    $item = current($resultSet);
    if ($item instanceof Model) {
      return \think\model\Collection::make($resultSet);
    } else {
      return \think\Collection::make($resultSet);
    }
  }
}
