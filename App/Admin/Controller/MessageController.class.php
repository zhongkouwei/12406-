<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/6/13
 * Time: 16:42
 */

namespace Admin\Controller;

use Admin\Model\MessageModel;

class MessageController extends CommonController
{
    private $client;

    public function _initialize()
    {
        $this->client = new MessageModel();
    }
    // 所有消息用户列表
    public function messageList(){
        $user=M('user');
        $data=$user->select();
        $this->assign('data',$data);
        $this->display();


    }

    // 未读消息列表
    public function newmessageList(){
        $data = $this->client->getNewMessageList();
        $user = M('user');
        foreach ($data as $key =>$val){
            $name = $user->where('userid='.$data[$key]['send_id'])->getField('username');
            $data[$key]['send_name'] = $name;
        }
        $this->data = $data;
        $this->display();
    }


    // 某用户消息记录
    function sendMessage(){
        $condition['userid'] = $_GET['id'];
        $name = M('user')->field('username')->where($condition)->find();
        $this->id = $_GET['id'];
        $this->name = $name['username'];

        $this->data = $this->client->getOneMessage();

        $re = $this->client->readOneAllMessage($_GET['id'], $_SESSION['admin']['id']);

        $this->display();

    }

    // 发送
    function send(){
        if($re = $this->client->send()){
            $this->success('发送成功');
        }else{
            $this->error('发送失败');
        }
    }
}