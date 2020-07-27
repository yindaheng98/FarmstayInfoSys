<?php
require_once "OnlineCheck_business.php";
require_once "connection.php";
$SQL = "SELECT * FROM 商户 WHERE 用户名='$id'";
$r = mysqli_fetch_array(mysqli_query($con, $SQL));
if ($r == null)
{
    echo "<script>alert('商户不存在')</script>";
    echo '<script>window.location.replace("index.html");</script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>农家乐商户端</title>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/normal.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-offset-1 col-lg-offset-1">
            <h1>
                <?php echo $r['商户名称']; ?>
                <small>好评率:<?php echo $r['商户评级']; ?>%</small>
            </h1>
            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                <p class="lead"><?php echo $r['商户描述']; ?></p>
                <p>地址:</p>
                <address>
                    <strong><?php echo $r['商户位置']; ?></strong><br>
                    <?php echo $r['详细地址']; ?>
                </address>
                <a href="businessEdit.php" class="row text-center">编辑商户信息</a>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                <h4>营业执照:</h4>
                <img src="<?php echo $r['营业执照']; ?>" class="img-responsive">
            </div>
        </div>
    </div>
</div>

<div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-2 col-lg-offset-2 col-xs-10 col-sm-10 col-md-8 col-lg-8">
    <div class="row">
        <h3>商户图片:</h3>
        <?php
        $filesnames = scandir($r['商户照片']);
        foreach ($filesnames as $name)
        {
            if ($name != '.' and $name != '..')
            {
                $dir = $r['商户照片'] . $name; ?>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <a href='functions/delete_photo.php?src=<?php echo $dir;?>'>删除图片</a>
                    <img src="<?php echo $dir ?>" class="img-responsive col-xs-12 col-sm-12">
                </div>
                <?php
            }
        }
        ?>
    </div>
    <form action="functions/add_photo.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
            <legend>添加新图片</legend>
            <div class="row form-group">
                <div class="col-md-4">
                    <label for="photo">上传图片</label>
                    <input type="file" name="photo" accept="image/jpeg,image/png" id="photo"/>
                    <p class="help-block">仅支持不超过10M的jpg或png格式文件</p>
                </div>
                <div class="col-md-8">
                <input type="submit" value="添加" class="btn btn-primary btn-lg btn-block">
                </div>
            </div>
        </fieldset>
    </form>
    <div class="row">
        <h3>用户评论:</h3>
        <?php
        $SQL = "SELECT * FROM 评价 WHERE 用户='$id' ORDER BY 时间 DESC";
        $r = mysqli_query($con, $SQL);
        require_once "functions/comment_div.php";
        while ($comment = mysqli_fetch_array($r))
            comment_div($comment); ?>
    </div>
</div>
</body>
</html>