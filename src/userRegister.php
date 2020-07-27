<?php
require('connection.php');
if (!isset($_POST['username']) or empty($_POST['username']))
{
    echo '<script>alert("请输入用户名")</script>';
    echo '<script>window.location.replace("userRegister.html");</script>';
    exit();
}
if (!isset($_POST['password']) or empty($_POST['password']))
{
    echo '<script>alert("请输入密码")</script>';
    echo '<script>window.location.replace("userRegister.html");</script>';
    exit();
}
if ($_POST['password'] !== $_POST['confirm'])
{
    echo '<script>alert("密码不一致,请重新输入")</script>';
    echo '<script>window.location.replace("userRegister.html");</script>';
    exit();
}
$password=md5($_POST['password']);
if (mb_strlen($_POST['username']) <= 6)
{
    echo '<script>alert("用户名应大于6个字符,请重新输入")</script>';
    echo '<script>window.location.replace("userRegister.html");</script>';
    exit();
}
if (!preg_match("/^[a-z\d]*$/i", $_POST['username']))
{
    echo '<script>alert("用户名只能是数字和字母的组合,请重新输入")</script>';
    echo '<script>window.location.replace("userRegister.html");</script>';
    exit();
}
$username = htmlspecialchars($_POST['username']);
if (@mysqli_fetch_row(mysqli_query($con, "SELECT * FROM 用户 WHERE 用户名='$username'")))
{
    echo "<script>alert('用户名 $username 已存在,请使用其他用户名')</script>";
    echo '<script>window.location.replace("userRegister.html");</script>';
    exit();
}

$password = md5($_POST['password']);
if (mysqli_query($con, "INSERT INTO 用户(用户名,密码,注册时间) VALUES ('$username','$password',now())"))
{
    echo '<script>alert("注册成功！")</script>';
    session_start();
    $_SESSION['id'] = $username;
    $_SESSION['character']='user';
    session_write_close();
    setcookie('username', $username, time() + 2592000);
    setcookie('password', $password, time() + 2592000);
    header("Refresh:0,Url=userHome.php");
}
exit();
