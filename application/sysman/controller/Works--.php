<?php

namespace app\sysman\controller;

use think\Db;
use app\common\model\EntryWork;
use app\common\model\Grade;
use app\common\model\GradeFusai;
use app\common\model\GradeFinal;

class Works extends AdminBase
{
    public function initialize()
    {
        parent::initialize();
        $this->model = new EntryWork();
    }

    public function index()
    {

//        if(!empty($_REQUEST['tt'])&&$_REQUEST['tt']==2020){
//           $res= Db::name('entry_work')->find(929);
//           dump($res);
//            return ;
//        }
////

        $map = [];
        $submitto = input('submitto/a');
        $title = input('title');
        $name = input('name');
        $works_category = input('works_category');
        $declaration_group = input('declaration_group');
        $city = input('city');
        $startdate = input('createtime_startdate');
        $enddate = input('createtime_enddate');
        $checkstatus1 = input('checkstatus1');
        $contestants = input('contestants');
        $workcode = input('workcode');
        $export = input('export');

        if (!empty($workcode)) {
            $map[] = ['workcode', 'like', '%'.$workcode.'%'];
        }
        if (!empty($title)) {
            $map[] = ['title', 'like', '%'.$title.'%'];
        }
        if (!empty($name)) {
            $map[] = ['name', 'like', '%'.$name.'%'];
        }
        if (!empty($works_category)) {
            $map[] = ['works_category', '=', $works_category];
        }
        if (!empty($declaration_group)) {
            $map[] = ['declaration_group', '=', $declaration_group];
        }
        if (!empty($city)) {
            $map[] = ['city', '=', $city];
        }
        if (!empty($startdate) && !empty($enddate)) {
            $map[] = ['create_time', ['>=', strtotime($startdate)], ['<=', strtotime($enddate)], 'and'];
        } elseif (!empty($startdate)) {
            $map[] = ['create_time', '>=', strtotime($startdate)];
        } elseif (!empty($enddate)) {
            $map[] = ['create_time', '<=', strtotime($enddate)];
        }

        $state = input('get.state');
        $chart = input('get.chart');
        $currentStage = 'chusai';
        $isShowBtnPromoted = false; //是否显示晋级 驳回按钮
        $isShowBtnBohui = false; //是否显示驳回按钮
        $isShowBtnPromotedGx = false; //是否显示高校晋级 驳回按钮
        $isShowBtnBohuiGx = false; //是否显示高校驳回按钮
        //获取动态区域和类别信息
        $city = Db::name('cate')->where('cateid = 7')->select();

        $type = Db::name('cate')->where('cateid = 9')->select();

        $this->assign('city', $city);
        $this->assign('type', $type);
        switch ($state) {
          case 'waitzhongshen': //待审核
            $isShowBtnBohui = true;
            $map[] = ['checkstatus1', '=', 0];
            break;
          case 'passedzhongshen': //审核通过
            $isShowBtnBohui = true;
            $map[] = ['checkstatus1', '=', 1];
            break;
          case 'rebutzhongshen': //被驳回的
            $map[] = ['checkstatus1', '=', -1];
            break;
          case 'waitchuping':
            $isShowBtnPromoted = true;
            $isShowBtnPromotedGx = true;
            $map[] = ['checkstatus1', '=', 1];
            $map[] = ['zj_audit1', '=', 0];
            break;
          case 'passedchuping':
            $isShowBtnBohui = true;
            $isShowBtnPromotedGx = true;
            $currentStage = 'chusai';
			$map[] = ['checkstatus1', '=', 1];
            $map[] = ['zj_audit1', '=', 1];
            break;
          case 'universityranking':
            $isShowBtnBohuiGx = true;
            $currentStage = 'chusai';
			$map[] = ['checkstatus1', '=', 1];
            $map[] = ['gx_audit', '=', 1];
            break;
          case 'waitfuping':
            $isShowBtnPromoted = true;
            $currentStage = 'fusai';
			$map[] = ['checkstatus1', '=', 1];
            $map[] = ['zj_audit1', '=', 1];
            $map[] = ['zj_audit2', '=', 0];
            break;
          case 'passedfuping':
            $isShowBtnBohui = true;
            $currentStage = 'fusai';
			$map[] = ['checkstatus1', '=', 1];
            $map[] = ['zj_audit2', '=', 1];
            break;
          case 'waitzhongping':
            $isShowBtnPromoted = true;
            $currentStage = 'final';
			$map[] = ['checkstatus1', '=', 1];
            $map[] = ['zj_audit2', '=', 1];
            $map[] = ['zj_audit3', '=', 0];
            break;
          case 'passedzhongping':
            $isShowBtnBohui = true;
            $currentStage = 'final';
			$map[] = ['checkstatus1', '=', 1];
            $map[] = ['zj_audit3', '=', 1];
            break;
        }

        $this->assign('isShowBtnPromoted', $isShowBtnPromoted);
        $this->assign('isShowBtnBohui', $isShowBtnBohui);
        $this->assign('isShowBtnPromotedGx', $isShowBtnPromotedGx);
        $this->assign('isShowBtnBohuiGx', $isShowBtnBohuiGx);
		$is_pdf = Db::name('systems')->where("id=2")->value("value"); /*关闭复评流程 2021-04-28 wyw  add*/
		//var_dump($is_pdf);exit;
		$this->assign('is_pdf', $is_pdf);

        if (false === $this->request->isAjax()) {
            return $this->fetch();
        }

        if (isset($checkstatus1)) {
            $map[] = ['checkstatus1', '=', intval($checkstatus1)];
        }
        if (!empty($contestants)) {
            $map[] = ['contestants', '=', intval($contestants)];
        }

        list($page, $limit) = $this->buildLayParms();
        $percentByCategory = null;
        $gradeModel = 'grade_'.$currentStage;
        $where = '';

        if (cookie('rolecode') == 'specialist') {
            $fields = 'w.id,w.create_time,declaration_group,city,name,completion_date,w.works_category,w.workcode,title,g.id as gid,g.totalscore,contestants';
            // 只显示所负责的作品分组下的作品
            if (empty(session('workscategory'))) {
                $expertGroupId = Db::name('admin')->where('id', cookie('aid'))->value('expert_group_id');
                $rec = Db::name('expert_group')->where('id', $expertGroupId)->field('name,works_category')->find();
                session('workscategory', $rec['works_category']);
            }
            $map[] = ['gc_entry_work.works_category', 'IN', explode(',', session('workscategory'))];

            if ($currentStage == 'chusai') {
                //机械类和家具类再拆分
                $expertGroupId = Db::name('admin')->where('username', '=', cookie('username'))->value('expert_group_id');
                // var_dump(cookie('username'));exit;
                $expertGroupName = Db::name('expert_group')->where('id', '=', $expertGroupId)->value('name');

                if ($expertGroupName == '机械装备A' || $expertGroupName == '机械装备B' || $expertGroupName == '专家06特殊组') {
                    unset($map[2]);
                    $splitId = 1458;
                    if ($expertGroupName == '机械装备A') {
                        $map[] = [['gc_entry_work.id', '<', $splitId]];
                        $map[] = ['gc_entry_work.works_category', '=', 'A'];
                    } elseif ($expertGroupName == '机械装备B') {
                        $where = "((w.id>={$splitId} and w.works_category='A') or w.works_category='B')";
                    } elseif ($expertGroupName == '专家06特殊组') {
                        $where = "((w.id>={$splitId} and w.works_category='A') or w.works_category='B' or w.works_category='R' or w.works_category='S')";
                    }
                } elseif ($expertGroupName == '家居与家具A' || $expertGroupName == '家居与家具B' || $expertGroupName == '专家23') {
                    unset($map[2]);
                    $splitId = 1980;
                    if ($expertGroupName == '家居与家具A') {
                        $map[] = ['gc_entry_work.id', '<', $splitId];
                        $map[] = ['gc_entry_work.works_category', '=', 'H'];
                    } elseif ($expertGroupName == '家居与家具B') {
                        $where = "((w.id>={$splitId} and w.works_category='H') or w.works_category='O')";
                    } elseif ($expertGroupName == '专家23') {
                        $where = "((w.id>={$splitId} and w.works_category='H') or w.works_category='O' or w.works_category='L')";
                    }
                }

                // 待初评+通过初评列表部分显示当前专家打分
                $query = $this->model->alias('w')->join('grade g', 'w.id=g.work_id AND adminid='.cookie('aid'), 'left');
            } else {
                // 待复评+通过复评列表，待终评及终评通过显示当前专家打分
                $query = $this->model->alias('w')->join($gradeModel.' g', 'w.id=g.work_id AND adminid='.cookie('aid'), 'left');
            }

            if (!empty($export)) {
                //专家导出打分表格数据
                $list = $query->where(json_decode($export, true))->where($map)->where($where)->field($fields)->order('w.id desc')->select()->toArray();
            } else {
                $list = $query->where($map)->where($where)->field($fields)->order('g.totalscore,w.id desc')->page($page, $limit)->select()->toArray();
            }
            foreach ($list as $key => $value) {
                $lists = Db::name('entry_work')->where('id',$value['id'])->find();
                $workcity = Db::name('cate')->where('id',$lists['city'])->find();
                $workcontestants = Db::name('cate')->where('id',$lists['contestants'])->find();
                $works_category = Db::name('cate')->where('id',$lists['works_category'])->find();
                $declaration_group = Db::name('cate')->where('id',$lists['declaration_group'])->find();
                $list[$key]['city'] = $workcity['title'];
                $list[$key]['declaration_group'] = $declaration_group['title'];
                $list[$key]['contestants'] = $workcontestants['title'];
                $list[$key]['works_category'] = $works_category['title'];
            }

        } else {
            //管理员角色时
            if (!empty($submitto) && count($submitto) === 1) {
                $v = array_values($submitto);

                $map[] = ['submitto', '=', $v[0]];
            }
            if (!empty($export)) {
                // $exportType = input('get')
                //导出申报数据
                $subList = $this->model->withAvg($gradeModel, 'totalscore')->where(json_decode($export, true))->where($map)->field('id,'.$gradeModel.'_avg,workcode,title,declaration_group,works_category,name,checkstatus1,creator_designer,creator_tel,creator_email,contact_person,contact_tel,contact_email');

                $list = $subList->order($gradeModel.'_avg desc')->order('id desc')->select()->toArray();
                foreach ($list as &$item) {
                    $lists = Db::name('entry_work')->where('id',$item['id'])->find();
                    $workcity = Db::name('cate')->where('id',$lists['city'])->find();
                    $workcontestants = Db::name('cate')->where('id',$lists['contestants'])->find();
                    $works_category = Db::name('cate')->where('id',$lists['works_category'])->find();
                    $declaration_group = Db::name('cate')->where('id',$lists['declaration_group'])->find();
                    $item['city'] = $workcity['title'];
                    $item['declaration_group'] = $declaration_group['title'];
                    $item['contestants'] = $workcontestants['title'];
                    $item['works_category'] = $works_category['title'];
                }
            } else {
                $percentByCategory =[];
                if($chart == 1){
                    //作品类别占比数量
                    $cate = Db::name('cate')->where('cateid = 9')->field('title,id')->select();
                    
                    foreach ($cate as $key => $val) {
                        
                        $zcate = Db::name('entry_work')->where('works_category' ,$val['id'])->where($map)->select();
                        $percentByCategory[$key]['name'] = $val['title'];
                        $percentByCategory[$key]['value'] = count($zcate);
                        $percentByCategory[$key]['shuzi'] = $chart;
                    }
                    // $percentByCategory = $this->model->where($map)->group('works_category')->field('works_category,count(*) as value')->select();
                    // var_dump($percentByCategory);exit;
                }elseif($chart == 2){

                    //作品类别占比数量
                    $cate = Db::name('cate')->where('cateid = 6')->field('title,id')->select();
                    
                    foreach ($cate as $key => $val) {
                        
                        $zcate = Db::name('entry_work')->where('declaration_group' ,$val['id'])->where($map)->select();
                        $percentByCategory[$key]['name'] = $val['title'];
                        $percentByCategory[$key]['value'] = count($zcate);
                        $percentByCategory[$key]['shuzi'] = $chart;
                    }
                    
                }elseif($chart == 3){
                    //作品类别占比数量
                    $city = Db::name('cate')->where('cateid = 7')->field('title,id')->select();
                    
                    foreach ($city as $key => $val) {
                        
                        $zcity = Db::name('entry_work')->where('city' ,$val['id'])->where($map)->select();
                        $percentByCategory[$key]['name'] = $val['title'];
                        $percentByCategory[$key]['value'] = count($zcity);
                        $percentByCategory[$key]['shuzi'] = $chart;
                    }
                }elseif($chart == 4){
                    //作品类别占比数量
                    $duix = Db::name('cate')->where('cateid = 8')->field('title,id')->select();
                    
                    foreach ($duix as $key => $val) {
                        
                        $duix = Db::name('entry_work')->where('contestants' ,$val['id'])->where($map)->select();
                        $percentByCategory[$key]['name'] = $val['title'];
                        $percentByCategory[$key]['value'] = count($duix);
                        $percentByCategory[$key]['shuzi'] = $chart;
                    }
                }
                
                // 显示表格
                $subList = $this->model->withSum($gradeModel, 'totalscore')->withAvg($gradeModel, 'totalscore')->where($map);
                $subList->visible(['id', 'workcode','submitto','create_time', 'title', 'declaration_group', 'works_category', 'city', 'name', 'completion_date', 'contestants', 'checkstatus1','pdf_upload_url', $gradeModel.'_avg', $gradeModel.'_sum']);
               
                // $subList->hidden(explode(',','work_pic6,works_analysis,works_description'));
                $list = $subList->order($gradeModel.'_avg desc,id desc')->page($page, $limit)->select()->toArray();
    
                // $list = collection($list)->toArray();
                

                foreach ($list as &$item) {
                    $lists = Db::name('entry_work')->where('id',$item['id'])->find();
                    $workcity = Db::name('cate')->where('id',$lists['city'])->find();
                    $workcontestants = Db::name('cate')->where('id',$lists['contestants'])->find();
                    $works_category = Db::name('cate')->where('id',$lists['works_category'])->find();
                    $declaration_group = Db::name('cate')->where('id',$lists['declaration_group'])->find();
                    $item['city'] = $workcity['title'];
                    $item['declaration_group'] = $declaration_group['title'];
                    $item['contestants'] = $workcontestants['title'];
                    $item['works_category'] = $works_category['title'];
                    $item['totalscore'] = $item[$gradeModel.'_sum'];
                    $item['avgscore'] = $item[$gradeModel.'_avg'];
                }
            }
        }
        // var_dump($list);exit;
        $total = $this->model->alias('w')->where($map)->where($where)->count();
     
        $rtn = ['list' => $list, 'total' => $total, 'count' => $percentByCategory, 'mapData' => $map];

        $this->result($rtn);
    }

	public function edit()
	{
		$info = null;
		$id = input('get.id');
		
		if (!empty($id)) {
		  $info = Db::name('entry_work')->find($id);
		}
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
		
		$info['completion_date'] = date('Y-m-d',$info['completion_date']);
		
		$this->assign('info', json_encode($info));
		return $this->fetch();
	}

	public function save()
	{
		$data = input('post.');
		$this->model->isUpdate(!empty($data['id']))->allowField(true)->save($data);
		//var_dump($this->model->getlastsql());exit;
		$this->success('1', null, $this->model);
		
	}

    //作品详情页面显示
    public function view($id = '')
    {

        $record = null;
        if (!empty($id)) {
            $record = Db::name('entry_work')->find($id);

            $recordcity = Db::name('cate')->where('id',$record['city'])->field('title')->find();
            $works_category = Db::name('cate')->where('id',$record['works_category'])->field('title')->find();
            $contestants = Db::name('cate')->where('id',$record['contestants'])->field('title')->find();
            $declaration_group = Db::name('cate')->where('id',$record['declaration_group'])->field('title')->find();

            $record['city'] = $recordcity['title'];
            $record['works_category'] = $works_category['title'];
            $record['contestants'] = $contestants['title'];
            $record['declaration_group'] = $declaration_group['title'];
        }
        // var_dump($record);exit;
        $this->assign('record', $record);

        return $this->fetch();
    }

    /**
     * 作品评分页面,只有专家可访问.
     *
     * @param string $wid
     */
    public function pingfen($wid = '')
    {
        $gid = input('get.gid');
        if (empty($wid)) {
            $this->error('参数错误');
        }
        $data = Db::name('entry_work')->find($wid);
        $datacity = Db::name('cate')->where('id',$data['city'])->field('title')->find();
        $works_category = Db::name('cate')->where('id',$data['works_category'])->field('title')->find();
        $contestants = Db::name('cate')->where('id',$data['contestants'])->field('title')->find();
        $declaration_group = Db::name('cate')->where('id',$data['declaration_group'])->field('title')->find();

        $data['city'] = $datacity['title'];
        $data['works_category'] = $works_category['title'];
        $data['contestants'] = $contestants['title'];
        $data['declaration_group'] = $declaration_group['title'];
        $expertType = cookie('experttype');
        if ($expertType == 'chusai') {
            $pingfenResult = Db::name('grade')->find($gid);
        } else {
            $pingfenResult = Db::name('grade_'.$expertType)->find($gid);
        }
        $this->assign('data', $data);
        $this->assign('pingfenResult', json_encode($pingfenResult));

        return $this->fetch();
    }
	
	
	/**
     * 作品评分页面,只有专家可访问.
     *
     * @param string $wid
     */
    public function mpingfen($wid = '')
    {
        $gid = input('get.gid');
        if (empty($wid)) {
            $this->error('参数错误');
        }
        $data = Db::name('entry_work')->find($wid);
        $datacity = Db::name('cate')->where('id',$data['city'])->field('title')->find();
        $works_category = Db::name('cate')->where('id',$data['works_category'])->field('title')->find();
        $contestants = Db::name('cate')->where('id',$data['contestants'])->field('title')->find();
        $declaration_group = Db::name('cate')->where('id',$data['declaration_group'])->field('title')->find();

        $data['city'] = $datacity['title'];
        $data['works_category'] = $works_category['title'];
        $data['contestants'] = $contestants['title'];
        $data['declaration_group'] = $declaration_group['title'];
        $expertType = cookie('experttype');
		
		if($expertType != "final"){
			
			$this->error('您无权查看！','/expertlogin');
			
		}
		
        if ($expertType == 'chusai') {
            $pingfenResult = Db::name('grade')->find($gid);
        } else {
            $pingfenResult = Db::name('grade_'.$expertType)->find($gid);
        }
        $this->assign('data', $data);
        $this->assign('pingfenResult', json_encode($pingfenResult));

        return $this->fetch();
		
    }
	
	

    //作品打分标准页面显示
    public function pingfenmsg()
    {
        return $this->fetch();
    }

    /** 专家打分后保存评分，返回data包括下一个待打分的作品id */
    public function saveGrade($data = [])
    {
        if (false === $this->request->isPost()) {
            $this->error('非法请求');
        }
        if ($data['id'] == 'null') {
            $data['id'] = 0;
        }
        if (!empty($data['id'])) {
            $isUpdate = true;
        } else {
            $isUpdate = false;
        }
        if (cookie('experttype') == 'chusai') {
            $model = new Grade();
        } elseif (cookie('experttype') == 'fusai') {
            $model = new GradeFusai();
        } else {
            $model = new GradeFinal();
        }

        $hasScored = $model->where('adminid', cookie('aid'))->where('work_id', $data['work_id'])->find();
        if ($hasScored) {
            $result = $model->allowField(true)->save($data, ['adminid' => cookie('aid'), 'work_id' => $data['work_id']]);
        } else {
            $result = $model->allowField(true)->isUpdate($isUpdate)->save($data);
        }
        if (false === $result) {
            $this->error($model->getError());
        }

        $map = [];

        switch (session('current_stage')) {
      case 'chusai':
        $state = 'waitchuping';
        $map[] = ['checkstatus1', '=', 1];
        $map[] = ['zj_audit1', '=', 0];
        break;
      case 'fusai':
        $state = 'waitfuping';
        $map[] = ['zj_audit1', '=', 1];
        $map[] = ['zj_audit2', '=', 0];
        break;
      case 'final':
        $state = 'waitzhongping';
        $map[] = ['zj_audit2', '=', 1];
        $map[] = ['zj_audit3', '=', 0];
        break;
    }

        $map[] = ['works_category', 'IN', explode(',', session('workscategory'))];

        $nextWorksId = Db::name('entry_work')->where('checkstatus1', '=', 1)->where($map)->where('id', '<', $data['work_id'])->order('id desc')->limit(1)->value('id');
        if ($nextWorksId) {
            $msg = '您的评分已保存，将自动跳转到下一个待评分作品。';
            $url = '/sysman/works/pingfen?wid='.$nextWorksId.'&gid=0';
        } else {
            $msg = '所有作品已评分完成，谢谢！:)';
            $url = '/sysman/works/index?state='.$state;
        }
        $this->success($msg, $url, 0);
    }
	
	public function esaveGrade($data = [])
    {
        if (false === $this->request->isPost()) {
            $this->error('非法请求');
        }
        if ($data['id'] == 'null') {
            $data['id'] = 0;
        }
        if (!empty($data['id'])) {
            $isUpdate = true;
        } else {
            $isUpdate = false;
        }
        if (cookie('experttype') == 'chusai') {
            $model = new Grade();
        } elseif (cookie('experttype') == 'fusai') {
            $model = new GradeFusai();
        } else {
            $model = new GradeFinal();
        }

        $hasScored = $model->where('adminid', cookie('aid'))->where('work_id', $data['work_id'])->find();
        if ($hasScored) {
            $result = $model->allowField(true)->save($data, ['adminid' => cookie('aid'), 'work_id' => $data['work_id']]);
        } else {
            $result = $model->allowField(true)->isUpdate($isUpdate)->save($data);
        }
        if (false === $result) {
            $this->error($model->getError());
        }

        $map = [];

        switch (session('current_stage')) {
      case 'chusai':
        $state = 'waitchuping';
        $map[] = ['checkstatus1', '=', 1];
        $map[] = ['zj_audit1', '=', 0];
        break;
      case 'fusai':
        $state = 'waitfuping';
        $map[] = ['zj_audit1', '=', 1];
        $map[] = ['zj_audit2', '=', 0];
        break;
      case 'final':
        $state = 'waitzhongping';
        $map[] = ['zj_audit2', '=', 1];
        $map[] = ['zj_audit3', '=', 0];
        break;
    }

        $map[] = ['works_category', 'IN', explode(',', session('workscategory'))];

        $nextWorksId = Db::name('entry_work')->where('checkstatus1', '=', 1)->where($map)->where('id', '<', $data['work_id'])->order('id desc')->limit(1)->value('id');
       
		
		$msg = '评分完成，谢谢！:)';
       
        $this->success($msg);
    }

    //管理员查看专家评分
    public function pingfendetail($wid = '')
    {
        if (empty($wid)) {
            $this->error('参数错误');
        }
        $gradeinfo = Db::name('entry_work')->find($wid);
        $expertType = cookie('experttype');
        if ($expertType == 'chusai') {
            $pingfenList = Db::name('grade')
        ->alias('g')
        ->where('work_id', '=', $wid)
        ->join('admin a', 'g.adminid=a.id')
        ->select();
        } else {
            $pingfenList = Db::name('grade_'.$expertType)
        ->alias('g')
        ->where('work_id', '=', $wid)
        ->join('admin a', 'g.adminid=a.id')
        ->select();
        }
        $this->assign('gradeinfo', $gradeinfo);
        $this->assign('pingfenList', $pingfenList);

        return $this->fetch();
    }

    //管理员修改调节分
    public function updateSetScore($data = [])
    {
        if (false === $this->request->isPost() || empty($data['id'])) {
            $this->error('非法请求');
        }
        if (empty($data['set_score'])) {
            $data['set_score'] = null;
        }
        $result = $this->model->isUpdate(true)->save($data, ['id' => $data['id']]);
        $this->success('修改成功', null, $this->model);
    }

    //删除作品列表作品
    public function del()
    {
        $id = input('id/d');
        $this->removeRelatedFiles($id);
        Db::name('entry_work')->where('id', '=', $id)->delete();
        $this->success();
    }

    /**
     * 删除作品中上传的图片PDF等.
     *
     * @param int $id
     */
    private function removeRelatedFiles($id)
    {
        if (empty($id)) {
            return false;
        }
        $result = Db::name('entry_work')->where('id', '=', $id)->field('validation_a,validation_b,validation_c,pdf_upload_url,work_pic1,work_pic2,work_pic3,work_pic4,work_pic5,work_pic6,work_pic7,layout_pic')->find();

        if (!$result) {
            return false;
        }
        if (!empty($result['validation_a'])) {
            @unlink('.'.$result['validation_a']);
        }
        if (!empty($result['validation_b'])) {
            @unlink('.'.$result['validation_b']);
        }
        if (!empty($result['validation_c'])) {
            @unlink('.'.$result['validation_c']);
        }
        if (!empty($result['pdf_upload_url'])) {
            @unlink('.'.$result['pdf_upload_url']);
        }
        if (!empty($result['work_pic1'])) {
            @unlink('.'.$result['work_pic1']);
        }
        if (!empty($result['work_pic2'])) {
            @unlink('.'.$result['work_pic2']);
        }
        if (!empty($result['work_pic3'])) {
            @unlink('.'.$result['work_pic3']);
        }
        if (!empty($result['work_pic4'])) {
            @unlink('.'.$result['work_pic4']);
        }
        if (!empty($result['work_pic5'])) {
            @unlink('.'.$result['work_pic5']);
        }
        if (!empty($result['work_pic6'])) {
            @unlink('.'.$result['work_pic6']);
        }
        if (!empty($result['work_pic7'])) {
            @unlink('.'.$result['work_pic7']);
        }
        if (!empty($result['layout_pic'])) {
            @unlink('.'.$result['layout_pic']);
        }
    }

    //批量删除作品列表作品
    public function delall()
    {
        $ids = input('id/a');
        foreach ($ids as $id) {
            $this->removeRelatedFiles($id);
        }
        Db::name('entry_work')->where('id', 'IN', $ids)->delete();
        $this->success();
    }

    //作品进入下一阶段(晋级)
    public function bePromoted()
    {
        $map[] = array('id', 'IN', input('id/a'));
        $state = input('post.state');
		$is_open = Db::name('systems')->where("id=1")->value("value"); /*关闭复评流程 2021-04-24 wyw  add*/
        switch ($state) {
        case 'waitchuping':
            $updateData = ['zj_audit1' => 1, 'zj_audit2' => 0,'zj_audit1_time' => time(),'last_operate_ip' =>  $this->request->ip()];
			if($is_open==0) $updateData = ['zj_audit1' => 1, 'zj_audit2' => 1, 'zj_audit3' => 0,'zj_audit1_time' => time(),'zj_audit2_time' => time(),'last_operate_ip' =>  $this->request->ip()]; /*关闭复评流程 2021-04-24 wyw add*/
            break;
        case 'waitfuping':
            $updateData = ['zj_audit2' => 1, 'zj_audit3' => 0,'zj_audit2_time' => time(),'last_operate_ip' =>  $this->request->ip()];
            break;
        case 'waitzhongping':
            $updateData = ['zj_audit3' => 1,'zj_audit3_time' => time(),'last_operate_ip' =>  $this->request->ip()];
            break;
        }
        Db::name('entry_work')->where($map)->update($updateData);
        $this->success();
    }

    //作品返回上一阶段(驳回)
    public function demote()
    {
        $map[] = array('id', 'IN', input('id/a'));
        $state = input('post.state');
        switch ($state) {
      case 'passedchuping':
        $updateData = ['zj_audit1' => 0, 'checkstatus1' => 1,'zj_audit1_time' => time(),'last_operate_ip' =>  $this->request->ip()];
        break;
      case 'passedfuping':
        $updateData = ['zj_audit1' => 1, 'zj_audit2' => 0,'zj_audit2_time' => time(),'last_operate_ip' =>  $this->request->ip()];
        break;
      case 'passedzhongping':
        $updateData = ['zj_audit2' => 1, 'zj_audit3' => 0,'zj_audit3_time' => time(),'last_operate_ip' =>  $this->request->ip()];
        break;
    }
        Db::name('entry_work')->where($map)->update($updateData);
        $this->success();
    }

    //待初评作品(高等院校)进入到高校得分排名
    public function bePromotedGx()
    {
        $map[] = array('id', 'IN', input('id/a'));
        Db::name('entry_work')->where($map)->update(['gx_audit' => 1,'gx_audit_time' => time(),'last_operate_ip' =>  $this->request->ip()]);
        $this->success();
    }

    //高校作品驳回到待初评作品
    public function demoteGx()
    {
        $map[] = array('id', 'IN', input('id/a'));
        Db::name('entry_work')->where($map)->update(['gx_audit' => 0,'gx_audit_time' => time(),'last_operate_ip' =>  $this->request->ip()]);
        $this->success();
    }

    /**
     * 生成PDF.
     */
    public function createpdf($id)
    {
        if (!$id) {
            $this->error('必须传入ID');
        }
		
        $result = pdf($id);
        $this->success();
    }

    /**
     * 批量生成申报书PDF.
     */
    public function pdfall()
    {
        $ids = input('id/a');

        if (empty($ids)) {
            $this->error('参数错误');
        }
		
		$is_pdf = Db::name('systems')->where("id=2")->value("value"); /*关闭复评流程 2021-04-28 wyw  add*/
		
		if($is_pdf==0){
			$this->error('生成申报书已关闭！');
		}

        foreach ($ids as $id) {

            pdf($id);
        }
    
        $this->success();
    }

    //省级审核
    public function updateCheckstatus()
    {
        $id = input('id');
        $checkstatus1 = input('checkstatus1');
        $check1_remark = input('check1_remark');
        Db::name('entry_work')->where('id', '=', $id)->update(['checkstatus1' => $checkstatus1, 'check1_remark' => $check1_remark, 'check1_time' => time()]);

        // 返回上一个待审核的作品ID
        $prevWaitAuditWorkId = Db::name('entry_work')->where('checkstatus1', '=', 0)->order('id asc')->limit(1)->value('id');
        $this->success('审核提交成功', null, $prevWaitAuditWorkId);
    }

    //内部专用生成批量申报书
    public function batchAllPdf()
    {
        $ids = Db::name('entry_work')->where('submitto', '=', 1)->field('id')->select();
        if (empty($ids)) {
            $this->error('参数错误');
        }
        foreach ($ids as $k => &$v) {
            pdf($ids[$k]['id']);
        }
        $this->success('PDF批量生成完成');
    }

    /**
     * 导出所有终评作品专家评分，针对终评阶段.
     */
    public function exportGrade()
    {
      $map=[];
//      $map[] = ['zj_audit2', '=', 1];
//      $map[] = ['zj_audit3', '=', 0];
      if(input('unit')==='college') {
        $map[] = ['contestants','=',14];
      }

      $subList = $this->model->withAvg('grade_chusai', 'totalscore')->where('checkstatus1=1')->where($map)->field('id,grade_chusai_avg,workcode,title,declaration_group,works_category,name,creator_designer,creator_tel,creator_email,contact_person,contact_tel,contact_email,address');

      $list = $subList->order('grade_chusai_avg desc,id desc')->select()->toArray();

      foreach ($list as &$item) {
        $item['grade_chusai_avg'] = round($item['grade_chusai_avg'],2);
        $lists = Db::name('entry_work')->where('id',$item['id'])->find();
            $workcity = Db::name('cate')->where('id',$lists['city'])->find();
            $workcontestants = Db::name('cate')->where('id',$lists['contestants'])->find();
            $works_category = Db::name('cate')->where('id',$lists['works_category'])->find();
            $declaration_group = Db::name('cate')->where('id',$lists['declaration_group'])->find();
            $item['city'] = $workcity['title'];
            $item['declaration_group'] = $declaration_group['title'];
            $item['contestants'] = $workcontestants['title'];
            $item['works_category'] = $works_category['title'];
        $expertScoreList = Db::name('grade')->where('work_id',$item['id'])->group('adminid')->field('adminid,totalscore')->order('adminid')->select();

        if(!empty($expertScoreList)) {
          $giveScoreExpertCount = count($expertScoreList);
          for ($i=0; $i < $giveScoreExpertCount; $i++) {
            $item['expert'.($i+1)]= $expertScoreList[$i]['totalscore'];
          }
        }
      }

      $this->result($list);
    }
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
