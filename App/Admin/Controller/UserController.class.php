<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/5/26
 * Time: 11:32
 */

namespace Admin\Controller;
use Admin\Model\UserModel as UserModel;

class UserController extends CommonController
{
    public function _initialize()
    {
        $this->client = new UserModel();
    }

    // 用户列表
    public function usersList()
    {
        $data = $this->client->getUserList();
        $this->data = $data;
        $this->display();
    }

    // 更新用户信息
    public function editUser()
    {
        if(!$_POST){
            $this->data = $this->client->getOneInfo($_SESSION['admin']['id']);
            $this->display();
            exit();
        }

        $this->client->upUser($_POST['id'], parent::$input->getVar($_POST));
        $this->success('修改成功');
    }

    // 添加用户
    public function addUser()
    {
        $this->client->addUser($this->input->getVar($_POST));
        $this->success('修改成功');
    }

    // 删除用户
    public function delUser()
    {
        $this->client->delUser($_GET['id']);
        $this->success('删除成功');
    }
}