<?php
class IndexAction extends Action {
    private function isLogin(){
        $u = I('post.user');
        $p = md5(I('post.pass'));
        $ret = M('user')->where('username="%s" and password="%s"',$u,$p)->getField('id');
        if(!$ret)$this->ajaxReturn(0,"用户名或密码错误!",0);
        return (int)$ret;
    }
    public function login(){
        $u = $this->isLogin();
        $this->ajaxReturn($u,"登录成功!",1);
    }
    public function register(){
        $u = I('post.user');
        $p = I('post.pass');
        $m = I('post.mobile');
        $a = I('post.address');
        if(!($u&&$p))$this->ajaxReturn(0,"用户名或密码不能为空!",0);
        $p = md5($p);
        $ret = M('user')->add(array('username'=>"$u",'password'=>"$p",'mobile'=>"$m",'address'=>"$a"));
        if(!$ret)$this->ajaxReturn(0,"用户名已存在,请尝试找回密码!",0);
        $this->ajaxReturn((int)$ret,"注册成功!",1);
    }
    public function generateOrder(){
        $u = $this->isLogin();
        $arr = I('post.');
        unset($arr['id']);
        unset($arr['uid']);
        $arr['uid'] = $u;
        $arr['datetime'] = date("Y-m-d H:i:s");
        $ret = M('order')->add($arr);
        if(!$ret)$this->ajaxReturn(0,"请检查所有字段是否填写完整!",0);
        M('logistics')->add(array('oid'=>"$ret",'uid'=>"$u",'datetime'=>"$arr[datetime]"));
        $this->ajaxReturn((int)$ret,"生成成功!",1);
    }
    public function appendLogistics(){
        $u = $this->isLogin();
        $oid = (int)I('post.oid');
        if(!$oid)$this->ajaxReturn(0,"无效的订单id!",0);
        $datetime = date("Y-m-d H:i:s");
        $ret = M('logistics')->add(array('oid'=>"$oid",'uid'=>"$u",'datetime'=>"$datetime"));
        if(!$ret)$this->ajaxReturn(0,"物流信息追加失败,可能是已经追加过了,请勿重复操作!",0);
        $this->ajaxReturn((int)$ret,"追加成功!",1);
    }
    public function getOrder(){
        $u = $this->isLogin();
        $oid = (int)I('post.oid');
        $ret = M('order')->find($oid);
        if(!$ret)$this->ajaxReturn(0,"无效的订单id!",0);
        $tmp = M('logistics')->where('oid = %d',$ret['id'])
        ->join('LEFT JOIN __USER__ ON __LOGISTICS__.uid = __USER__.id')
        ->order('datetime desc')->select();
        foreach($tmp as $i){
            $ret['content'] .= "快递员【$i[username]】在【$i[address]】于【$i[datetime]】签收\n";
        }
        $this->ajaxReturn($ret,"获取成功!",1);
    }
    public function getList(){
        $u = $this->isLogin();
        $ret = M('order')->where("uid = %d",$u)->field('id,express,datetime')->select();
        if(!$ret)$this->ajaxReturn(0,"没有记录!",0);
        $this->ajaxReturn($ret,"获取成功!",1);
    }
}