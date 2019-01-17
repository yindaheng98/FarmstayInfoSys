<?php
$con = mysqli_connect('localhost:3306', 'Farmstay', 'Farmstay', 'Farmstay');
if ($con->connect_errno)
{
    die("连接失败: (" . $con->connect_errno . ") " . $con->connect_error);
}
$city = mysqli_connect('localhost:3306', 'City', 'City', 'City');
if ($city->connect_errno)
{
    die("连接失败: (" . $city->connect_errno . ") " . $city->connect_error);
}