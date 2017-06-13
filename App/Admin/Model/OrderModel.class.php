<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/6/12
 * Time: 11:13
 */

namespace Admin\Model;
use Think\Model;

class OrderModel extends Model
{
    private $_m_order;

    public function __construct()
    {
        $this->_m_order = M('order');
    }

    public function getOrderList()
    {
        $result = $this->_m_order->where("status = '预定' ")->select();

        return $result;
    }

    public function getOldList()
    {
        $result = $this->_m_order->where("status != '预定' ")->select();

        return $result;
    }

    public function sendOut($id)
    {
        $this->_m_order->where('orderId ='.$id)->setField('status','完成');
    }

    public function sendNo($id)
    {
        $this->_m_order->where('orderId ='.$id)->setField('status', '无票');
    }
}