<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/5/26
 * Time: 11:48
 */

namespace Admin\Controller;
use Think\Controller;
use Think\Image;

class LoginController extends Controller
{
    public function login()
    {
        layout(false);
        $this->display();
    }

    // 验证码
    public function verify()
    {
        import('ORG.Util.Image');
        \Org\Util\Image::buildImageVerify(4, 5, 'png', 55, 28);
    }

    public function checkLogin()
    {
        import('ORG.Util.Input');
        $input = \Input::getInstance();
        $username = $input->getVar($_POST['username']);
        $password = md5($input->getVar($_POST['password']));
        $verify = md5(strtoupper($input->getVar($_POST['verify'])));

        if($verify != $_SESSION['verify']) {
            $this->error('验证码错误', U('Login/login'));
        }
        $user = M('user');
        $condition['userName'] = $username;
        $re =  $user->field('userId, userPassword, userLevel')->where($condition)->find();
        if (empty($re)){
            $this->error('没有此用户', U('Login/login'));
        }
        if ($re['userlevel'] == 0){
            $this->error('您没有管理员权限', U('Login/login'));
        }
        if($password != $re['userpassword']){
            $this->error('密码错误', U('Login/login'));
        }

        $_SESSION['admin']['id'] = $re['userid'];
        $_SESSION['admin']['userName'] = $username;
        $this->redirect('Index/index');

    }

    public function logout()
    {
        session_destroy();
        $this->redirect('Login/login');
    }
}