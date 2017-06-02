<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/12406/Public/Home/bs/css/bootstrap.min.css">
    <script src="/12406/Public/Home/bs/js/jquery.min.js"></script>
    <script src="/12406/Public/Home/bs/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <button class="btn btn-danger">用户展示页面</button>
                <a href="<?php echo U('add_user');?>" class="btn btn-success">用户添加</a>
            </div>
            <table class="table table-bordered table-hovered">
                <th>ID</th>
                <th>NAME</th>
                <th>PASS</th>
                <th>TIME</th>
                <th>DEL</th>
                <th>EDIT</th>
                <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($info[id]); ?></td>
                        <td><?php echo ($info[username]); ?></td>
                        <td><?php echo ($info[userpassword]); ?></td>
                        <td><?php echo (date("Y-m-d H:i",$info[time])); ?></td>
                        <td><a href="<?php echo U('del',array('id'=> $info[id]));?>">删除</a></td>
                        <td><a href="<?php echo U('edit',array('id'=> $info[id]));?>">修改</a></td>
                        <td></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <div class="panel-footer">
                页脚
            </div>
        </div>
    </div>
</body>
</html>