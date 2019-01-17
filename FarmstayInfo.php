<?php
require_once "connection.php";
$SQL = "SELECT * FROM 商户 WHERE 用户名='{$_GET['id']}'";
$r = mysqli_fetch_array(mysqli_query($con, $SQL));
if ($r == null)
{
    echo "<script>alert('商户不存在')</script>";
    echo '<script>window.location.replace("userHome.php");</script>';
    exit();
}
session_start();
$_SESSION['viewing'] = $_GET['id'];
session_write_close(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $r['商户名称']; ?></title>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/normal.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <a href="userHome.php">回到主页</a>
    <div class="row">
        <div class="col-md-offset-1 col-lg-offset-1">
            <h1>
                <?php echo $r['商户名称']; ?>
                <small>好评率:<?php echo $r['商户评级']; ?>%</small>
            </h1>
            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                <p class="lead">
                    <?php echo $r['商户描述']; ?>
                </p>
                <p>地址:</p>
                <address>
                    <strong><?php echo $r['商户位置']; ?></strong><br>
                    <?php echo $r['详细地址']; ?>
                </address>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                <h4>营业执照:</h4>
                <img src="<?php echo $r['营业执照']; ?>" class="img-responsive">
            </div>
        </div>
    </div>
    <div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2 col-xs-10 col-sm-10 col-md-8 col-lg-8">
        <div class="row">
            <h3>商户照片:</h3>
            <?php
            $filesnames = scandir($r['商户照片']);
            foreach ($filesnames as $name)
            {
                if ($name != '.' and $name != '..')
                {
                    $dir = $r['商户照片'] . $name; ?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <img src="<?php echo $dir ?>" class="img-responsive col-xs-12 col-sm-12">
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <form action="functions/comment.php" method="post" enctype="multipart/form-data" class="form-horizontal">
            <fieldset>
                <legend>评价此商户</legend>
                <div class="row">
                    <div class="form-group">
                        <label for="comment">评论</label>
                        <textarea placeholder="你的评论..." name="comment" id="comment" class="form-control"
                                  rows="3"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="grade">打分</label>
                        <select name="grade" id="grade"
                                class="form-control input-lg">
                            <option value="127">好评</option>
                            <option value="0">中评</option>
                            <option value="-127">差评</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="photo">上传评论照片</label>
                        <input type="file" name="photo" accept="image/jpeg,image/png" id="photo"/>
                        <p class="help-block">仅支持不超过10M的jpg或png格式文件</p>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="评论" class="btn btn-primary btn-lg btn-block">
                </div>
            </fieldset>
        </form>
        <div class="row">
            <h3>用户评论:</h3>
            <?php
            $SQL = "SELECT * FROM 评价 WHERE 商户='{$_GET['id']}' ORDER BY 时间 DESC";
            $r = mysqli_query($con, $SQL);
            require_once "functions/comment_div.php";
            while ($comment = mysqli_fetch_array($r))
                comment_div($comment); ?>
        </div>
    </div>
</div>
</body>
</html>