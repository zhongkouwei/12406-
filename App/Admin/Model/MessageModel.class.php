<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/6/13
 * Time: 16:57
 */

namespace Admin\Model;

use Think\Model;
class MessageModel extends Model
{
    private $_m_message;

    public function _initialize()
    {
        $this->_m_message = M('message');
    }

    public function getNewMessageList()
    {
        $where['receive_id'] = $_SESSION['admin']['id'];
        $where['status'] = 0;
        $data = $this->_m_message->where($where)->order('time desc')->select();

        return $data;
    }

    public function getOneMessage()
    {
        $con['send_id'] = array('in', array($_GET['id'], $_SESSION['admin']['id']));
        $con['receive_id'] = array('in', array($_GET['id'], $_SESSION['admin']['id']));

        $data = $this->_m_message->where($con)->order('time')->limit(10)->select();

        return $data;
    }

    public function readOneAllMessage($send_id, $receive_id)
    {
        // 已查看该用户所有消息
        $con_2['send_id'] = $send_id;
        $con_2['receive_id'] = $receive_id;
        $data['status'] = 1;
        $re = $this->_m_message->where($con_2)->save($data);

        return $re;
    }

    public function send()
    {
        $data['text'] = $_POST['text'];
        $data['send_id'] = $_SESSION['admin']['id'];
        $data['receive_id'] = $_POST['id'];
        $data['time'] = date('Y-m-d H:i:s',time());;

        if(M('message')->add($data)){
            return true;
        }else{
            return false;
        }
    }


}