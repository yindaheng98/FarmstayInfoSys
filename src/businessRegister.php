<?php
require('connection.php');
if (!isset($_POST['username']) or empty($_POST['username']))
{
    echo '<script>alert("请输入用户名")</script>';
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if (!isset($_POST['password']) or empty($_POST['password']))
{
    echo '<script>alert("请输入密码")</script>';
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if ($_POST['password'] !== $_POST['confirm'])
{
    echo '<script>alert("密码不一致,请重新输入")</script>';
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
$password = md5($_POST['password']);
if (mb_strlen($_POST['username']) <= 6)
{
    echo '<script>alert("用户名应大于6个字符,请重新输入")</script>';
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if (!preg_match("/^[a-z\d]*$/i", $_POST['username']))
{
    echo '<script>alert("用户名只能是数字和字母的组合,请重新输入")</script>';
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
$username = htmlspecialchars($_POST['username']);
if (@mysqli_fetch_row(mysqli_query($con, "SELECT * FROM 商户 WHERE 用户名='$username'")))
{
    echo "<script>alert('用户名 $username 已存在,请使用其他用户名')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}

if (!isset($_POST['businessname']) or empty($_POST['businessname'])
    or !isset($_POST['address']) or empty($_POST['address'])
    or !isset($_POST['discription']) or empty($_POST['discription']))
{
    echo '<script>alert("请输入完整信息")</script>';
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}

if (preg_match("/[\s`!@#$%^&|~?<>,.+-\\/\\*\\[\\]\\{\\}\\\]/", $_POST['businessname']))
{
    echo "<script>alert('商户名称不能包含特殊字符')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}

$location = '';
if (isset($_POST['province']) && $_POST['province'] !== null && $_POST['province'] !== '')
{
    $result = mysqli_fetch_array(mysqli_query($city, "SELECT areaname FROM areas WHERE id={$_POST['province']}"));
    if ($result == null)
    {
        echo "<script>alert('地区错误')</script>";
        echo '<script>window.location.replace("businessRegister.html");</script>';
        exit();
    }
    $location = $location . $result['areaname'];

}
if (isset($_POST['city']) && $_POST['city'] !== null && $_POST['city'] !== '')
{
    $result = mysqli_fetch_array(mysqli_query($city, "SELECT areaname FROM areas WHERE id={$_POST['city']}"));
    if ($result == null)
    {
        echo "<script>alert('地区错误')</script>";
        echo '<script>window.location.replace("businessRegister.html");</script>';
        exit();
    }
    $location = $location . $result['areaname'];
}
if (isset($_POST['district']) && $_POST['district'] !== null && $_POST['district'] !== '')
{
    $result = mysqli_fetch_array(mysqli_query($city, "SELECT areaname FROM areas WHERE id={$_POST['district']}"));
    if ($result == null)
    {
        echo "<script>alert('地区错误')</script>";
        echo '<script>window.location.replace("businessRegister.html");</script>';
        exit();
    }
    $location = $location . $result['areaname'];
}
if (isset($_POST['street']) && $_POST['street'] !== null && $_POST['street'] !== '')
{
    $result = mysqli_fetch_array(mysqli_query($city, "SELECT areaname FROM areas WHERE id={$_POST['street']}"));
    if ($result == null)
    {
        echo "<script>alert('地区错误')</script>";
        echo '<script>window.location.replace("businessRegister.html");</script>';
        exit();
    }
    $location = $location . $result['areaname'];
}
if (preg_match("/[`!@#$%^&|~?<>,.+-\\/\\*\\[\\]\\{\\}\\\]/", $_POST['address']))
{
    echo "<script>alert('详细地址不能包含特殊字符')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if (preg_match("/[`#^&|,.\\/\\*\\[\\]\\{\\}\\\]/", $_POST['discription']))
{
    echo "<script>alert('商铺描述不能包含特殊字符')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if ($_FILES["licence"]["error"] > 0)
{
    echo "<script>alert('营业执照文件错误,请重新上传:<br/>{$_FILES['file']['error']}<br/>')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if (!(($_FILES["licence"]["type"] == "image/png") || ($_FILES["licence"]["type"] == "image/jpeg")))
{
    echo "<script>alert('只接受png或jpg文件,请重新上传<br/>')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if ($_FILES["licence"]["size"] > 10 * 1024 * 1024)
{
    echo "<script>alert('营业执照文件应小于10M,请重新上传<br/>')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}

if ($_FILES["photo"]["error"] > 0)
{
    echo "<script>alert('商户照片文件错误,请重新上传: {$_FILES['file']['error']}.<br/>')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if (!(($_FILES["photo"]["type"] == "image/png") || ($_FILES["photo"]["type"] == "image/jpeg")))
{
    echo "<script>alert('只接受png或jpg文件,请重新上传<br/>')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if ($_FILES["photo"]["size"] > 10 * 1024 * 1024)
{
    echo "<script>alert('商户照片文件应小于10M,请重新上传<br/>')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
$cmt_dir="pic/cmt/" . $username;
if(!mkdir($cmt_dir))
{
    echo "<script>alert('评论目录创建失败')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
$pto_dir = "pic/bsn/pto/" . $username.'/';
if(!mkdir($pto_dir))
{
    echo "<script>alert('图片目录创建失败')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
$lic_dir = "pic/bsn/lic/" . $username . '.' . end(explode('.', $_FILES['licence']['name']));
if (!move_uploaded_file($_FILES["licence"]["tmp_name"], $lic_dir) or
    !move_uploaded_file($_FILES["photo"]["tmp_name"], $pto_dir . 'p1.' . end(explode('.', $_FILES['photo']['name']))))
{
    echo "<script>alert('文件上传失败')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
if (!mysqli_query($con, "INSERT INTO 商户(用户名,密码,注册时间,商户名称,商户描述,商户位置,详细地址,商户评级,营业执照,商户照片)
VALUES ('$username','$password',now(),'{$_POST['businessname']}','{$_POST['discription']}','$location','{$_POST['address']}',0,'$lic_dir','$pto_dir')"))
{
    echo "<script>alert('注册失败')</script>";
    echo '<script>window.location.replace("businessRegister.html");</script>';
    exit();
}
echo '<script>alert("注册成功！")</script>';
session_start();
$_SESSION['id'] = $username;
$_SESSION['character']='business';
session_write_close();
setcookie('username', $username, time() + 2592000);
setcookie('password', $password, time() + 2592000);
header("Refresh:0,Url=businessHome.php");
exit();