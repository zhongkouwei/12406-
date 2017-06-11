<?php 
namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller{

	// 自动登录
	public function _initialize(){
        //判断用户是否已经登录
        if (!isset($_SESSION['login'])) {
            $this->error('对不起,您还没有登录!请先登录再进行浏览', U('Login/index'), 1);
        }
    }
}


 ?>