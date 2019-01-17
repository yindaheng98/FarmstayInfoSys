<?php
require('connection.php');
if (!isset($_POST['username']) or empty($_POST['username']))
{
    echo '<script>alert("请输入用户名")</script>';
    echo '<script>window.location.replace("index.html");</script>';
    exit();
}
if (mb_strlen($_POST['username']) <= 6)
{
    echo '<script>alert("用户名应大于6个字符,请重新输入")</script>';
    echo '<script>window.location.replace("index.html");</script>';
    exit();
}
if (!preg_match("/^[a-z\d]*$/i", $_POST['username']))
{
    echo '<script>alert("用户名只能是数字和字母的组合,请重新输入")</script>';
    echo '<script>window.location.replace("index.html");</script>';
    exit();
}
if (!isset($_POST['password']) or empty($_POST['password']))
{
    echo '<script>alert("请输入密码")</script>';
    echo '<script>window.location.replace("index.html");</script>';
    exit();
}
if (!isset($_POST['character']) or empty($_POST['character']))
{
    echo '<script>alert("请选择您是用户或商户")</script>';
    echo '<script>window.location.replace("index.html");</script>';
    exit();
}
$pageto='';
$password=md5($_POST['password']);
if ($_POST['character'] == 'user')
{
    if (!mysqli_fetch_array(mysqli_query($con, "SELECT * FROM 用户 WHERE 用户名='{$_POST['username']}' AND 密码='$password'")))
    {
        echo "<script>alert('用户名或密码错误')</script>";
        echo '<script>window.location.replace("index.html");</script>';
        exit();
    }
    $pageto='userHome.php';
}
if ($_POST['character'] == 'business')
{
    if (!mysqli_fetch_array(mysqli_query($con, "SELECT * FROM 商户 WHERE 用户名='{$_POST['username']}' AND 密码='$password'")))
    {
        echo "<script>alert('用户名或密码错误')</script>";
        echo '<script>window.location.replace("index.html");</script>';
        exit();
    }
    $pageto='businessHome.php';
}
session_start();
$_SESSION['character'] = $_POST['character'];
$_SESSION['id'] = $_POST['username'];
session_write_close();
setcookie('username', $_POST['username'], time() + 2592000);
setcookie('password', $password, time() + 2592000);
header("Refresh:0,Url=".$pageto);
exit();