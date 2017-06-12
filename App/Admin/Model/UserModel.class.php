<?php

/**
 * Created by PhpStorm.
 * User: gaoshuo1996
 * Date: 2017/5/28
 * Time: 15:35
 */
namespace Admin\Model;

use Think\Model;

class UserModel extends Model
{
    private static $_m_user;

    public function __construct()
    {
        if(self::$_m_user == null){
            self::$_m_user = M('user');
        }
    }

    public function getUserList()
    {
        $result = self::$_m_user->select();

        return $result;
    }

    public function upUser($id, $data)
    {
        if (empty($data['userPassword']))
            unset($data['userPassword']);

        self::$_m_user->where('userId='.$id)->save($data);
    }

    public function delUser($id)
    {
        self::$_m_user->where('userId='.$id)->delete();
    }

    public function addUser($data)
    {
        self::$_m_user->add($data);
    }

    public function getOneInfo($id)
    {
        $result = self::$_m_user->where('userId='.$id)->select();

        return $result;
    }
}