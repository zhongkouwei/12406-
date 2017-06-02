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
            <button class="btn btn-danger">用户修改页面</button>
            <a href="<?php echo U('index');?>" class="btn btn-success">用户展示页面</a>
        </div>
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">USER</label>
                    <input type="text" class="form-control" name="userName" value="<?php echo ($data[username]); ?>">
                </div>
                <div class="form-group">
                    <label for="">PASS</label>
                    <input type="password" class="form-control" name="userPassword" value="<?php echo ($data[userpassword]); ?>">
                    <input type="hidden" name="id" value="<?php echo ($data[id]); ?>">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="提交">
                    <input type="reset" class="btn btn-danger" value="重置">
                </div>
            </form>
        </div>
        <div class="panel-footer">
            页脚
        </div>
    </div>
</div>
</body>
</html>