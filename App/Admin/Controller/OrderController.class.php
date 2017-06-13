<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/5/26
 * Time: 11:33
 */

namespace Admin\Controller;

use Admin\Model\OrderModel;
use Org\Util\Smtp;

class OrderController extends CommonController
{
    private $_client;
    public function _initialize()
    {
        $this->_client = new OrderModel();
    }

    // 订单列表
    public function ordersList()
    {
        $data = $this->_client->getOrderList();
        $this->assign('data', $data);
        $this->display();
    }

    // 历史订单
    public function oldList()
    {
        $data = $this->_client->getOldList();
        $this->data = $data;
        $this->display();
    }

    public function sendOut()
    {
        $this->_client->sendOut($_GET['id']);

        $this->success('发货成功，正在向用户发送邮件。。',U('Order/ordersList', 3));

        $user_id = M('order')->where('orderId='.$_GET['id'])->getField('userid');
        $username = M('user')->where('userId='.$user_id)->getField('username');
        $email = M('user')->where('userId='.$user_id)->getField('useremail');

        $html="您好，会员 ".$username."：<br>
		您在12406下单的火车票已完成购买。
		<br><br>*此邮件为系统自动发出的，请勿直接回复。";
        // 发送邮件
        $smtpserver = C('SMTP_SERVER');              //SMTP服务器
        $smtpserverport = C('SMTP_SERVERPORT');                      //SMTP服务器端口
        $smtpusermail = C('SMTP_USEREMAIL');      //SMTP服务器的用户邮箱
        $smtpemailto = $email;       //发送给谁
        $smtpuser = C('SMTP_USER');         //SMTP服务器的用户帐号
        $smtppass = C('SMTP_PASS');                 //SMTP服务器的用户密码
        $mailsubject = "购票通知";        //邮件主题
        $mailbody = $html;      //邮件内容
        $mailtype = "HTML";                      //邮件格式（HTML/TXT）,TXT为文本邮件
        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
        $smtp->debug = true;                     //是否显示发送的调试信息
        $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);

    }

    public function sendNo()
    {
        $this->_client->sendNo($_GET['id']);

        $this->success('操作成功，正在向用户发送邮件。。',U('Order/ordersList'), 3);

        $user_id = M('order')->where('orderId='.$_GET['id'])->getField('userid');
        $username = M('user')->where('userId='.$user_id)->getField('username');
        $email = M('user')->where('userId='.$user_id)->getField('useremail');

        $html="您好，会员 ".$username."：<br>
		您在12406下单的火车票当前无票。
		<br><br>*此邮件为系统自动发出的，请勿直接回复。";
        // 发送邮件
        $smtpserver = C('SMTP_SERVER');              //SMTP服务器
        $smtpserverport = C('SMTP_SERVERPORT');                      //SMTP服务器端口
        $smtpusermail = C('SMTP_USEREMAIL');      //SMTP服务器的用户邮箱
        $smtpemailto = $email;       //发送给谁
        $smtpuser = C('SMTP_USER');         //SMTP服务器的用户帐号
        $smtppass = C('SMTP_PASS');                 //SMTP服务器的用户密码
        $mailsubject = "购票通知";        //邮件主题
        $mailbody = $html;      //邮件内容
        $mailtype = "HTML";                      //邮件格式（HTML/TXT）,TXT为文本邮件
        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
        $smtp->debug = false;                     //是否显示发送的调试信息
        $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
    }

}