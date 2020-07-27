<?php
require("../connection.php");
if ($_POST['type'] == 'user')
    echo(((bool)@mysqli_fetch_row(mysqli_query($con, "SELECT * FROM 用户 WHERE 用户名='{$_POST['username']}'")))
        or (mb_strlen($_POST['username']) > 255));
else
    echo(((bool)@mysqli_fetch_row(mysqli_query($con, "SELECT * FROM 商户 WHERE 用户名='{$_POST['username']}'")))
        or (mb_strlen($_POST['username']) > 255));
exit();