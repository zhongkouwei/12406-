<?php
/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/5/26
 * Time: 11:33
 */

namespace Admin\Controller;

use Admin\Model\OrderModel;

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

}