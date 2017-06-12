<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/5/26
 * Time: 11:32
 */

namespace Admin\Controller;
use Admin\Model\UserModel as UserModel;
//use Org\Net\UploadFile as UploadFile;
//use Org\Util\Image as Image;

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
            $this->data = $this->client->getOneInfo($_GET['id']);
            $this->display();
            exit();
        }

        $this->client->upUser($_POST['id'], $_POST);
        $this->success('修改成功');
    }

    // 添加用户
    public function addUser()
    {
        if (!$_POST) {
            $this->display();
            exit();
        }

        $this->client->addUser($_POST);
        $this->success('修改成功');
    }

    // 删除用户
    public function delUser()
    {
        $this->client->delUser($_GET['id']);
        $this->success('删除成功');
    }
}