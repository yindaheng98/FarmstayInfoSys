<?php
require_once "../OnlineCheck_business.php";
require_once "../connection.php";
$SQL = "UPDATE 商户 SET";
if (isset($_POST['businessname']) and !empty($_POST['businessname']))
{
    if (preg_match("/[\s`!@#$%^&|~?<>,.+-\\/\\*\\[\\]\\{\\}\\\]/", $_POST['businessname']))
    {
        echo "<script>alert('商户名称不能包含特殊字符')</script>";
        echo '<script>window.location.replace("../businessEdit.php");</script>';
        exit();
    }
    $SQL = $SQL . " 商户名称='{$_POST['businessname']}',";
}
if (isset($_POST['address']) and !empty($_POST['address']))
{
    if (preg_match("/[`!@#$%^&|~?<>,.+-\\/\\*\\[\\]\\{\\}\\\]/", $_POST['address']))
    {
        echo "<script>alert('详细地址不能包含特殊字符')</script>";
        echo '<script>window.location.replace("../businessEdit.php");</script>';
        exit();
    }
    $SQL = $SQL . " 详细地址='{$_POST['address']}',";
}
if (isset($_POST['discription']) and !empty($_POST['discription']))
{
    if (preg_match("/[`#^&|,.\\/\\*\\[\\]\\{\\}\\\]/", $_POST['discription']))
    {
        echo "<script>alert('商铺描述不能包含特殊字符')</script>";
        echo '<script>window.location.replace("../businessEdit.php");</script>';
        exit();
    }
    $SQL = $SQL . " 商户描述='{$_POST['discription']}',";
}
$location = '';
if (isset($_POST['province']) && $_POST['province'] !== null && $_POST['province'] !== '')
{
    $result = mysqli_fetch_array(mysqli_query($city, "SELECT areaname FROM areas WHERE id={$_POST['province']}"));
    if ($result == null)
    {
        echo "<script>alert('地区错误')</script>";
        echo '<script>window.location.replace("../businessEdit.php");</script>';
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
        echo '<script>window.location.replace("../businessEdit.php");</script>';
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
        echo '<script>window.location.replace("../businessEdit.php");</script>';
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
        echo '<script>window.location.replace("../businessEdit.php");</script>';
        exit();
    }
    $location = $location . $result['areaname'];
}
if ($location != '')
    $SQL = $SQL . ' ' . "商户位置='" . $location . "',";
$SQL = substr($SQL, 0, -1)." WHERE 用户名='$id'";
if(!mysqli_query($con,$SQL))
{
    echo "<script>alert('修改失败')</script>";
    echo '<script>window.location.replace("../businessEdit.php");</script>';
    exit();
}
echo '<script>window.location.replace("../businessHome.php");</script>';
exit();
