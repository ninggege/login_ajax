<?php
namespace Login\Controller;

use Think\Controller;
class IndexController extends CommonController
{
    public function index()
    {
    	$this->assign('username',session('username'));
    	return $this->display('index');
    }
}