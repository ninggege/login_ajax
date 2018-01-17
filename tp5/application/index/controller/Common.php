<?php
namespace app\index\controller;
use think\Controller;
class Common extends Controller{
	public function _initialize(){
		// echo "<pre>";
		// print_r($_COOKIE['username']);
		if(!empty($_COOKIE['username'])){
			session('username',$_COOKIE['username']);
		}
        if(session('username')==''){
            $this->redirect('Login/login');
        }
    }
}
