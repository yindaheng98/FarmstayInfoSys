<?php
require_once "../OnlineCheck_business.php";
if ($_FILES["photo"]["error"] > 0)
{
    echo "<script>alert('商户照片文件错误,请重新上传: {$_FILES['file']['error']}.<br/>')</script>";
    echo '<script>window.location.replace("../businessHome.php");</script>';
    exit();
}
if (!(($_FILES["photo"]["type"] == "image/png") || ($_FILES["photo"]["type"] == "image/jpeg")))
{
    echo "<script>alert('只接受png或jpg文件,请重新上传')</script>";
    echo '<script>window.location.replace("../businessHome.php");</script>';
    exit();
}
if ($_FILES["photo"]["size"] > 10 * 1024 * 1024)
{
    echo "<script>alert('商户照片文件应小于10M,请重新上传')</script>";
    echo '<script>window.location.replace("../businessHome.php");</script>';
    exit();
}
$pto_dir = "../pic/bsn/pto/" . $id.'/'.session_create_id().'.'. end(explode('.', $_FILES['photo']['name']));
if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $pto_dir))
{
    echo "<script>alert('文件上传失败')</script>";
    echo '<script>window.location.replace("../businessHome.php");</script>';
    exit();
}
echo '<script>window.location.replace("../businessHome.php");</script>';
exit();