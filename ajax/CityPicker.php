<?php
require_once "../connection.php";
$result=@mysqli_query($city,"SELECT id,areaname FROM areas WHERE parentid='{$_POST['area']}'");
if($result)
{
    $areas=array();
    while ($row = mysqli_fetch_array($result))
        $areas[]=array('id'=>$row['id'],'name'=>$row['areaname']);
    echo json_encode($areas);
}
exit();
