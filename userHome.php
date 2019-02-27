<?php
require_once 'connection.php';
$location = '';
$script = '';
$SQL = 'SELECT areaname FROM areas ';
if (isset($_POST['province']) and !empty($_POST['province']))
{
    $script = $script . "province.value='{$_POST['province']}';\n";
    $result = mysqli_query($city, $SQL . "WHERE id='{$_POST['province']}'");
    if ($result)
        $location = $location . "%" . mysqli_fetch_array($result)['areaname'] . "%";
    //嵌套1
    if (isset($_POST['city']) and !empty($_POST['city']))
    {
        $script = $script . "get_city_from_id('{$_POST['province']}',false);\n";
        $script = $script . "city.value='{$_POST['city']}';\n";
        $result = mysqli_query($city, $SQL . "WHERE id='{$_POST['city']}'");
        if ($result)
            $location = $location . "%" . mysqli_fetch_array($result)['areaname'] . "%";
        //嵌套2
        if (isset($_POST['district']) and !empty($_POST['district']))
        {
            $script = $script . "get_district_from_id('{$_POST['city']}',false);\n";
            $script = $script . "district.value='{$_POST['district']}';\n";
            $result = mysqli_query($city, $SQL . "WHERE id='{$_POST['district']}'");
            if ($result)
                $location = $location . "%" . mysqli_fetch_array($result)['areaname'] . "%";
            //嵌套3
            if (isset($_POST['street']) and !empty($_POST['street']))
            {
                $script = $script . "get_street_from_id('{$_POST['district']}',false);\n";
                $script = $script . "street.value='{$_POST['street']}'";
                $result = mysqli_query($city, $SQL . "WHERE id='{$_POST['street']}'");
                if ($result)
                    $location = $location . "%" . mysqli_fetch_array($result)['areaname'] . "%";
            }
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>农家乐用户端</title>
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/normal.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <form action="userHome.php" method="post" class="form-horizontal col-md-offset-3">
        <fieldset>
            <legend>搜索农家乐</legend>
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="businessname">商铺名</label>
                    <input type="text" placeholder="商铺名" name="businessname" id="businessname"
                           value="<?php echo $_POST['businessname'] ?>"
                           class="form-control input-lg">
                </div>
            </div>
            <fieldset class="row">
                <legend>地区</legend>
                <div class="form-group col-md-2">
                    <label for="province" style="visibility: hidden">省</label>
                    <select name="province" id="province" onclick="get_city()" style="visibility: hidden"
                            class="form-control"></select>
                </div>
                <div class="form-group col-md-2">
                    <label for="city" style="visibility: hidden">市</label>
                    <select name="city" id="city" onclick="get_district()" style="visibility: hidden"
                            class="form-control"></select>
                </div>
                <div class="form-group col-md-2">
                    <label for="district" style="visibility: hidden">区</label>
                    <select name="district" id="district" onclick="get_street()" style="visibility: hidden"
                            class="form-control"></select>
                </div>
                <div class="form-group col-md-2">
                    <label for="street" style="visibility: hidden">街道</label>
                    <select name="street" id="street" style="visibility: hidden"
                            class="form-control"></select>
                </div>
            </fieldset>
        </fieldset>
        <div class="row">
            <div class="col-md-8">
                <input type='submit' value="开始搜索" id="submit" class="row btn btn-primary btn-lg btn-block"/>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>商户名称</th>
                <th>商户描述</th>
                <th>商户位置</th>
                <th>详细地址</th>
                <th>商户评分</th>
                <th></th>
            </tr>
            <?php
            $SQL = 'SELECT 用户名,商户名称,商户描述,商户位置,详细地址,商户评级,商户照片 FROM 商户';
            if (isset($_POST['businessname']) and !empty($_POST['businessname']) and !empty($location))
                $SQL = $SQL . " WHERE 商户名称 LIKE '%{$_POST['businessname']}%' AND 商户位置 LIKE '$location'";
            elseif (!empty($location))
                $SQL = $SQL . " WHERE 商户位置 LIKE '$location'";
            elseif (isset($_POST['businessname']) and !empty($_POST['businessname']))
                $SQL = $SQL . " WHERE 商户名称 LIKE '%{$_POST['businessname']}%'";
            else
                $SQL = '';
            $result = @mysqli_query($con, $SQL);
            while ($row = @mysqli_fetch_array($result))
                businessDiv($row);
            ?>
        </table>
    </div>
</div>
<script src="js/jquery-3.3.1.js"></script>
<script src="js/CityPicker.js"></script>
<script>get_province(false);</script>
<script><?php echo $script; ?></script>
</body>
</html>

<?php
function businessDiv($data)
{
    ?>
    <tr>
        <td>
            <?php echo $data['商户名称'] ?>
        </td>
        <td>
            <?php echo $data['商户描述'] ?>
        </td>
        <td>
            <?php echo $data['商户位置'] ?>
        </td>
        <td>
            <?php echo $data['详细地址'] ?>
        </td>
        <td>
            <?php echo $data['商户评级'] ?>
        </td>
        <td>
            <a href="FarmstayInfo.php?id=<?php echo $data['用户名'] ?>">查看</a>
        </td>
    </tr>
    <?php
}

?>
