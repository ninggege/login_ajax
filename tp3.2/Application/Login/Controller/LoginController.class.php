<?php
namespace Login\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {
    	if(!empty($_COOKIE['username'])){
    		session('username',$_COOKIE['username']);
    	}
    	if(session('username')!=''){
    		$this->redirect('Index/index');
    	}
    	return $this->display('index');
    }
    public function do_login(){
    	$da=I('post.');
    	$username=I('post.username');
    	// $password=md5(md5(I('post.password')).'abc');//双重加密
    	$password=md5(I('post.password'));
    	$db=M("mianshi");
    	$info=M("mianshi")->where("username='".$username."'")->find();
    	if($info){
    		if($password==$info['password']){
    			session('username',$username);
    			if(!empty($da['yonghu'])){
    				cookie('username',$username,3600);
    			}
    			$data=[
	    			'status'=>1,
	    			'msg'=>'succ'
	    		];
    		}else{
    			$data=[
	    			'status'=>2,
	    			'msg'=>'密码错误'
	    		];
    		}
    	}else{
    		$data=[
    			'status'=>3,
    			'msg'=>'用户不存在'
    		];
    	}
    	$this->ajaxReturn($data);
    }
}