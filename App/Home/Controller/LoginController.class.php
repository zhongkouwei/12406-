<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $this->display();
    }
 
	public function login()
	 {
        if(session('login')=='is_login')$this->success('你已登录',U('Home/Index/index'));
	 	else if(IS_POST)
        {
            $data=$_POST;
            $username = I('post.name');
            $userpassword = I('post.password');

            $count=D("user")->where(array('userName'=>$username))->count();
            // var_dump($data);
            // var_dump($count);

            if($count)
            {
            	$result=D("user")->where(array('userName'=>$username))->field('userPassword')->find();
                // var_dump($result);
            	if($result['userpassword']==I('post.password'))
            	{
            		session('username',$username);
                    //session(array('login'=>'is_login','expire'=>1800));
                    session('login','is_login');
            		$this->success('登录成功',U('Home/Index/index'),0);
            	}
                else{
                	$this->error('密码错误');
                }
            }
            else
            {
                $this->error('用户名不存在');
            }
        }
        else
        {
            $this->display();
        }
	 }

	 /**
	  * 退出登录
	  * @return no 
	  */
	 public function logout()		{
	 	session('username',null);
        session('login',null);
	 	$this->success('退出成功',U('Home/Login/index'));
	 }

     //注册
    public function register(){
        // 判断提交方式 做不同处理
        if (IS_POST) {
            // 实例化User对象
            $user = D('users');
            // 自动验证 创建数据集
            if (!$data = $user->create()) {
                // 防止输出中文乱码
                header("Content-type: text/html; charset=utf-8");
                exit($user->getError());
            }
            //插入数据库
            if ($id = $user->add($data)) {
                /* 直接注册用户为超级管理员,子用户采用邀请注册的模式,
                   遂设置公司id等于注册用户id,便于管理公司用户*/
                $user->where("userid = $id")->setField('companyid', $id);
                $this->success('注册成功', U('Index/index'), 2);
            } else {
                $this->error('注册失败');
            }
        } else {
            $this->display();
        }
    }

    //自动登录
    public function DoLogin(){
        $Key="phpsafe";
        session_start();
        if($_POST['username'] == 'phpsafe' && $_POST['password'] == '123456'){
            //登录成功
            $User['id']            = 1;        //用户id
            $User['name']          = 'phsafe.com';    //用户显示名称
            $_SESSION['UserInfo']  = $User;
            //如果选中记住我，就将登录信息放入Cookie中
            if($_POST['check'] == '1'){
                //将登录信息，存放在Cookie中
                $Value = serialize($User);            
                $Str   = md5($value.$Key);
                setcookie('Login', $Str . $Value,time()+60*60*24*30,'/');
            }
            $this->redirect('Index');
        }else{
            echo '用户名或密码不匹配';
        }
    }

    public function yzm(){
        $Verify = new \Think\Verify();
        // 使用背景图像
        $Verify->useImgBg=true;
        // 是否干扰线
        $Verify->useCurve=false;
        // 是否使用小点
        $Verify->useNoise=false;
        $Verify->entry();
     }

     function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);                                  
    }

    public function yzm1(){
        if (IS_POST) {
            # code...
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";

            if ($this->check_verify($_POST['code'])) {
                echo "正确";
            }else{
                echo "错误";
            }
        }else{
        $this->display();

        }
    }
}