<?php
namespace app\user\controller;
use think\Controller;
use think\Session;
use think\Db;
use think\Request;
use think\Response;
use think\helper\Time;
class Website extends CommonController
{

    public function ajax_upload()
    {
    	$request = Request::instance();
    	
    	$file = $request->file();
        if(empty($file))
        {
            $res['errcode'] = "0";
            $res['errmsg'] = "上传失败";
            return Response::create($res, 'json')->code(200);exit();
        }
    	foreach ($file as $key => $value) {
    		$k=$key;
    	}
    	$files = $request->file($k);
	    $info = $files->validate(['size'=>3145728,'ext'=>'jpg,png,jpeg,gif'])->rule('uniqid')->move('./test');

        if(!$info->getFilename()){
            $res['errcode'] = "0";
            $res['errmsg'] = "上传失败";
        }else
        {
			
			$res['errcode'] = "1";
            $res['errmsg'] = "http://function.weiyifang.com/".$info->getFilename();
			$msg = '/test/'.$info->getFilename(); 
			up_img(".".$msg,$info->getFilename());
            $res['name'] = '.'.$msg;
        }
        return Response::create($res, 'json')->code(200);
    }

}

?>
