<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller
{
    //用户展示页面
    public function index(){
        //实例化数据
        $model=M('user');

        //查询数据
        $data = $model->select();

        //分配数据
        $this->assign('user',$data);

        //展示
        $this->display();
    }

    //添加用户模块
    public function add_user()
    {
        if (IS_POST) {
            $model = M('user');
            $_POST['time']=time();
            //可以返回上一次插入的ID
            if ($model->add($_POST)) {
                $this->success('添加成功', U('index'));
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->display();
        }
    }

    public function del($id){
        $model = M('user');

        //返回影响行数
        if($model->delete($id)){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    public function edit($id){
        $model = M('user');

        if(IS_POST){
//           var_dump($_POST);
            //更新数据
            //返回影响行数
            if($model->save($_POST)){
                $this->success('修改成功',U('index'));
            }else{
                $this->error('修改失败');
            }
        }else{
            //获取数据
            $data=$model->find($id);
            //        var_dump($data);
            $this->assign('data',$data);
            $this->display();
        }
    }


    //登录检验
    public function login_check()
    {

    }

    //用户是否登录
    public function is_login()
    {

    }

    //购票模块
    public function buy()
    {

    }
}

?>