<?php
namespace app\index\controller;
use think\Controller;
class Login extends Controller{
	//注册
    public function index()
    {
    	return $this->fetch();
    }
    public function do_register(){
    	$db=db('mianshi');
    	$info=input('post.');
    	$name=$info['username'];
    	$cou=$db->where('username="'.$name.'"')->find();
    	if($cou){
    		$data=[
    			'status'=>4,
    			'msg'=>'用户名已存在'
    		];
    		return $data;
    	}
    	if($info['password']!=$info['repassword']){
    		$data=[
    			'status'=>2,
    			'msg'=>'两次密码不一致'
    		];
    		return $data;
    	}
    	unset($info['repassword']);
    	$info['password']=md5($info['password']);
    	$arr=$db->insert($info);
    	if($arr){
    		$data=[
    			'status'=>1,
    			'msg'=>'注册成功'
    		];
    		return $data;
    	}else{
    		$data=[
    			'status'=>3,
    			'msg'=>'注册失败'
    		];
    		return $data;
    	}
    	
    }

    //登录
    public function login(){
        if(!empty($_COOKIE['username'])){
            session('username',$_COOKIE['username']);
        }
        if(session('username')!=''){
            $this->redirect('Index/index');
        }
        return $this->fetch();
    }
    public function do_login(){
    	$info=input('post.');
        // return $info;
    	$db=db('mianshi');
    	$username=$info['username'];
    	$arr=$db->where('username="'.$username.'"')->find();
    	if($arr){
    		if(md5($info['password'])==$arr['password']){
    			session("username",$username);
                if(!empty($info['yonghu'])){
                    cookie('username',$username,3600);
                }
                // echo "succ";
                $data=[
    				'status'=>1,
    				'msg'=>'succ'
    			];
    		}else{
    			$data=[
    				'status'=>2,
    				'msg'=>'密码错误'
    			];
                // echo "password";
    		}
    	}else{
    		$data=[
    			'status'=>3,
    			'msg'=>'用户不存在'
    		];
            // echo "user";
    	}

    	return $data;
    }

    //列表
    public function lists(){
    	$db=db('mianshi');
    	$list=$db->select();
    	$this->assign('list',$list);
    	return $this->fetch();
    }
}
