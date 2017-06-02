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
	        // $data = $this->client->query1(post.start,post.end,post.date);
	        $this->assign('station',$data);
	        $this->display();    
        // }
	}
}

 ?>