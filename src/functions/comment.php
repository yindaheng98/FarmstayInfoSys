<?php
require_once "../OnlineCheck_user.php";
session_start();
$viewing = $_SESSION['viewing'];
session_write_close();
require_once "../connection.php";
$photo_dir = "";
if ($_FILES["photo"]["error"] > 0)
{
    if ($_FILES["photo"]["error"] != UPLOAD_ERR_NO_FILE)
    {
        echo "<script>alert('图片文件错误,请重新上传')</script>";
        echo "<script>window.location.replace('../FarmstayInfo.php?id=$viewing');</script>";
        exit();
    }
    $photo_dir = "null";
}
else
{
    if (!(($_FILES["photo"]["type"] == "image/png") || ($_FILES["photo"]["type"] == "image/jpeg")))
    {
        echo "<script>alert('只接受png或jpg文件,请重新上传')</script>";
        echo "<script>window.location.replace('../FarmstayInfo.php?id=$viewing');</script>";
        exit();
    }
    if ($_FILES["photo"]["size"] > 10 * 1024 * 1024)
    {
        echo "<script>alert('图片文件应小于10M,请重新上传<br/>')</script>";
        echo "<script>window.location.replace('../FarmstayInfo.php?id=$viewing');</script>";
        exit();
    }
    $photo_dir = "../pic/cmt/" . $viewing . '/' . session_create_id() . '.' . end(explode('.', $_FILES['photo']['name']));
    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_dir))
    {
        echo "<script>alert('图片上传失败')</script>";
        echo "<script>window.location.replace('../FarmstayInfo.php?id=$viewing');</script>";
        exit();
    }
}
$SQL = "INSERT INTO 评价(用户, 商户, 内容, 打分, 时间, 图片) VALUES ('$id','$viewing','{$_POST['comment']}',{$_POST['grade']},now(),'$photo_dir')";
if (!mysqli_query($con, $SQL))
    echo "<script>alert('评论失败')</script>";
$SQL="update 商户 set 商户评级=100*(SELECT count(*) FROM 评价 where 商户='$viewing' and 打分>100)/(SELECT count(*) FROM 评价 where 商户='$viewing') where 用户名='$viewing'";
if (!mysqli_query($con, $SQL))
    echo "<script>alert('评论失败')</script>";
echo "<script>window.location.replace('../FarmstayInfo.php?id=$viewing');</script>";
exit();
