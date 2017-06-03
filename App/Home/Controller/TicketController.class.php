<?php
/**
 * Created by sublime text3.
 * User: dragon
 * Date: 17-5-31
 * Time: 下午6:07
 */
namespace Home\Controller;
use Home\Model\TicketModel as TicketModel;
use Think\Controller;
class TicketController extends Controller{


    public function __construct(){
        parent::__construct();
        $this->client = new TicketModel();
    }

    public function station(){
        // if(!$_POST){
        //           echo "<script>alert('！');history.go(-1);</script>";
        //       }else
        //       {
        $data = $this->client->query1('北京','天津',post.date);
        $data = $data['result']['list'];

        $train_list = array(
            'yingzuo' => '无',
            'yingwo'  => '无',
            'ruanwo'  => '无',
            'erdeng'  => '无',
            'yideng'  => '无',
            'tedeng'  => '无',
            'shangwu' => '无',
            'ruanwo'  => '无',
            'ruanzuo' => '无',
            'wuzuo'   => '无',
            'gaojiruanwo' => '无',
        );

        foreach ($data as $key => $val) {
            array_push($data[$key], $train_list);

            foreach ($val['price_list'] as $k => $v) {
                if ($v['price_type'] == '硬座') {
                    $data[$key][0]['yingzuo'] = '有';
                } elseif ($v['price_type'] == '硬卧') {
                    $data[$key][0]['yingwo'] = '有';
                } elseif ($v['price_type'] == '软卧') {
                    $data[$key][0]['ruanwo'] = '有';
                } elseif ($v['price_type'] == '二等座') {
                    $data[$key][0]['erdeng'] = '有';
                } elseif ($v['price_type'] == '一等座') {
                    $data[$key][0]['yideng'] = '有';
                } elseif ($v['price_type'] == '特等座') {
                    $data[$key][0]['tedeng'] = '有';
                } elseif ($v['price_type'] == '商务座') {
                    $data[$key][0]['shangwu'] = '有';
                } elseif ($v['price_type'] == '软座') {
                    $data[$key][0]['ruanzuo'] = '有';
                } elseif ($v['price_type'] == '软卧') {
                    $data[$key][0]['ruanwo'] = '有';
                } elseif ($v['price_type'] == '无座') {
                    $data[$key][0]['wuzuo'] = '有';
                } elseif ($v['price_type'] == '高级软卧') {
                    $data[$key][0]['gaojiruanwo'] = '有';
                }
            }
        }

        $this->assign('station',$data);
        $this->display();
        // }
    }
}

?>