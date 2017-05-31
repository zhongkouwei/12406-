<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/5/26
 * Time: 11:40
 */

namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller
{
    public $input;

    // 构造函数
    function _initialize()
    {
        import('ORG.Util.Input');
        $this->input = \Input::getInstance();
        if(!isset($_SESSION['admin']['id']) || $_SESSION['admin']['id']==null){
            $this->error('您需要登陆', U('Login/login'));
        }
    }
}