<?php
namespace app\index\controller;
use think\Controller;
use app\index\controller\Common;

class Index extends Common{
	
    public function index()
    {
        print_r($_COOKIE);
        $this->assign('username',session('username'));
    	return $this->fetch();
    }
    public function des(){
        $_SESSION = array(); //清除SESSION值.  
          if(isset($_COOKIE["username"])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.  
                setcookie('username','',time()-1,'/');  
            }  
        session_destroy();  //清除服务器的sesion文件  
        return $this->redirect('Login/login');
    }   
}
