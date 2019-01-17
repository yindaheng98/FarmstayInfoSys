<?php
require_once "../OnlineCheck_business.php";
if (explode('/', $_GET['src'])[3]!=$id||!unlink('../'.$_GET['src']))
    echo "<script>alert('删除失败')</script>";
echo '<script>window.location.replace("../businessHome.php");</script>';
exit();