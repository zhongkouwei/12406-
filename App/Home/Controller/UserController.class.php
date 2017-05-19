<?php
namespace Home\Controller;
use Think\Controller;
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');//允许跨域

$AppKey = "d29eb617b00a5de597a5a32cbf21478b";

class UserxController extends Controller {
	//添加用户模块
	public function add_user(){
		
	}

	//登录检验
	public function login_check(){

	}

	//用户是否登录
	public function is_login(){

	}

	//购票模块
	public function buy(){
		
	}

	//站到站查询
	public function query1(){
		$url = "http://apis.juhe.cn/train/s2swithprice";
		$params = array(
		      "start" => "",//出发站
		      "end" => "",//终点站
		      "key" => $appkey,//应用APPKEY(应用详细页查询)
		      "dtype" => "",//返回数据的格式,xml或json，默认json
		);
		$paramstring = http_build_query($params);
		$content = juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
		    if($result['error_code']=='0'){
		        print_r($result);
		    }else{
		        echo $result['error_code'].":".$result['reason'];
		    }
		}else{
		    echo "请求失败";
		}
	}

	//12406订票，车次票价查询
	public function order(){
		$url = "http://apis.juhe.cn/train/ticket.price.php";
		$params = array(
		      "train_no" => "",//列次编号，对应12306订票①：查询车次中返回的train_no
		      "from_station_no" => "",//出发站序号，对应12306订票①：查询车次中返回的from_station_no
		      "to_station_no" => "",//出发站序号，对应12306订票①：查询车次中返回的to_station_no
		      "date" => "",//默认当天，格式：2014-12-25
		      "key" => $appkey,//应用APPKEY(应用详细页查询)
		);
		$paramstring = http_build_query($params);
		$content = juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
		    if($result['error_code']=='0'){
		        print_r($result);
		    }else{
		        echo $result['error_code'].":".$result['reason'];
		    }
		}else{
		    echo "请求失败";
		}
	}

	//车次查询
	public function query2(){
		$url = "http://apis.juhe.cn/train/s";
		$params = array(
		      "name" => "",//车次名称，如：G4
		      "key" => $appkey,//应用APPKEY(应用详细页查询)
		      "dtype" => "",//返回数据的格式,xml或json，默认json
		);
		$paramstring = http_build_query($params);
		$content = juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
		    if($result['error_code']=='0'){
		        print_r($result);
		    }else{
		        echo $result['error_code'].":".$result['reason'];
		    }
		}else{
		    echo "请求失败";
		}
	}

	//站到站查询
	public function query3(){
		$url = "http://apis.juhe.cn/train/s2s";
		$params = array(
		      "start" => "",//出发站
		      "end" => "",//终点站
		      "traintype" => "",//列车类型，G-高速动车 K-快速 T-空调特快 D-动车组 Z-直达特快 Q-其他
		      "key" => $appkey,//应用APPKEY(应用详细页查询)
		      "dtype" => "",//返回数据的格式,xml或json，默认json
		);
		$paramstring = http_build_query($params);
		$content = juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
		    if($result['error_code']=='0'){
		        print_r($result);
		    }else{
		        echo $result['error_code'].":".$result['reason'];
		    }
		}else{
		    echo "请求失败";
		}
	}

	//12406实时余票查询
	public function query4(){
		$url = "http://apis.juhe.cn/train/yp";
		$params = array(
		      "key" => $appkey,//应用APPKEY(应用详细页查询)
		      "dtype" => "",//返回数据的格式,xml或json，默认json
		      "from" => "",//出发站,如：上海虹桥
		      "to" => "",// 到达站,如：温州南
		      "date" => "",//出发日期，默认今日
		      "tt" => "",//车次类型，默认全部，如：G(高铁)、D(动车)、T(特快)、Z(直达)、K(快速)、Q(其他)
		);
		$paramstring = http_build_query($params);
		$content = juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
		    if($result['error_code']=='0'){
		        print_r($result);
		    }else{
		        echo $result['error_code'].":".$result['reason'];
		    }
		}else{
		    echo "请求失败";
		}
	}

	//12406订票：车次查询
	public function query5(){
		$url = "http://apis.juhe.cn/train/ticket.cc.php";
		$params = array(
		      "from" => "",//出发站名称：如上海虹桥
		      "to" => "",//到达站名称：如温州南
		      "date" => "",//默认当天，格式：2014-07-11
		      "tt" => "",//车次类型，默认全部，如：G(高铁)、D(动车)、T(特快)、Z(直达)、K(快速)、Q(其他)
		      "key" => $appkey,//应用APPKEY(应用详细页查询)
		);
		$paramstring = http_build_query($params);
		$content = juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
		    if($result['error_code']=='0'){
		        print_r($result);
		    }else{
		        echo $result['error_code'].":".$result['reason'];
		    }
		}else{
		    echo "请求失败";
		}
	}

	//火车票代售点查询
	public function query6(){
		$url = "http://apis.juhe.cn/train/dsd";
		$params = array(
		      "province" => "",//省份,如：浙江
		      "city" => "",//城市，如：温州
		      "county" => "",//区/县，如：鹿城区
		      "key" => $appkey,//应用APPKEY(应用详细页查询)
		      "dtype" => "",//返回数据的格式,xml或json，默认json
		);
		$paramstring = http_build_query($params);
		$content = juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
		    if($result['error_code']=='0'){
		        print_r($result);
		    }else{
		        echo $result['error_code'].":".$result['reason'];
		    }
		}else{
		    echo "请求失败";
		}
	}

	//列车站点列表
	public function train_id(){
		$url = "http://apis.juhe.cn/train/station.list.php";
		$params = array(
		      "key" => $appkey,//应用APPKEY(应用详细页查询)
		      "dtype" => "",//返回数据的格式,xml或json，默认json
		);
		$paramstring = http_build_query($params);
		$content = juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
		    if($result['error_code']=='0'){
		        print_r($result);
		    }else{
		        echo $result['error_code'].":".$result['reason'];
		    }
		}else{
		    echo "请求失败";
		}
	}


 // * 请求接口返回内容
 // * @param  string $url [请求的URL地址]
 // * @param  string $params [请求的参数]
 // * @param  int $ipost [是否采用POST形式]
 // * @return  string
	public function juhecurl($url,$params=false,$ispost=0){
	    $httpInfo = array();
	    $ch = curl_init();
	 
	    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
	    curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
	    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
	    curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
	    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    if( $ispost )
	    {
	        curl_setopt( $ch , CURLOPT_POST , true );
	        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
	        curl_setopt( $ch , CURLOPT_URL , $url );
	    }
	    else
	    {
	        if($params){
	            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
	        }else{
	            curl_setopt( $ch , CURLOPT_URL , $url);
	        }
	    }
	    $response = curl_exec( $ch );
	    if ($response === FALSE) {
	        //echo "cURL Error: " . curl_error($ch);
	        return false;
	    }
	    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
	    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
	    curl_close( $ch );
	    return $response;
	}
}

?>