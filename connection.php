<?php
$con = mysqli_connect('mysql:3306', 'Farmstay', 'Farmstay', 'Farmstay');
mysqli_query($con,"set names utf8");
if ($con->connect_errno)
{
    die("连接失败: (" . $con->connect_errno . ") " . $con->connect_error);
}
$city = mysqli_connect('mysql:3306', 'City', 'City', 'City');
mysqli_query($con,"set names utf8");
if ($city->connect_errno)
{
    die("连接失败: (" . $city->connect_errno . ") " . $city->connect_error);
}