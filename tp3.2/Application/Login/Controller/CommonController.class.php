<?php
namespace Login\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function _initialize()
    {
    	if(!empty($_COOKIE['username'])){
    		session('username',$_COOKIE['username']);
    	}
    	if(session('username')==''){
    		$this->redirect('Login/index');
    	}
    }
}