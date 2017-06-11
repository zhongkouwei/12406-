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
class TicketController extends CommonController{
    public function __construct(){
        parent::__construct();
        $this->client = new TicketModel();
    }

    //站到站查询
    public function station(){
        if(!$_POST){
           	$this->display();
        }else{
        	$start=I('post.start');
        	$end=I('post.end');
        	$date=I('post.date');
	        $data = $this->client->query1($start,$end,$date);
	        $data = $data['result']['list'];
	        $train_list = array(
	            'yingzuo' => '——',
	            'yingzuo_p' =>'',
	            'yingwo'  => '——',
	            'yingwo_p'  =>'',
	            'ruanwo'  => '——',
	            'ruanwo_p'  => '',
	            'erdeng'  => '——',
	            'erdeng_p'  => '',
	            'yideng'  => '——',
	            'yideng_p'  => '',	            
	            'tedeng'  => '——',
	            'tedeng_p'  => '',
	            'shangwu' => '——',
	            'shangwu_p' => '',
	            'ruanwo'  => '——',
	            'ruanwo_p'  => '',
	            'ruanzuo' => '——',
	            'ruanzuo_p' => '',
	            'wuzuo'   => '——',
	            'wuzuo_p'   => '',
	            'gaojiruanwo' => '——',
	            'gaojiruanwo_p' => '',
	        );
	        foreach ($data as $key => $val) {
	            array_push($data[$key], $train_list);
	            foreach ($val['price_list'] as $k => $v) {
	                if ($v['price_type'] == '硬座') {
	                    $data[$key][0]['yingzuo'] = '有';
	                    $data[$key][0]['yingzuo_p'] = $v['price'];
	                } elseif ($v['price_type'] == '硬卧') {
	                    $data[$key][0]['yingwo'] = '有';
	                    $data[$key][0]['yingwo_p'] = $v['price'];
	                } elseif ($v['price_type'] == '软卧') {
	                    $data[$key][0]['ruanwo'] = '有';
	                    $data[$key][0]['ruanwo_p'] = $v['price'];
	                } elseif ($v['price_type'] == '二等座') {
	                    $data[$key][0]['erdeng'] = '有';
	                    $data[$key][0]['erdeng_p'] = $v['price'];
	                } elseif ($v['price_type'] == '一等座') {
	                    $data[$key][0]['yideng'] = '有';
	                    $data[$key][0]['yideng_p'] = $v['price'];
	                } elseif ($v['price_type'] == '特等座') {
	                    $data[$key][0]['tedeng'] = '有';
	                    $data[$key][0]['tedeng_p'] = $v['price'];
	                } elseif ($v['price_type'] == '商务座') {
	                    $data[$key][0]['shangwu'] = '有';
	                    $data[$key][0]['shangwu_p'] = $v['price'];
	                } elseif ($v['price_type'] == '软座') {
	                    $data[$key][0]['ruanzuo'] = '有';
	                    $data[$key][0]['ruanzuo_p'] = $v['price'];
	                } elseif ($v['price_type'] == '软卧') {
	                    $data[$key][0]['ruanwo'] = '有';
	                    $data[$key][0]['ruanwo_p'] = $v['price'];
	                } elseif ($v['price_type'] == '无座') {
	                    $data[$key][0]['wuzuo'] = '有';
	                    $data[$key][0]['wuzuo_p'] = $v['price'];
	                } elseif ($v['price_type'] == '高级软卧') {
	                    $data[$key][0]['gaojiruanwo'] = '有';
	                	$data[$key][0]['gaojiruanwo_p'] = $v['price'];
	                }
	            }
	        }
	        // $this->array_page($data,10);
	        $this->assign('station',$data);
	        // $this->fenye=$page->show();
	        $this->display();
	    }
	}

	//余票查询
	public function standbyt(){
        if(!$_POST){
           	$this->display();
        }else{
        	Header("Content-Type:text/html;charset=utf-8");
        	$from=I('post.from');
        	$to=I('post.to');
        	$date=I('post.date');
        	$tt=I('post.tt');
	        $data = $this->client->query4($from,$to,$date,$tt);
	        var_dump($data);
	        $this->assign('standbyt',$data);
	        // $this->fenye=$page->show();
	        $this->display();
	    }
	}

	//火车站站点查询
	public function outlets(){
		if(!$_POST){
           	$this->display();
        }else{
			Header("Content-Type:text/html;charset=utf-8");
			$province=I('post.province');
	        $city=I('post.city');
	        $country=I('post.country');
			$data = $this->client->query6($province,$city,$country);	
        	$data = $data['result'];
        	$this->assign('outlets',$data);
        	$this->display();
        }
	}

	public function trainno(){
		if(!$_POST){
           	$this->display();
        }else{
        	Header("Content-Type:text/html;charset=utf-8");
        	$tt=I('post.tt');
	        $data = $this->client->query2($tt);
	        $data = $data['result'];
	        // var_dump($data);
	        $this->assign('trainno',$data);
	        // $this->fenye=$page->show();
	        $this->display();
	    }
	}

	public function test(){
		if(!$_POST){
           	$this->display();
        }else{
        	Header("Content-Type:text/html;charset=utf-8");
        	$from=I('post.from');
        	$to=I('post.to');
        	$date=I('post.date');
        	$tt=I('post.tt');
	        $data = $this->client->query4($from,$to,$date,$tt);
	        var_dump($data);
	        $this->assign('standbyt',$data);
	        // $this->fenye=$page->show();
	        $this->display();
	    }
	}

	function array_page($array,$rows){
            import("ORG.Util.Page"); //导入分页类
            $count=count($array);
            $Page=new Page($count,$rows);
            $list=array_slice($array,$Page->firstRow,$Page->listRows);
            return $list;
	}
}
