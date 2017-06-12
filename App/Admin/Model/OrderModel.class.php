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
        $result = $this->_m_order->select();

        return $result;
    }

    public function sendOut()
    {

    }
}