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
        $ret['m_user'] = '';
        foreach($tmp as $i){
            if($ret['r_address']==$i['address']){
                $ret['m_user'] = $i['username'];
                $ret['content'] .= "快递已在【$i[address]】签收，操作员【$i[username]】，时间【$i[datetime]】\n";
            }
            else
                $ret['content'] .= "快递到达【$i[address]】，操作员【$i[username]】，时间【$i[datetime]】\n";
        }
        $this->ajaxReturn($ret,"获取成功!",1);
    }
    public function getList(){
        $u = $this->isLogin();
        $ret = M('order')->where("uid = %d",$u)->field('id,express,datetime')->select();
        if(!$ret)$this->ajaxReturn(0,"没有记录!",0);
        $this->ajaxReturn($ret,"获取成功!",1);
    }
    public function addPicture(){
        $u = $this->isLogin();
        $oid = (int)I('post.oid');
        if(!$_FILES['pic']["size"])$this->ajaxReturn(0,"请上传图片!",0);
        $ret = M('order')->find($oid);
        if(!$ret)$this->ajaxReturn(0,"无效的订单id!",0);
        import('ORG.Net.Image');
        import('ORG.Net.UploadFile');
        $configs = array(
            'maxSize'=>6000000,
            'savePath'=>'./images/',
            'allowExts'=>array('jpg', 'gif', 'png' , 'bmp'),
            'autoSub'=>false
        );
        $upload = new UploadFile($configs);
        $info=$upload->uploadOne($_FILES['pic']);
        if(!$info) {// error
            $this->error($upload->getErrorMsg());
        }else{// success
            $image=$info[0]["savename"];
        }
        $ret = M('order')->where("id = %d",$oid)->setField('image',$image);
        if(!$ret)$this->ajaxReturn(0,"添加失败!",0);
        $this->ajaxReturn($ret,"添加成功!",1);
    }
}