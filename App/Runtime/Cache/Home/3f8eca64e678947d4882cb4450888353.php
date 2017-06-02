<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>站到站查询</title>
	<link rel="stylesheet" href="/12406/Public/Home/bs/css/bootstrap.min.css">
    <script src="/12406/Public/Home/bs/js/jquery.min.js"></script>
    <script src="/12406/Public/Home/bs/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1 class="page-header">站到站查询</h1>
	    起始站：<input type="text" class="form-control" name="start" placeholder="不需要填写站，如北京">
		终点站：<input type="text" class="form-control" name="end" placeholder="不需要填写站，如天津">
		日期：<input type="text" class="form-control" name="date" placeholder="默认格式：2017-06-03,默认为明天">
		<input type="reset" style="float:right;margin:5px" class="btn btn-success" value="重置">
		<input type="submit" style="float:right;margin:5px" class="btn btn-success" value="查询">
		<table class='table table-striped table-bordered table-hover'>
			<tr>
				<th>车次</th>
				<th>起始站<br>终点站</th>
				<th>起始时间<br>终止时间</th>
			 	<th>历时</th>
			 	<th>商务座</th>
			 	<th>特等座</th>
			 	<th>一等座</th>
			 	<th>二等座</th>
			 	<th>高级<br>软卧</th>
			 	<th>软卧</th>
			 	<th>硬卧</th>
			 	<th>软座</th>
			 	<th>硬座</th>
			 	<th>无座</th>
			</tr>	
			<?php if(is_array($station)): $i = 0; $__LIST__ = $station;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($info[train_no]); ?></td>
                    <td>
                    <strong><?php echo ($info[start_station]); ?></strong>
                    <strong><?php echo ($info[end_station]); ?></strong>
                    </td>
                    <td>                   
                    <strong><?php echo ($info[start_time]); ?></strong>
                    <strong><?php echo ($info[end_time]); ?></strong>
                    </td>
                    <td><?php echo ($info[run_time]); ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
	</div>
	
</body>
</html>