<?php
class BaseAction extends Action
{
    public $isAgent;
    public $home_theme;
    public $reg_needCheck;
    public $minGroupid;
    public $reg_validDays;
    public $reg_groupid;
    public $thisAgent;
    public $agentid;
    public $adminMp;
    public $siteUrl;
    public $isQcloud = false;
    protected function _initialize()
    {
		/*Vendor('tongji.hm');
        $_hmt = new _HMT("d804bbf6e06872863e6110c106c5ac63");
        $_hmtPixel = $_hmt->trackPageView();
        $this->assign('hmtPixel', $_hmtPixel);*/
        if ($this->_get('openId') != NULL) {
            $this->isQcloud = true;
            if (session('isQcloud') == NULL) {
                session('isQcloud', true);
            }
        }
        define('RES', THEME_PATH . 'common');
        define('STATICS', TMPL_PATH . 'static');
        $this->assign('action', $this->getActionName());
        $this->isAgent = 0;
        if (C('agent_version')) {
            $thisAgent = M('agent')->where(array('siteurl' => 'http://' . $_SERVER['HTTP_HOST']))->find();
            if ($thisAgent) {
                $this->isAgent = 1;
            }
        }
        if (!$this->isAgent) {
            $this->agentid = 0;
            if (!C('site_logo')) {
                $f_logo = 'tpl/Home/WgCms/common/images/logo-WgCms.png';
            } else {
                $f_logo = C('site_logo');
            }
            $f_siteName = C('SITE_NAME');
            $f_siteTitle = C('SITE_TITLE');
            $f_metaKeyword = C('keyword');
            $f_metaDes = C('content');
            $f_qq = C('site_qq');
            $f_ipc = C('ipc');
            $f_qrcode = 'tpl/Home/WgCms/common/images/ewm2.jpg';
            $f_siteUrl = C('site_url');
            $this->home_theme = C('DEFAULT_THEME');
            $f_regNeedMp = C('reg_needmp') == 'true' ? 1 : 0;
            $this->reg_needCheck = C('ischeckuser') == 'false' ? 1 : 0;
            $this->minGroupid = 1;
            $this->reg_validDays = C('reg_validdays');
            $this->reg_groupid = C('reg_groupid');
            $this->adminMp = C('site_mp');
        } else {
            $this->agentid = $thisAgent['id'];
            $this->thisAgent = $thisAgent;
            $f_logo = $thisAgent['sitelogo'];
            $f_siteName = $thisAgent['sitename'];
            $f_siteTitle = $thisAgent['sitetitle'];
            $f_metaKeyword = $thisAgent['metakeywords'];
            $f_metaDes = $thisAgent['metades'];
            $f_qq = $thisAgent['qq'];
            $f_qrcode = $thisAgent['qrcode'];
            $f_siteUrl = $thisAgent['siteurl'];
            $f_ipc = $thisAgent['copyright'];
            $this->home_theme = C('DEFAULT_THEME');
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/tpl/Home/' . 'agent_' . $thisAgent['id'])) {
                $this->home_theme = 'agent_' . $thisAgent['id'];
            }
            $f_regNeedMp = $thisAgent['regneedmp'];
            $this->reg_needCheck = $thisAgent['needcheckuser'];
            $minGroup = M('User_group')->where(array('agentid' => $thisAgent['id']))->order('id ASC')->find();
            $this->minGroupid = $minGroup['id'];
            $this->reg_validDays = $thisAgent['regvaliddays'];
            $this->reg_groupid = $thisAgent['reggid'];
            $this->adminMp = $thisAgent['mp'];
        }
        $this->siteUrl = $f_siteUrl;
        $this->assign('f_logo', $f_logo);
        $this->assign('f_siteName', $f_siteName);
        $this->assign('f_siteTitle', $f_siteTitle);
        $this->assign('f_metaKeyword', $f_metaKeyword);
        $this->assign('f_metaDes', $f_metaDes);
        $this->assign('f_qq', $f_qq);
        $this->assign('f_qrcode', $f_qrcode);
        $this->assign('f_siteUrl', $f_siteUrl);
        $this->assign('f_regNeedMp', $f_regNeedMp);
        $this->assign('f_ipc', $f_ipc);
        $this->assign('reg_validDays', $this->reg_validDays);
    }
    protected function all_insert($name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->add();
            if ($id) {
                $m_arr = array('Img', 'Text', 'Voiceresponse', 'Ordering', 'Lottery', 'Host', 'Product', 'Selfform', 'Panorama', 'Wedding', 'Vote', 'Estate', 'Reservation', 'Greeting_card');
                if (in_array($name, $m_arr)) {
                    $data['pid'] = $id;
                    $data['module'] = $name;
                    $data['token'] = session('token');
                    $data['keyword'] = $_POST['keyword'];
                    M('Keyword')->add($data);
                }
                $this->success('操作成功', U(MODULE_NAME . $back));
            } else {
                $this->error('操作失败', U(MODULE_NAME . $back));
            }
        }
    }
    protected function insert($name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->add();
            if ($id == true) {
                $this->success('操作成功', U(MODULE_NAME . $back));
            } else {
                $this->error('操作失败', U(MODULE_NAME . $back));
            }
        }
    }
    protected function save($name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->save();
            if ($id == true) {
                $this->success('操作成功', U(MODULE_NAME . $back));
            } else {
                $this->error('操作失败', U(MODULE_NAME . $back));
            }
        }
    }
    protected function all_save($name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->save();
            if ($id) {
                $m_arr = array('Img', 'Text', 'Voiceresponse', 'Ordering', 'Lottery', 'Host', 'Product', 'Selfform', 'Panorama', 'Wedding', 'Vote', 'Estate', 'Reservation', 'Carowner', 'Carset');
                if (in_array($name, $m_arr)) {
                    $data['pid'] = $_POST['id'];
                    $data['module'] = $name;
                    $data['token'] = session('token');
                    $da['keyword'] = $_POST['keyword'];
                    M('Keyword')->where($data)->save($da);
                }
                $this->success('操作成功', U(MODULE_NAME . $back));
            } else {
                $this->error('操作失败', U(MODULE_NAME . $back));
            }
        }
    }
    protected function del_id($name = '', $jump = '')
    {
        $name = $name ? $name : MODULE_NAME;
        $jump = empty($name) ? MODULE_NAME . '/index' : $jump;
        $db = D($name);
        $where['id'] = $this->_get('id', 'intval');
        $where['token'] = session('token');
        if ($db->where($where)->delete()) {
            $this->success('操作成功', U($jump));
        } else {
            $this->error('操作失败', U(MODULE_NAME . '/index'));
        }
    }
    protected function all_del($id, $name = '', $back = '/index')
    {
        $name = $name ? $name : MODULE_NAME;
        $db = D($name);
        if ($db->delete($id)) {
            $this->ajaxReturn('操作成功', U(MODULE_NAME . $back));
        } else {
            $this->ajaxReturn('操作失败', U(MODULE_NAME . $back));
        }
    }
    //统计账号数据
    public function statistical($type,$aid){
        switch ($type) {
            case 'agentred'://代理点红色咪豆

                $return = M('Distribution_earning')->where(array('gid'=>$aid))->sum('red');
                break;
            case 'green'://绿色咪豆
                $return = M('Distribution_earning')->where(array('aid'=>$aid))->sum('green');
                break;
            case 'red'://红色咪豆
                $return = M('Distribution_earning')->where(array('aid'=>$aid,'gid'=>0))->sum('red');
                break;
            case 'black'://黑色咪豆

                $return = M('Distribution_earning')->where(array('aid'=>$aid))->sum('black') - M('Distribution_applystore')->where(array('aid'=>$aid))->sum('money')/100;
                break;
            case 'totalgreen'://绿色总咪豆

                $return = M('Distribution_earning')->where(array('aid'=>$aid,'green'=>array('gt',0)))->sum('green');
                break;
            case 'totalred'://红色总咪豆

                $return = M('Distribution_earning')->where(array('aid'=>$aid,'red'=>array('gt',0)))->sum('red');
                break;
            case 'totalblack'://黑色总咪豆

                $return = M('Distribution_earning')->where(array('aid'=>$aid,'black'=>array('gt',0)))->sum('black');
                break;
            case 'ordernums'://处理订单数
                $return = M('Product_cart')->where(array('bindaid'=>$aid,'paid'=>1))->count();
                break;
            case 'shoporders'://购买订单总数
                $return = M('Product_cart')->where(array('aid'=>$aid,'paid'=>1))->count();
                break;
            case 'totalearn'://总收入
                break;
            case 'gold'://金币
                break;
            case 'applymoney'://已提现
                $return = M('Distribution_applystore')->where(array('aid'=>$aid,'status'=>2))->sum('money')/100;
                break;
        }
        return $return;
    }
    //金币和现金收入支出记录
    public function earnRecord($aid,$oid,$mid,$green,$red,$black,$status,$ip='',$gid = 0,$fromid = 0,$fromgid = 0,$remark){
        if($aid > 0){
            if($green != 0){
                D('Account')->where('id='.$aid)->setInc('green',$green);
            }
            if($red != 0){
                D('Account')->where('id='.$aid)->setInc('red',$red);
            }
            if($black != 0){
                D('Account')->where('id='.$aid)->setInc('black',$black);
            }
            if($black > 0 ){
                $ldb = M('LevelOrders');
                $list = $ldb->where('aid='.$aid)->order('addtime asc')->select();
                foreach ($list as $k => $v) {
                    if($v['black'] < $v['green']){
                        $need = $v['green'] - $v['black'];
                        if($black > $need){
                            $ldb->where('id='.$v['id'])->setInc('black',$need);
                            $black = $black - $need;
                        }else{
                            $ldb->where('id='.$v['id'])->setInc('black',$black);
                            break;
                        }
                    }
                }
            }
        }
        //返公司红色咪豆的时候操作
        if($aid == -1 && $red > 0){
            $branch_db = M('Company_branch');
            $branch_records_db = M('Company_branch_records');
            $company_branch = $branch_db->select();
            foreach ($company_branch as $k => $v) {
                $bred =  $red * $v['proportion'] / 100;
                $data = array(
                    'cbid' => $v['id'],
                    'aid' => $fromid,
                    'red' => $bred,
                    'status' => 1,
                    'addtime' => time(),
                    'year' => date('Y',time()),
                    'month' => date('m',time()),
                    'day' => date('d',time()),
                );
                $branch_db->where(array('id'=>$v['id']))->setInc('red',$bred);
                $branch_records_db->add($data);
            }
        }
        if($gid > 0){
            if($red != 0){
                M('Distribution_agent')->where('id='.$gid)->setInc('red',$red);
            }
        }
        $earndb = M('Distribution_earning');
        $data = array(
            'ip' => $ip,
            'aid' => $aid,
            'oid' => $oid,
            'mid' => $mid,
            'fromid' => $fromid,
            'fromgid' => $fromgid,
            'gid' => $gid,
            'green' => $green,
            'red' => $red,
            'black' => $black,
            'remark' => $remark,
            'status' => $status,
            'addtime' => time(),
            'year' => date('Y',time()),
            'month' => date('m',time()),
            'day' => date('d',time()),
        );
        return $earndb->add($data);
    }
    //判断会员金币余额
    public function myGold($pay,$aid){
        $db = M('Distribution_earning');
        $gold = $db->where(array('aid'=>$aid))->sum('green');
        if($gold < $pay){
            return false;
        }else{
            return true;
        }
    }
    //判断账号是否存在
    public function isExists($username){
        $db = M('distribution_account');
        $account = $db->where(array('username'=>$username,'delete'=>0))->find();
        if($account){
            return $account['id'];
        }else{
            return false;
        }
    }
}