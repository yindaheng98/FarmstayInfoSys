<?php
session_start();
if(!isset($_SESSION['id']) or empty($_SESSION['id']) or !isset($_SESSION['character']) or empty($_SESSION['character']))
{
    echo "<script>alert('请先登录')</script>";
    echo '<script>window.location.replace("index.html");</script>';
    exit();
}
if($_SESSION['character']!='user')
{
    echo "<script>alert('请登录用户端')</script>";
    echo '<script>window.location.replace("index.html");</script>';
    exit();
}
$id=$_SESSION['id'];
session_write_close();